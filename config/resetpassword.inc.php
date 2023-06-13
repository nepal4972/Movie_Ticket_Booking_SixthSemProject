<?php
require '../db/connect.php';
?>
<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
<?php
if(isset($_POST['reset'])) {
    $res_email = $_POST['reset_email'];
    if(empty($res_email)) {
        $_SESSION['icons']="./img/alerticons/warning.png";  
        $_SESSION['status']="warning";
        $_SESSION['status_code']="Please Enter Email Address";
        header("Location: ../resetpassword.php");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION['icons']="./img/alerticons/error.png";  
            $_SESSION['status']="error";
            $_SESSION['status_code']="SQL Error";
            header("Location: ../resetpassword.php");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $res_email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $reset_email = $res_email;
            }
            else {
                $_SESSION['icons']="./img/alerticons/warning.png";  
                $_SESSION['status']="warning";
                $_SESSION['status_code']="Please Enter Valid Email Address";
                header("Location: ../resetpassword.php");
                exit();
            }       
        }
    }
}
else {
    $_SESSION['icons']="./img/alerticons/error.png";
    $_SESSION['status']="error";
    $_SESSION['status_code']="Please Enter Reset Email";
    header("Location: ../resetpassword.php");
    exit();
}


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mail/Exception.php';
require '../mail/PHPMailer.php';
require '../mail/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nepal4972@gmail.com';                   //SMTP username
    $mail->Password   = 'bpmdlcwlkcsqvqve';                   //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nepal4972@gmail.com', 'mail@cinepal');
    $mail->addAddress($reset_email);     //Add a recipient


    $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);
    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password Reset';
    $mail->Body    = 'To Reset your Password click: <a href="http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/changepassword.php?resetcode='.$code.'">here </a>. </br>Reset Your Password in One Hour.';

    $verifyquery = "SELECT * FROM users WHERE email = '$reset_email'";
    $result = $conn->query($verifyquery);

    $currenttime = time();
    $expirytime = $currenttime + (60 * 60);
   
    if($result !== false && $result->num_rows > 0) {
        $codequery = "UPDATE users SET reset_code = '$code', expiry_time = '$expirytime' WHERE email = '$reset_email'";
        $sql = mysqli_query($conn, $codequery);
        $mail->send();
        $_SESSION['icons']="./img/alerticons/success.png";
        $_SESSION['status']="success";
        $_SESSION['status_code']="Reset Mail Sent Successfully. Please Check Your Email";
        header("Location: ../login");
    }

} catch (Exception $e) {
    $_SESSION['icons']="./img/alerticons/error.png";
    $_SESSION['status']="error";
    $_SESSION['status_code']="Message Couldn't be Sent in This Email";
    header("Location: ../resetpassword");
}

?>
<script src="../alerts/dist/js/iziToast.min.js"></script>