<?php
include './db/connect.php';
include './includes/links.php';
?>

<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
      <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
      <link rel="stylesheet" href="<?php echo $csspath ?>">
      <title>Change Password <?php echo $title ?></title>
   </head>
   <body>

   <?php
   if(isset($_GET['resetcode'])) {
    $resetcode = $_GET['resetcode'];
    if(empty($resetcode)) {
        $_SESSION['icons']="./img/alerticons/error.png";
        $_SESSION['status']="error";
        $_SESSION['status_code']="There is No Reset Code. Reset Again";
        header("Location: ./resetpassword.php");
        exit();         
    }
    else {?>
<section class="container">
            <div class="form">
                <div class="form-content">
                    <header>Change Password</header>
                    <form method="POST" action="./config/changepassword.inc">
                            <input type="text" hidden name="resetcode" value="<?php echo $resetcode ?>">
                        <div class="field">
                            <input type="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Create New Password">
                        </div>
                        <div class="field">
                            <input type="password" name="cpassword" placeholder="Confirm Password">
                        </div>

                        <div class="field">
                            <button class="change" name="change">Reset</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <a href="./login.php" class="link signup-link">Go To Login</a>
                    </div>
                </div>
            </div>
        </section>
      <script src="<?php echo $jspath ?>"></script>
      <?php
      ?>
   </body>
</html>
    <?php
    }
   }
   else {
    $_SESSION['icons']="./img/alerticons/error.png";
    $_SESSION['status']="error";
    $_SESSION['status_code']="No Variable Set";
    header("Location: ./resetpassword.php");
    exit();         
   }
   ?>

<?php
include './includes/alert.php';
?>