<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$movieID = $_GET['id'];  

$sql5 = "SELECT * FROM movies WHERE movieID = ?";
$stmt5 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt5, $sql5);
mysqli_stmt_bind_param($stmt5, "i", $movieID);
mysqli_stmt_execute($stmt5);
$result5 = mysqli_stmt_get_result($stmt5);
$row5 = mysqli_fetch_assoc($result5);
?>


<?php

$id = $_GET['id'];
if (isset($_POST['update'])) {
    $file = $_FILES['movie_banner'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $movie_name = $_POST['movie_name'];
    $movie_description = $_POST['movie_description'];
    $movie_price = $_POST['movie_price'];
    $videoID = $_POST['videoID'];
    $movie_duration = $_POST['movie_duration'];
    $release_date = $_POST['release_date'];
    $end_date = $_POST['end_date'];

    if (!empty($fileName)) {
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileError === 0) {
                $newFileName = uniqid('', true) . '.' . $fileExt;

                $uploadPath = '../../img/banners/' . $newFileName;
                $dbimgPath = 'img/banners/' . $newFileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $sql = "UPDATE movies SET movie_name = ?, movie_description = ?, movie_price = ?, videoID = ?, movie_duration = ?, release_date = ?, end_date = ?, movie_banner = ? WHERE movieID = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssssssi", $movie_name, $movie_description, $movie_price, $videoID, $movie_duration, $release_date, $end_date, $dbimgPath, $movieID);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['icons'] = "../img/alerticons/success.png";
                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "Movie Updated Successfully";
                    header("Location: ../movies.php");
                    exit();
                } else {
                    $_SESSION['icons'] = "../img/alerticons/error.png";
                    $_SESSION['status'] = "error";
                    $_SESSION['status_code'] = "Error Updating Movie Image";
                    header("Location: ../movies.php");
                    exit();
                }
            } else {
                $_SESSION['icons'] = "../img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "File Upload Error";
                header("Location: ../movies.php");
                exit();
            }
        } else {
            $_SESSION['icons'] = "../img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Invalid file extension";
            header("Location: ../movies.php");
            exit();
        }
    } else {
        $sql = "UPDATE movies SET movie_name = ?, movie_description = ?, movie_price = ?, videoID = ?, movie_duration = ?, release_date = ?, end_date = ? WHERE movieID = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $movie_name, $movie_description, $movie_price, $videoID, $movie_duration, $release_date, $end_date, $movieID);
        mysqli_stmt_execute($stmt);

        $_SESSION['icons'] = "../img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "Movie Updated Successfully";
        header("Location: ../movies.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Update Movies <?php echo $title ?></title>
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
            <a href="../movies.php" style="background-color:#001233" class="menu-item">
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
            <a href="../showtime.php" class="menu-item">
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
      <div style="padding: 61px 35px;" class="form-container">
        <h2>Update Movies</h2>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Movie Name:</label>
              <input type="text" value="<?php echo $row5['movie_name']?>" name="movie_name">
            </div>
            <div class="form-group">
              <label for="confirm-password">Movie Image:</label><br>
              <input style="color: #232836; height:35px; background-color:white" type="file" name="movie_banner">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="text">Video ID:</label>
              <input type="text" value="<?php echo $row5['videoID']?>" name="videoID" required>
            </div>
            <div class="form-group">
                <label for="text">Duration(in minute):</label>
                <input type="text" value="<?php echo $row5['movie_duration']?>" name="movie_duration" required>
            </div>
            <div class="form-group">
                <label for="text">Price(Hall Price if blank):</label>
              <input type="text" value="<?php echo $row5['movie_price']?>" name="movie_price" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="text">Release Date:</label>
              <input type="date" value="<?php echo $row5['release_date']?>" name="release_date">
            </div>
            <div class="form-group">
            <label for="text">End Date:</label>
              <input type="date" value="<?php echo $row5['end_date']?>" name="end_date" min="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>
          <div class="form-row">
          <div class="form-group">
              <label for="text">Movie Description:</label>
              <input style="height:45px" value="<?php echo $row5['movie_description']?>" type="text" name="movie_description" required>
            </div>
          </div>
          <div class="form-row">
            <button type="submit" name="update" class="update-button">Update Movie</button>
          </div>
        </form>
      </div>
    </main>
    <script src="../assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
