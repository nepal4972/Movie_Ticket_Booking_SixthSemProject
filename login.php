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
      <div class="container">
         <form action="<?php echo $base ?>config/login.inc" method="post" class="form">
            <h1 class="title">Login</h1>
            <div class="content">
               <div class="input_box">
                  <i class="ri-user-3-line icon"></i>
                  <div class="input_type">
                     <input type="text" required name="fullname" class="input" placeholder=" ">
                     <label for="" class="label">Email or Number</label>
                  </div>
               </div>

               <div class="input_box">
                  <i class="ri-lock-2-line icon"></i>
                  <div class="input_type">
                     <input type="password" required name="password" class="input" id="input_password" placeholder=" ">
                     <label for="" class="label">Password</label>
                     <i class="ri-eye-off-line pw_hide" id="pw_hide"></i>
                  </div>
               </div>
            </div>

            <div class="reset_pw">
                  <a href="<?php echo $base."resetpassword.php"?>" name="forgot" class="btn_forgot">Forgot Password?</a>
            <br>
            <br>
            <button class="button" name="submit">Login</button>

            <p class="switch">
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