<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
include './includes/loggedin.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>
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
  <title>My Profile <?php echo $title ?></title>
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
        <form action="<?php echo $base ?>config/updateprofile.inc" method="POST" enctype="multipart/form-data">
          <header>
            <h3 class="profile-header">My Profile</h3>
            <div class="input-row">
              <div class="field">
                <a class="disabled">My Profile</a>
              </div>
              <div class="field">
                <a href="./updatepassword.php">Update Password</a>
              </div>
            </div>
            <div class="profile-pic-upload">
              <label for="profile-pic" class="profile-pic-label">
                <?php
                if(!empty($row['profile_img'])) { ?>
                <img class="profile-img" id="image" src="<?php echo $row['profile_img']?>" alt="">
                <?php
                }else { ?>
                <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                <?php } ?>
                <input type="file" id="profile-pic" name="image" class="profile-pic-input">
                <ion-icon name="camera-reverse-outline" class="camera-icon"></ion-icon>
              </label>
              <button name="img-submit" class="ok-button">Upload/Update</button>
              <h4 style="font-size:25px">
                <?php echo $row['fullname'] ?>
              </h4>
            </div>
          </header>
          <br>
        </form>
        <form action="<?php echo $base ?>config/updateprofile.inc" method="POST">
          <div class="input-row">
            <div class="field">
              <span>Full Name:</span>
              <input type="text" name="fullname" value="<?php echo $row['fullname'] ?>">
            </div>
            <div class="field">
              <span>Email Address:</span>
              <input type="text" name="email" value="<?php echo $row['email'] ?>">
            </div>
          </div>

          <div class="input-row">
            <div class="field">
              <span>Phone Number:</span>
              <input type="phone" name="phone_number" value="<?php echo $row['phone_number'] ?>">
            </div>
            <div class="field">
              <span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
              <input hidden type="phone" value="<?php echo $row['phone_number'] ?>">
            </div>
          </div>
          <div class="input-row">
            <div class="field">
              <button name="cancel">Cancel/Close</button>
              <br><br>
            </div>
            <div class="field">
              <button name="update">Update Profile</button>
            </div>
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
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
include './includes/alert.php';
?>