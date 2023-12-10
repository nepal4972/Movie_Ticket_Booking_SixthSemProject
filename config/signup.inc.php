<?php
require '../db/connect.php';

if(isset($_POST['submit'])) {
    $fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $phone_number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die ("Query Failed");
    $checkphone_number = mysqli_query($conn, "SELECT * FROM users WHERE phone_number = '$phone_number'") or die ("Query Failed");

    date_default_timezone_set('Asia/Kathmandu');
    $registerdate = date("Y-m-d");

    if(empty($fullname) || empty($email) || empty($phone_number) || empty($password) || empty($cpassword)) {
        $_SESSION['icons'] = "./img/alerticons/warning.png";  
        $_SESSION['status'] = "warning";
        $_SESSION['status_code'] = "Please Fill All The Fields";
        header("Location: ../signup?fullname=".$fullname."&email=".$email."&phone_number=".$phone_number);
        exit();
    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(mysqli_num_rows($checkEmail) > 0) {
                $_SESSION['icons'] = "./img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "This Email is Already Used";
                header("Location: ../signup?fullname=".$fullname."&phone_number=".$phone_number);
                exit();                                         
            } else {
                if(mysqli_num_rows($checkphone_number) > 0) {
                    $_SESSION['icons'] = "./img/alerticons/warning.png";
                    $_SESSION['status'] = "warning";
                    $_SESSION['status_code'] = "This Phone Number is Already Used or is Invalid";
                    header("Location: ../signup?fullname=".$fullname."&email=".$email);
                    exit();
                } else {
                    if(strlen($password) >= 8 ) {
                        if ((!filter_var($phone_number, FILTER_VALIDATE_INT) === false ) && strlen($phone_number) == 10) {
                            if($password === $cpassword) {
                                $sql = "INSERT INTO users (fullname, email, phone_number, password) VALUES (?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $sql)) {
                                    $query = mysqli_query($conn, $sql);
                                    $_SESSION['icons'] = "./img/alerticons/error.png";
                                    $_SESSION['status'] = "error";
                                    $_SESSION['status_code'] = "SQL Error";
                                    header("Location: ../signup");
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $phone_number, $password);
                                    mysqli_stmt_execute($stmt);
                                    $_SESSION['icons'] = "./img/alerticons/success.png";  
                                    $_SESSION['status'] = "success";
                                    $_SESSION['status_code'] = "SignedUp Successful. You can Login Now";
                                    header("Location: ../login");
                                    exit();
                                }
                            } else {
                                $_SESSION['icons'] = "./img/alerticons/error.png";
                                $_SESSION['status'] = "error";
                                $_SESSION['status_code'] = "Both Passwords Should Be Same";
                                header("Location: ../signup?fullname=".$fullname."&email=".$email."&phone_number=".$phone_number);
                                exit();                              
                            }                            
                        } else {
                            $_SESSION['icons'] = "./img/alerticons/error.png";
                            $_SESSION['status'] = "error";
                            $_SESSION['status_code'] = "Invalid Phone Number Format";
                            header("Location: ../signup?fullname=".$fullname."&email=".$email);
                            exit();
                        }
                    } else {
                        $_SESSION['icons'] = "./img/alerticons/warning.png";  
                        $_SESSION['status'] = "warning";
                        $_SESSION['status_code'] = "Password Should be 8 Character Long";
                        header("Location: ../signup?fullname=".$fullname."&email=".$email."&phone_number=".$phone_number);
                        exit();
                    }
                }
            }
        } else {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Invalid Email";
            header("Location: ../signup?fullname=".$fullname."&phone_number=".$phone_number);
            exit();
        }
    }
} else {
    $_SESSION['icons'] = "./img/alerticons/error.png";  
    $_SESSION['status'] = "error";
    $_SESSION['status_code'] = "Data Submission Error";
    header("Location: ../signup.php");
    exit();
}
?>
<script src="../alerts/iziToast-master/dist/js/iziToast.min.js"></script>
