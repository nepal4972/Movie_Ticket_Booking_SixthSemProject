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
  <title>Signup
    <?php echo $title ?>
  </title>
</head>

<body>

  <section class="container">
    <div class="form">
      <div class="form-content">
        <form action="<?php echo $base ?>config/updateprofile.inc" method="POST">
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
            <?php
          if(!empty($testimg)) { ?>
            <div class="profile-pic-upload">
              <label for="profile-pic" class="profile-pic-label">
                <img class="profile-img" id="image" src="./img/banners/profile.jpg" alt="">
                <input type="file" id="profile-pic" name="image" class="profile-pic-input">
                <ion-icon name="camera-reverse-outline" class="camera-icon"></ion-icon>
              </label>
              <a class="cancel-button">cancel</a>
              <button name="submit" class="ok-button">Update</button>
            </div>

            <?php }
          else { ?>
            <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
            <?php } ?>
            <h4 style="font-size:25px">Saugat Nepal</h4>
          </header>
          <br>
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
              <input hidden type="phone" name="phone_number" value="<?php echo $row['phone_number'] ?>">
            </div>
          </div>
          <div class="input-row">
            <div class="field">
              <button name="cancel">Cancel</button>
              <br><br>
            </div>
            <div class="field">
              <button name="submit">Update Profile</button>
            </div>
          </div>
        </form>
        <br><br>
      </div>
    </div>
  </section>

  <script>
    document.getElementByID("profile-pic").onchange = function () {
      document.getElementByID("image").src = URL.createObjectURL(fileImg.files[0]);

      document.getElementByID("image").src = URL.createObjectURL(fileImg.files[0]);
    }
  </script>

  <script src="<?php echo $jspath ?>"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>

<?php
include './includes/alert.php';
?>