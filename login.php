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
      <link rel="stylesheet" href="./alerts/iziToast-master/dist/css/iziToast.min.css">
      <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
      <link rel="stylesheet" href="<?php echo $csspath ?>">
      <title>Login <?php echo $title ?></title>
   </head>
   <body>
      <div class="login">
         <form action="<?php echo $base ?>config/login.inc" method="post" class="login_form">
            <h1 class="login_title">Login</h1>
            <div class="login_content">
               <div class="login_box">
                  <i class="ri-user-3-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="text" required name="fullname" class="login_input" placeholder=" ">
                     <label for="" class="login_label">Email or Number</label>
                  </div>
               </div>

               <div class="login_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="password" required name="password" class="login_input" id="login-pass" placeholder=" ">
                     <label for="" class="login_label">Password</label>
                     <i class="ri-eye-off-line login_eye" id="login-eye"></i>
                  </div>
               </div>
            </div>

            <div class="login_check">
               <div class="login_check-group">
                  <input type="checkbox" class="login_check-input">
                  <label for="" class="login_check-label">Remember me</label>

                  <a href="<?php echo $base."resetpassword.php"?>" name="forgot" class="login_forgot">Forgot Password?</a>
               </div>
            </div>

            <button class="login_button" name="login_submit">Login</button>

            <p class="login_register">
               Don't have an account? <a href="<?php echo $base."signup.php"?>">Signup</a>
            </p>
         </form>
      </div>
      <script src="<?php echo $jspath ?>"></script>
      <?php
      ?>
   </body>
</html>
<?php
}
else {
   header("Location: ./errors/100.php");
}
?>

<?php
include './includes/alert.php';
?>