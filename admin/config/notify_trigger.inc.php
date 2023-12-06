<?php
include '../../db/connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$trigid = $_GET['trigid'];

function ExecuteSQLQuery($sql)
{
      global $conn;
    $result = $conn->query($sql);

    if ($result === false) {
        die("SQL Error: " . $conn->error);
    }

    return $result;
}

// Function to initialize the email library
function InitializeEmailLibrary()
{
    require '../mail/Exception.php';
    require '../mail/PHPMailer.php';
    require '../mail/SMTP.php';
}

// Function to configure SMTP settings
function ConfigureSMTPSettings()
{
    global $mail;

    $mail = new PHPMailer(true);  // Create a new PHPMailer instance

    $mail->SMTPDebug = 0;  // Disable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'nepal4972@gmail.com';
    $mail->Password = 'rcobdwyowrcrhxwe';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
}

function SetEmailContent()
{
    global $mail;

    $mail->setFrom('nepal4972@gmail.com', 'mail@cinepal');
    $mail->isHTML(true);
    $mail->Subject = 'Movie Notification';
}

function SendEmailToRecipient($recipient, $trigid)
{
    global $mail;

    $mail->addAddress($recipient);
    $mail->Body = '<head>
    <title>Reset your password</title>
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
                                <h1 style="margin: 1rem 0">Movie Notification</h1>
                                <p style="padding-bottom: 16px"> We are excited to inform you that the movie you have been waiting for has been released!</p>
                                <p style="padding-bottom: 16px"><a href="http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/movie-details.php?id='.$trigid.'" 
                                    style="padding: 12px 24px; border-radius: 4px; color: #FFF; background: #2B52F5;display: inline-block;margin: 0.5rem 0;">Go To Movie detail</a></p>
                                <p style="padding-bottom: 16px">Enjoy the movie, and thank you for using our service!</p>
                                <p style="padding-bottom: 16px">If you have any further questions or need assistance, feel free to contact us.</p>
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

    try {
        $mail->send();
    } catch (Exception $e) {
        die("Error sending notification email: " . $e->getMessage());
    }

    $mail->clearAddresses();
}

if (isset($_GET['trigid'])) {
    $trigid = $_GET['trigid'];

    $sql = "SELECT userID FROM notify WHERE movieID = '$trigid'";
    $result = ExecuteSQLQuery($sql);

    if ($result !== false) {
        $recipients = [];

        while ($row = $result->fetch_assoc()) {
            $userID = $row['userID'];
            $emailQuery = "SELECT email FROM users WHERE userID = $userID";
            $emailResult = ExecuteSQLQuery($emailQuery);

            if ($emailResult !== false) {
                $row = $emailResult->fetch_assoc();
                $email = $row['email'];

                $recipients[] = $email;
            }
        }

        InitializeEmailLibrary();

        ConfigureSMTPSettings();

        SetEmailContent();

        foreach ($recipients as $recipient) {
          SendEmailToRecipient($recipient, $trigid);
        }

        $_SESSION['icons'] = "../img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "Notification Email Send To all Users.";
        header("Location: ../movies.php");
    }
}
?>
