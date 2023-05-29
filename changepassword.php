<?php
include './db/connect.php';
include './includes/links.php';
?>

<?php
if(isset($_SESSION['fullname'])==null) {
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
      <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
      <link rel="stylesheet" href="<?php echo $csspath ?>">
      <title>Login <?php echo $title ?></title>
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
              <div class="login">
         <form action="<?php echo $base ?>config/changepassword.inc" method="POST" class="login_form">
            <h1 class="login_title">Change Password</h1>
            <input hidden type="text" required name="resetcode" value="<?php echo $resetcode ?>">
            <div class="login_content">
               <div class="login_box">
                  <i class="ri-user-3-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="text" required name="email" class="login_input" placeholder=" ">
                     <label for="" class="login_label">Email</label>
                  </div>
               </div>

               <div class="login_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="password" required name="password" class="login_input" id="login-pass" placeholder=" ">
                     <label for="" class="login_label">New Password</label>
                     <i class="ri-eye-off-line login_eye" id="login-eye"></i>
                  </div>
               </div>

               <div class="login_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="password" required name="cpassword" class="login_input" id="login-pass" placeholder=" ">
                     <label for="" class="login_label">New Confirm Password</label>
                     <i class="ri-eye-off-line login_eye" id="login-eye"></i>
                  </div>
               </div>
            </div>
            <button class="login_button" name="change">Change</button>
         </form>
      </div>
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
}
else {
   header("Location: ./errors/100.php");
}
?>

<?php
include './includes/alert.php';
?>