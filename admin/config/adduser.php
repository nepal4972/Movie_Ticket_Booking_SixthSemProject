<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Add Users <?php echo $title ?></title>
</head>

<body>
  <input type="checkbox" id="menu-toggle">
  <div class="sidebar">
    <div class="side-header">
    <?php if($sitelogo == './img/favicons/whitecinepal.jpg') { ?>
    <img src="<?php echo $imglogopath?>orangecinepal.jpg" class="sidebar-logo" alt="">
    <?php }
    else {?>
        <img src="<?php echo $base ?><?php echo $sitelogo ?>" class="sidebar-logo" alt="">
    <?php }?>
    </div>
    <br>
    <div class="side-content">
      <div class="side-menu">
        <ul>
          <li>
            <a href="../" class="menu-item">
              <ion-icon name="home-outline"></ion-icon>
              <small>&nbsp&nbspDashboard</small>
            </a>
          </li>
          <li>
            <a href="../users.php" style="background-color:#001233" class="menu-item">
              <ion-icon name="people-outline"></ion-icon>
              <small>&nbsp&nbspUsers</small>
            </a>
          </li>
          <li>
            <a href="../movies.php" class="menu-item">
              <ion-icon name="videocam-outline"></ion-icon>
              <small>&nbsp&nbspMovies</small>
            </a>
          </li>
          <li>
            <a href="../bookings.php" class="menu-item">
              <ion-icon name="bookmarks-outline"></ion-icon>
              <small>&nbsp&nbspBookings</small>
            </a>
          </li>
          <li>
            <a href="./slider.php" class="menu-item">
              <ion-icon name="albums-outline"></ion-icon>
              <small>&nbsp&nbspSliders</small>
            </a>
          </li>
          <li>
            <a href="../settings.php" class="menu-item">
            <ion-icon name="settings-outline"></ion-icon>
            <small>&nbsp&nbspSettings</small>
            </a>
            </li>
        </ul>
      </div>
    </div>

  </div>
  <div class="main-content">
    <?php include '../includes/header.php'; ?>
    <main>
      <div class="form-container">
        <h2>Add Users</h2>
        <br>
        <form action="formprocess.php" method="GET">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name:</label>
              <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Phone Number:</label>
              <input type="phone" name="phone_number" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <div class="field">
                <span style="color: #232836;">User Role:</span> <br>
                <select name="user_type" required>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="confirm-password">Image:</label><br>
              <input style="color: #232836; height:35px; background-color:white" type="file" name="profile_img" required>
            </div>
          </div>
          <div class="form-row">
            <button type="button" name="cancel" class="close-form-btn">Cancel</button>
            <button type="submit" name="add" class="update-button">Add User</button>
          </div>
        </form>
      </div>
    </main>
    <script src="../assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>