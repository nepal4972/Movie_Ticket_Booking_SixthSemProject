<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
$testimg = "s";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo $profilecss ?>">
  <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
  <title>Update Password <?php echo $title ?></title>
</head>

<body>
<?php
$userID = $_SESSION['userID'];
$sql = "SELECT * FROM users WHERE userID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if($row = mysqli_fetch_assoc($result)) {
?>
  <section class="container">
    <div class="form">
      <div class="form-content">
        <form action="<?php echo $base ?>config/updatepassword.inc" method="POST">
          <header>
            <h3 class="profile-header">Update Password</h3>
            <div class="input-row">
            <div class="field">
              <a href="./profile.php" class="">My Profile</a>
            </div>
            <div class="field disabled">
            <a href="./updatepassword.php">Update Password</a>
            </div>
          </div>
            <?php
          if(!empty($testimg)) { ?>

            <?php }
          else { ?>
            <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
            <?php } ?>
          </header>
          <br>
          <div class="input-row">
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="field">
              <input type="password" name="oldpassword" placeholder="Old Password">
            </div>
            <div class="field">
              <input hidden type="phone" placeholder="Old Password">
            </div>
          </div>
          <div class="input-row">
            <div class="field">
              <input type="password" name="password" placeholder="New Password" >
            </div>
            <div class="field">
              <input type="password" name="cpassword" placeholder="Confirm New Password">
            </div>
          </div>

          <div class="input-row">
            <div class="field">
              <button name="cancel">Cancel/Close</button>
              <br><br>
            </div>
            <div class="field">
              <button name="submit">Change Password</button>
            </div>
          </div>
          <div class="form-link">
            <a href="<?php echo $base."resetpassword.php"?>" class="forgot-pass">Forgot password?</a>
          </div>
        </form>
        <br><br>
      </div>
    </div>
  </section>

  <script src="<?php echo $jspath ?>"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<?php
}
else {
  $_SESSION['icons']="./img/alerticons/error.png";
  $_SESSION['status']="error";
  $_SESSION['status_code']="Invalid User. Login First";
  header("Location: ./");
  exit();
}
?>

</html>
<?php
include './includes/alert.php';
?>