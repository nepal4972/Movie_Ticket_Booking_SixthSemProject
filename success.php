<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #001242;
}

.container {
    text-align: center;
}

.payment-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.tick-icon {
    color: #00c853;
    font-size: 5rem;
    margin-bottom: 20px;
}

.payment-success {
    margin-bottom: 20px;
}

.return-home .btn {
    display: inline-block;
    background-color: #00c853;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.return-home .btn:hover {
    background-color: #0056b3;
}

</style>

<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
include './includes/loggedin.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.3/css/ionicons.min.css">
    <title>Payment Success <?php echo $title ?></title>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <div class="tick-icon">
                <ion-icon name="checkmark-done-circle-outline"></ion-icon>
            </div>
            <div class="payment-success">
                <h1>Booking Successfull</h1>
                <p>Check Your Email</p>
                <p>or Download Your ticket from my tickets page.</p>
            </div>
            <div class="return-home">
                <a href="./" class="btn">Go to homepage</a>
            </div>
        </div>
    </div>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
