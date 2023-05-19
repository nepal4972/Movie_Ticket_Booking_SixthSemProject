<?php
require '../db/connect.php';
?>
<link rel="stylesheet" href="../alerts/iziToast-master/dist/css/iziToast.min.css">
<?php

if(isset($_POST['submit'])) {

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
    $cpassword = htmlspecialchars($_POST['cpassword'], ENT_QUOTES);


    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die ("Query Failed");
    $checkUsername = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'") or die ("Query Failed");

    date_default_timezone_set('Asia/Kathmandu');
    $registerdate = date('d-m-y h:i:s');

    
    if(empty($username) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['status']="warning";
        $_SESSION['status_code']="Please Fill All The Fields";
        header("Location: ../signup?username=".$username."&email=".$email);
        exit();
    }
    else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(mysqli_num_rows($checkEmail) > 0) {
                $_SESSION['status']="error";
                $_SESSION['status_code']="This Email is Already Used";
                header("Location: ../signup?username=".$username);
                exit();
            }
            else {
                if(mysqli_num_rows($checkUsername) > 0) {
                    $_SESSION['status']="warning";
                    $_SESSION['status_code']="This Username is Already Used";
                    header("Location: ../signup?email=".$email);
                    exit();
                }
                else {
                    if(strlen($password) >= 8 ) {
                        if($password !== $cpassword) {
                            $_SESSION['status']="warning";
                            $_SESSION['status_code']="Password Doesn't Matched";
                            header("Location: ../signup?username=".$username."&email=".$email);
                            exit();
                        }
                        else {
                            $sql = "INSERT INTO users (username, email, password, usertype, registerdate) VALUES (?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                $query = mysqli_query($conn, $sql);
                                $_SESSION['status']="error";
                                $_SESSION['status_code']="SQL Error";
                                header("Location: ../signup");
                                exit();
                            }
                            else {
                                $usertype = 0;
                                mysqli_stmt_bind_param($stmt, "sssis", $username, $email, $password, $usertype , $registerdate);
                                mysqli_stmt_execute($stmt);
                                $_SESSION['status']="success";
                                $_SESSION['status_code']="SignedUp Successful. You can Login Now";
                                header("Location: ../login");
                                exit();
                            }
                        }
                    }
                    else {
                        $_SESSION['status']="warning";
                        $_SESSION['status_code']="Password Should be 8 Character Long";
                        header("Location: ../signup?username=".$username."&email=".$email);
                        exit();
                    }
                }
            }
        }
        else {
            $_SESSION['status']="error";
            $_SESSION['status_code']="Invalid Email";
            header("Location: ../signup?username=".$username);
            exit();
        }
    }
}
else {
    header("Location: ../signup.php");
    exit();
}

?>
<script src="../alerts/iziToast-master/dist/js/iziToast.min.js"></script>