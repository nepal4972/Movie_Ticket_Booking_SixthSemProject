<?php
include './db/connect.php';
include './includes/links.php';
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
        <title>Reset Password <?php echo $title ?></title>    
    </head>
    <body>
        <section class="container">
            <div class="form">
                <div class="form-content">
                    <header>Forgot Password</header>
                    <form method="POST" action="<?php echo $base ?>config/resetpassword.inc">
                        <div class="field">
                            <input type="email" name="reset_email" placeholder="Email">
                        </div>

                        <div class="field">
                            <button class="reset" name="reset">Reset</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <a href="./login.php" class="link signup-link">Go To Login</a>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?php echo $jspath ?>"></script>
    </body>
</html>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
include './includes/alert.php';
?>