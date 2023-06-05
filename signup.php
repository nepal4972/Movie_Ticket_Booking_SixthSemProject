<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
if(isset($_SESSION['fullname'])==null) {
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="<?php echo $csspath ?>">
       <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
       <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
      <title>Signup <?php echo $title ?></title>
                        
    </head>

    <?php
    $fullname = $_GET['fullname'];
    $email = $_GET['email'];
    $phone_number = $_GET['phone_number'];
    ?>

    <body>
        <section class="container">
            <div class="form">
                <div class="form-content">
                    <header>Signup</header>
                    <form action="<?php echo $base ?>config/signup.inc" method="POST">
                        <div class="field">
                            <input type="text" name="fullname" placeholder="Enter Your Full Name" value="<?php echo $fullname?>">
                        </div>

                        <div class="field">
                            <input type="text" name="email" placeholder="Enter Your Email" value="<?php echo $email?>">
                        </div>

                        <div class="field">
                            <input type="phone" name="phone_number" placeholder="Enter Your Phone" value="<?php echo $phone_number?>">
                        </div>

                        <div class="field">
                            <input type="password" name="password" placeholder="Create Your password" class="password">
                        </div>
                        
                        <div class="field">
                            <input type="password" name="cpassword"placeholder="Confirm password" class="password">
                        </div>

                        <div class="field">
                            <button name="submit">Signup</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="<?php echo $base."login.php"?>" class="link login-link">Login</a></span>
                    </div>
                </div>
            </div>
        </section>
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