<?php
require '../db/connect.php';
?>
<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">

<?php
$test = true;

date_default_timezone_set('Asia/Kathmandu');
$resettimestamp = date('d-m-y h:i:s');
$resettime = strtotime($resettimestamp);

if(isset($_POST['change'])) {
    $resetcode = $_POST['resetcode'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if(empty($resetcode) || empty($password) || empty($cpassword)) {
        $_SESSION['icons']="./img/alerticons/warning.png";  
        $_SESSION['status']="warning";
        $_SESSION['status_code']="Please Fill All The Fields";
        header("Location: ../resetpassword.php");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE reset_code = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION['icons']="./img/alerticons/error.png";
            $_SESSION['status']="error";
            $_SESSION['status_code']="SQL Error";
            header("Location: ../resetpassword.php");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $resetcode);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                if($row['expiry_time'] > time()) {
                    if($row['email'] == $email) {
                        if($password == $cpassword) {
                            if(strlen($password) >= 8 ) {
                                $sql = "UPDATE users SET password = '$password' WHERE email = '$email' and reset_code = '$resetcode'";
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_execute($stmt);
                                $_SESSION['icons']="./img/alerticons/success.png";
                                $_SESSION['status']="success";
                                $_SESSION['status_code']="Password Changed Successfully";
                                header("Location: ../login.php");
                                exit();
                            }
                            else {
                                $_SESSION['icons']="./img/alerticons/error.png";  
                                $_SESSION['status']="error";
                                $_SESSION['status_code']="Password Should Be 8 Character Long";
                                header("Location: ../resetpassword.php");
                                exit();
                            }
                        }
                        else {
                            $_SESSION['icons']="./img/alerticons/error.png";
                            $_SESSION['status']="error";
                            $_SESSION['status_code']="Confirm Password Should Be Same";
                            header("Location: ../resetpassword.php");
                            exit();
                        }
                    }
                    else {
                        $_SESSION['icons']="./img/alerticons/error.png";  
                        $_SESSION['status']="error";
                        $_SESSION['status_code']="Email Address Should Be Same as Reset Email";
                        header("Location: ../resetpassword.php");
                    }
                }
                else {
                    $_SESSION['icons']="./img/alerticons/error.png";  
                    $_SESSION['status']="error";
                    $_SESSION['status_code']="Reset Time Expired";
                    header("Location: ../resetpassword.php");
                    exit();
                }
            }
            else {
                $_SESSION['icons']="./img/alerticons/error.png";
                $_SESSION['status']="error";
                $_SESSION['status_code']="Invalid Reset Code. Reset Again";
                header("Location: ../resetpassword.php");
                exit();
            }
        }
    }
}
else {
    $_SESSION['icons']="./img/alerticons/error.png";
    $_SESSION['status']="error";
    $_SESSION['status_code']="Data Submission Error";
    header("Location: ../resetpassword.php");
    exit();
}

?>

<script src="../alerts/dist/js/iziToast.min.js"></script>