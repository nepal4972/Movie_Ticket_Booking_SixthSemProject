<?php
require '../db/connect.php';
?>
<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
<?php
if(isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    if(empty($fullname) || empty($password)) {
        $_SESSION['icons']="./img/alerticons/warning.png";  
        $_SESSION['status']="warning";
        $_SESSION['status_code']="Please Fill All The Fields";
        header("Location: ../login.php?email=".$fullname);
        exit();
    }   
    else {
        $sql = "SELECT * FROM users WHERE email = ? OR phone_number = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION['icons']="./img/alerticons/error.png";
            $_SESSION['status']="error";
            $_SESSION['status_code']="SQL Error";
            header("Location: ../login.php");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $fullname, $fullname);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['password']);

                if ($password == $row['password']) {
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['email'] = $row['email'];

                    $_SESSION['icons']="./img/alerticons/success.png";  
                    $_SESSION['status']="success";
                    $_SESSION['status_code']='You are Logged in as: ' . $_SESSION['fullname'];
                    header("Location: ../");
                    exit(); 
                }
                else {
                    $_SESSION['icons']="./img/alerticons/warning.png";  
                    $_SESSION['status']="warning";
                    $_SESSION['status_code']="Incorrect Password";
                    header("Location: ../login.php?email=".$fullname);
                    exit();
                }
            }       
            else {
                $_SESSION['icons']="./img/alerticons/error.png";
                $_SESSION['status']="error";
                $_SESSION['status_code']="Unknown Email or Password";
                header("Location: ../login.php");
                exit();
            }
        }
    }
}
else {
    $_SESSION['icons']="./img/alerticons/error.png";  
    $_SESSION['status']="error";
    $_SESSION['status_code']="Data Submission Error";
    header("Location: ../login.php");
    exit();
}

?>
<script src="../alerts/dist/js/iziToast.min.js"></script>