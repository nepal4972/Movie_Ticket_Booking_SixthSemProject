<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php

if (isset($_COOKIE['remember_email'])) {
    $rememberedEmail = base64_decode($_COOKIE['remember_email']);
} else {
    $rememberedEmail = '';
}

if (isset($_COOKIE['remember_password'])) {
    $rememberedPassword = $_COOKIE['remember_password'];
} else {
    $rememberedPassword = '';
}

if(isset($_SESSION['fullname'])==null) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $csspath ?>">
    <title>Login
        <?php echo $title ?>
    </title>
</head>

<?php
    $email = $_GET['email'];
    ?>

<body>
    <section class="container">
        <div class="form">
            <div class="form-content">
                <header>Login</header>
                <form action="<?php echo $base ?>config/login.inc" method="POST">
                    <div class="field">
                        <input type="text" name="fullname" placeholder="Email or Phone" class="input"
                        value="<?php echo $rememberedEmail?>">
                    </div>

                    <div class="field">
                        <input type="password" name="password" placeholder="Password" class="password" 
                        value="<?php echo $rememberedPassword ?>">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <label class="remember-me-label">
                            <input type="checkbox" name="remember-me">
                            <span>Remember Me</span>
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo $base."resetpassword.php"?>" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field">
                        <button name="submit">Login</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account? <a href="./signup.php" class="link signup-link">Signup</a></span>
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
