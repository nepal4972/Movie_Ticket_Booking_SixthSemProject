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
      <div class="container">
         <form action="<?php echo $base ?>config/signup.inc" method="post" class="form">
            <h1 class="title">Signup</h1>
            <div class="content">
               <div class="input_box">
                  <i class="ri-user-3-line icon"></i>
                  <div class="input_type">
                     <input type="text" required name="fullname" class="input" placeholder=" ">
                     <label for="" class="label">Full Name</label>
                  </div>
               </div>
               
               <div class="input_box">
                  <i class="ri-mail-line icon"></i>
                  <div class="input_type">
                     <input type="email" required name="email" class="input" placeholder=" ">
                     <label for="" class="label">Email</label>
                  </div>
               </div>

               <div class="input_box">
                  <i class="ri-phone-line icon"></i>
                  <div class="input_type">
                     <input type="phone" required name="phone_number" class="input" placeholder=" ">
                     <label for="" class="label">Phone Number</label>
                  </div>
               </div>
            
               <div class="input_box">
                  <i class="ri-lock-2-line icon"></i>
                  <div class="input_type">
                     <input type="password" required name="password" class="input" id="login-pass" placeholder=" ">
                     <label for="" class="label">Password</label>
                  </div>
               </div>

               <div class="input_box">
                  <i class="ri-lock-2-line icon"></i>
                  <div class="input_type">
                     <input type="password" required name="cpassword" class="input" id="login-pass" placeholder=" ">
                     <label for="" class="label">Confirm Password</label>
                  </div>
               </div>

            </div>

            <button class="button" name="submit">Signup</button>

            <p class="switch">
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