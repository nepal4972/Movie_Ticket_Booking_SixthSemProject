<?php
require '../db/connect.php';
?>
<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">

<?php
$userID = $_SESSION['userID'];

if(isset($_POST['submit'])) {
    $oldpassword = $_POST['oldpassword'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if(empty($oldpassword) || empty($password) || empty($cpassword)) {
        $_SESSION['icons'] = "./img/alerticons/warning.png";
        $_SESSION['status'] = "warning";
        $_SESSION['status_code'] = "Please Fill All The Fields";
        header("Location: ../updatepassword.php");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE userID = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "SQL Error";
            header("Location: ../updatepassword.php");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $storedPassword = $row['password'];
                $oldpasswordMD5 = md5($oldpassword); // Hash the old password as MD5

                if ($oldpasswordMD5 === $storedPassword) { // Compare MD5 hashed old password
                    if($password == $cpassword) {
                        if(strlen($password) >= 8 ) {
                            $newPasswordMD5 = md5($password); // Hash the new password as MD5
                            $sql = "UPDATE users SET password = '$newPasswordMD5' WHERE userID = '$userID'";
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt, $sql);
                            mysqli_stmt_execute($stmt);
                            $_SESSION['icons'] = "./img/alerticons/success.png";
                            $_SESSION['status'] = "success";
                            $_SESSION['status_code'] = "Password Changed Successfully";
                            header("Location: ../updatepassword.php");
                            exit();
                        }
                        else {
                            $_SESSION['icons'] = "./img/alerticons/error.png";
                            $_SESSION['status'] = "error";
                            $_SESSION['status_code'] = "Password Should Be 8 Characters Long";
                            header("Location: ../updatepassword.php");
                            exit();
                        }
                    }
                    else {
                        $_SESSION['icons'] = "./img/alerticons/error.png";
                        $_SESSION['status'] = "error";
                        $_SESSION['status_code'] = "Confirm Password Should Be Same";
                        header("Location: ../updatepassword.php");
                        exit();
                    }
                }
                else {
                    $_SESSION['icons'] = "./img/alerticons/warning.png";
                    $_SESSION['status'] = "warning";
                    $_SESSION['status_code'] = "Old Password is Incorrect";
                    header("Location: ../updatepassword.php");
                    exit();
                }
            }
            else {
                $_SESSION['icons'] = "./img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "Invalid User";
                header("Location: ../updatepassword.php");
                exit();
            }
        }
    }

}
else {
    header("Location: ../");
    exit();
}
?>

<script src="../alerts/dist/js/iziToast.min.js"></script>
