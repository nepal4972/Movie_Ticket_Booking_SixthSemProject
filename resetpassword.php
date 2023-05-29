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
      <title>Reset Password <?php echo $title ?></title>
   </head>
   <body>
      <div class="login">
         <form action="<?php echo $base ?>config/resetpassword.inc" method="post" class="login_form">
         <h5 style="color:red;text-align:center;"><?php include './includes/alert.php';?></h5>
            <h1 class="login_title">Forgot Password</h1>
            <div class="login_content">
               <div class="login_box">
                  <i class="ri-mail-line login_icon"></i>
                  <div class="login_box-input">
                     <input type="text" name="reset_email" class="login_input" placeholder=" ">
                     <label for="" class="login_label">Enter Reset Email</label>
                  </div>
               </div>

            <button class="login_button" name="reset">Reset</button>

            <p class="login_register">
               <a href="<?php echo $base."login.php"?>">Go to Login</a>
            </p>
         </form>
      </div>
      <script src="<?php echo $jspath?>"></script>
      <?php
      include './includes/js.php';
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