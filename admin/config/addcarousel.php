<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php

if (isset($_POST['add'])) {
    $file = $_FILES['carousel_image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $movieID = $_POST['movie_id'];

    if (!empty($fileName)) {
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileError === 0) {
                $newFileName = uniqid('', true) . '.' . $fileExt;

                $uploadPath = '../../img/carousel/' . $newFileName;
                $dbimgPath = $newFileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                if ($movieID !== null && $movieID !== '') {
                    $sql = "INSERT INTO carousel (carousel_image, movieID) VALUES ('$dbimgPath', '$movieID')";
                } else {
                    $sql = "INSERT INTO carousel (carousel_image) VALUES ('$dbimgPath')";
                }
                mysqli_query($conn, $sql);
                
                    $_SESSION['icons'] = "../img/alerticons/success.png";
                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "Carousel Added Successfully";
                    header("Location: ../carousel.php");
                    exit();
                } else {
                    $_SESSION['icons'] = "../img/alerticons/error.png";
                    $_SESSION['status'] = "error";
                    $_SESSION['status_code'] = "Error Adding Carousel Image";
                    header("Location: ../carousel.php");
                    exit();
                }
            } else {
                $_SESSION['icons'] = "../img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "File Upload Error";
                header("Location: ../carousel.php");
                exit();
            }
        } else {
            $_SESSION['icons'] = "../img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Invalid file extension";
            header("Location: ../carousel.php");
            exit();
        }
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
            <a href="../showtime.php" class="menu-item">
              <ion-icon name="albums-outline"></ion-icon>
              <small>&nbsp&nbspShowTimes</small>
            </a>
          </li>
          <li>
            <a href="../carousel.php" style="background-color:#001233" class="menu-item">
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
      <div style="padding: 176px 35px;" class="form-container">
        <h2>Add Carousel</h2>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
              <label for="name">Carousel Image:</label>
              <input style="color: #232836; height:35px; background-color:white" type="file" name="carousel_image" required>   
            </div>
            <div class="form-group">
              <label for="confirm-password">Assign For(or leave blank):</label><br>
            <div class="select-container">
            <select name="movie_id">
                <option value="">Select a Movie</option>
                <?php
                $sqlMovies = "SELECT movieID, movie_name FROM movies";
                $resultMovies = mysqli_query($conn, $sqlMovies);

                while ($rowMovie = mysqli_fetch_assoc($resultMovies)) {
                    echo "<option value='{$rowMovie['movieID']}'>{$rowMovie['movie_name']}</option>";
                }
                ?>
            </select>
            </div>
            </div>
          </div>

          <div class="form-row">
            <button type="submit" name="add" class="update-button">Add Carousel</button>
          </div>
        </form>
      </div>
    </main>
    <script src="../assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
