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
      <link rel="stylesheet" href="<?php echo $csspath ?>">
      <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
      <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
      <title>Signup <?php echo $title ?></title>
   </head>
   <body>
      <div class="login">
         <form action="<?php echo $base ?>config/signup.inc" method="post" class="login_form">
            <h1 class="login_title">Signup</h1>
            <div class="login_content">
               <div class="login_box">
                  <i class="ri-user-3-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="text" required name="fullname" class="login_input" placeholder=" ">
                     <label for="" class="login_label">Full Name</label>
                  </div>
               </div>
               
               <div class="login_box">
                  <i class="ri-mail-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="email" required name="email" class="login_input" placeholder=" ">
                     <label for="" class="login_label">Email</label>
                  </div>
               </div>

               <div class="login_box">
                  <i class="ri-phone-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="tel" required name="phone_number" class="login_input" placeholder=" ">
                     <label for="" class="login_label">Phone Number</label>
                  </div>
               </div>
            
               <div class="login_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="password" required name="password" class="login_input" id="login-pass" placeholder=" ">
                     <label for="" class="login_label">Password</label>
                  </div>
               </div>

               <div class="login_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="password" required name="cpassword" class="login_input" id="login-pass" placeholder=" ">
                     <label for="" class="login_label">Confirm Password</label>
                  </div>
               </div>

            </div>

            <button class="login_button" name="submit">Signup</button>

            <p class="login_register">
               Don't have an account? <a href="<?php echo $base."login.php"?>">Login</a>
            </p>
         </form>
      </div>
      <script src="<?php echo $jspath ?>"></script>
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