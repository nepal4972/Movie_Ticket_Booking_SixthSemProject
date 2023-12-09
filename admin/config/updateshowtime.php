<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>

<?php

$showtimeID = $_GET['id'];

$query = "SELECT * FROM showtime WHERE showID = $showtimeID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$show_time = $row['show_time'];


if(isset($_POST['update-showtime'])) {
  $posttime = $_POST['show_time'];
  $show_time1 = date("H:i:s", strtotime($posttime));

  $sql = "UPDATE showtime SET show_time = ? WHERE showID = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "si",$show_time1, $showtimeID);
  mysqli_stmt_execute($stmt);

  $_SESSION['icons'] = "../img/alerticons/success.png";
  $_SESSION['status'] = "success";
  $_SESSION['status_code'] = "showTime Updated Successfully";
  header("Location: ../showtime.php");
  exit();

}

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
    <title>Add Movies <?php echo $title ?></title>
</head>

<body>
  <input type="checkbox" id="menu-toggle">
  <div class="sidebar">
    <div class="side-header">
      <img src="<?php echo $base ?>img/favicons/<?php echo $sitelogo ?>" class="sidebar-logo" alt="">
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
            <a href="../users.php" class="menu-item">
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
            <a href="../showtime.php" style="background-color:#001233" class="menu-item">
              <ion-icon name="albums-outline"></ion-icon>
              <small>&nbsp&nbspShowTimes</small>
            </a>
          </li>
          <li>
            <a href="../carousel.php" class="menu-item">
              <ion-icon name="albums-outline"></ion-icon>
              <small>&nbsp&nbspCarousel</small>
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
      <div style="padding: 153px 35px;" class="form-container">
        <h2>Update Show Time</h2>
        <br><br><br><br>
        <form action="" method="POST">
          <div class="form-row">
            <div style="text-align:center;" class="form-group">
              <label for="name">Show Time:</label>
              <br>
              <input style="width:60%" type="time" name="show_time" value="<?php echo $show_time ?>" required>
              <input type="hidden" name="id" value="<?php echo $showtimeID ?>">
            </div>
            </div>
          <div class="form-row">
            <button type="submit" name="update-showtime" class="update-button">Update ShowTime</button>
          </div>
        </form>
      </div>
    </main>
    <script src="../assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>