<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
?>

<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$settingID = 1;

$sql5 = "SELECT * FROM settings WHERE settingID = ?";
$stmt5 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt5, $sql5);
mysqli_stmt_bind_param($stmt5, "i", $settingID);
mysqli_stmt_execute($stmt5);
$result5 = mysqli_stmt_get_result($stmt5);
$row5 = mysqli_fetch_assoc($result5);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Settings <?php echo $title ?> </title>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <?php include './includes/navbar.php'; ?>
    </div>
    <div class="main-content">
        <?php include './includes/header.php'; ?>
        <main>
            <div style="padding: 129px 35px;" class="form-container">
                <h2>Update Site Settings</h2>
                <br>
                <form action="./config/updatesetting" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="logo">Site Logo:</label><br>
                            <input type="file" name="site_logo">
                            <input type="hidden" name="hidden_logo" value="<?php echo $row5['site_logo']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="logo">Site Favicon:</label><br>
                            <input type="file" name="site_favicon">
                            <input type="hidden" name="hidden_favicon" value="<?php echo $row5['site_favicon']; ?>">
                        </div>
                    </div>
                    <br><br>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="text">Site Name:</label>
                            <input type="text" value="<?php echo $row5['site_title'] ?>" name="site_title">
                        </div>
                        <div class="form-group">
                            <label for="text">Hall Seat Price (in Rs):</label>
                            <input type="text" value="<?php echo $row5['seat_price'] ?>" name="seat_price">
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" name="update" class="update-button">Update Name/Price</button>
                    </div>
                </form>
            </div>
        </main>
        <script src="./assets/js/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
include '../includes/alert.php';
?>
