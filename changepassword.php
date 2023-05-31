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
      <div class="container">
         <form action="<?php echo $base ?>config/changepassword.inc" method="post" class="form">
            <h1 class="title">Change Password</h1>
            <input hidden type="text" required name="resetcode" value="<?php echo $resetcode ?>">
            <div class="content">
               <div class="input_box">
                  <i class="ri-user-3-line icon"></i>
                  <div class="input_type">
                     <input type="text" required name="email" class="input" placeholder=" ">
                     <label for="" class="label">Email Address</label>
                  </div>
               </div>

               <div class="input_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="input_type">
                     <input type="password" required name="password" class="input" id="input_password" placeholder=" ">
                     <label for="" class="label">New Password</label>
                  </div>
               </div>

               <div class="input_box">
                  <i class="ri-lock-2-line login_icon"></i>
                  <div class="input_type">
                     <input type="password" required name="cpassword" class="input" id="input_password" placeholder=" ">
                     <label for="" class="label">Confirm New Password</label>
                  </div>
               </div>
            </div>
            <button class="button" name="submit">Change</button>
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