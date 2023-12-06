<?php
include '../db/connect.php';
?>

<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">

<?php
if (isset($_POST['reset'])) {
    $res_email = $_POST['reset_email'];
    if (empty($res_email)) {
        $_SESSION['icons'] = "./img/alerticons/warning.png";
        $_SESSION['status'] = "warning";
        $_SESSION['status_code'] = "Please Enter Email Address";
        header("Location: ../resetpassword.php");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "SQL Error";
            header("Location: ../resetpassword.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $res_email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $reset_email = $res_email;
            } else {
                $_SESSION['icons'] = "./img/alerticons/warning.png";
                $_SESSION['status'] = "warning";
                $_SESSION['status_code'] = "Please Enter Valid Email Address";
                header("Location: ../resetpassword.php");
                exit();
            }
        }
    }
} else {
    $_SESSION['icons'] = "./img/alerticons/error.png";
    $_SESSION['status'] = "error";
    $_SESSION['status_code'] = "Please Enter Reset Email";
    header("Location: ../resetpassword.php");
    exit();
}

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mail/Exception.php';
require '../mail/PHPMailer.php';
require '../mail/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                    // Enable SMTP authentication
    $mail->Username = 'nepal4972@gmail.com';                    // SMTP username
    $mail->Password = 'rcobdwyowrcrhxwe';                      // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
    $mail->Port = 465;     
    
    $mail->SMTPDebug = 0;// TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('nepal4972@gmail.com', 'mail@cinepal');
    $mail->addAddress($reset_email);                            // Add a recipient

    $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

    // Content
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = 'Reset Your Password';
    $mail->Body = '<head>
      <title>Reset your password</title>
      <!--[if mso]><style type="text/css">body, table, td, a { font-family: Arial, Helvetica, sans-serif !important; }</style><![endif]>
    </head>  
    <body style="font-family: Helvetica, Arial, sans-serif; margin: 0px; padding: 0px; background-color: #ffffff;">
      <table role="presentation"
        style="width: 100%; border-collapse: collapse; border: 0px; border-spacing: 0px; font-family: Arial, Helvetica, sans-serif; background-color: rgb(239, 239, 239);">
        <tbody>
          <tr>
            <td align="center" style="padding: 1rem 2rem; vertical-align: top; width: 100%;">
              <table role="presentation" style="max-width: 600px; border-collapse: collapse; border: 0px; border-spacing: 0px; text-align: left;">
                <tbody>
                  <tr>
                    <td style="padding: 40px 0px 0px;">
                      <div style="text-align: center;">
                        <div style="padding-bottom: 20px;"><img src="https://saugat-nepal.com.np/assets/img/image-2.png" alt="Company" style="width: 180px;"></div>
                      </div>
                      <div style="padding: 20px; background-color: rgb(255, 255, 255);">
                        <div style="color: rgb(0, 0, 0); text-align: left;">
                          <h1 style="margin: 1rem 0">Forgot Your Password?</h1>
                          <p style="padding-bottom: 16px">We have received a request to reset the password for this user account.</p>
                          <p style="padding-bottom: 16px"><a href="http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/changepassword.php?resetcode=' . $code . '" target="_blank"
                              style="padding: 12px 24px; border-radius: 4px; color: #FFF; background: #2B52F5;display: inline-block;margin: 0.5rem 0;">Reset
                              your password</a></p>
                          <p style="padding-bottom: 16px">If you did not ask to reset your password, you can ignore this email.</p>
                          <p style="padding-bottom: 16px">Thanks,<br>The Cinepal Team</p>
                        </div>
                      </div>
                      <div style="padding-top: 20px; color: rgb(153, 153, 153); text-align: center;">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </body></html>';

    $verifyquery = "SELECT * FROM users WHERE email = '$reset_email'";
    $result = $conn->query($verifyquery);

    $currenttime = time();
    $expirytime = $currenttime + (60 * 60);

    if ($result !== false && $result->num_rows > 0) {
        $codequery = "UPDATE users SET reset_code = '$code', expiry_time = '$expirytime' WHERE email = '$reset_email'";
        $sql = mysqli_query($conn, $codequery);
        $mail->send();
        $_SESSION['icons'] = "./img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "Reset Mail Sent Successfully. Please Check Your Email";
        header("Location: ../login.php");
    }
} catch (Exception $e) {
    $_SESSION['icons'] = "./img/alerticons/error.png";
    $_SESSION['status'] = "error";
    $_SESSION['status_code'] = "Message Couldn't be Sent in This Email";
    header("Location: ../resetpassword");
}
?>

<script src="../alerts/dist/js/iziToast.min.js"></script>
