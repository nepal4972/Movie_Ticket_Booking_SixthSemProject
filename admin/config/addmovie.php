<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>

<?php
date_default_timezone_set('Asia/Kath  mandu');
$registerdate = date("Y-m-d");

if (isset($_POST['add'])) {
    $file = $_FILES['movie_banner'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $movie_name = $_POST['movie_name'];
    $videoID = $_POST['videoID'];
    $movie_duration = $_POST['movie_duration'];
    $release_date = $_POST['release_date'];
    $end_date = $_POST['end_date'];
    $movie_price = $_POST['movie_price'];
    $movie_description = $_POST['movie_description'];

    if (!empty($fileName)) {
        // Get the file extension
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        // Define allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

        // Check if the file extension is allowed
        if (in_array($fileExt, $allowedExtensions)) {
            // Check for file upload errors
            if ($fileError === 0) {
                // Generate a unique file name
                $newFileName = $fileName;

                // Specify the folder to store uploaded files
                $uploadPath = '../../img/banners/' . $newFileName;
                $dbimgPath = 'img/banners/' . $newFileName;

                // Move the uploaded file to the specified folder
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $sql = "INSERT INTO movies (movie_name, videoID, movie_duration, release_date, end_date, movie_description, movie_banner, movie_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "sssssssi", $movie_name, $videoID, $movie_duration, $release_date, $end_date, $movie_description, $dbimgPath, $movie_price);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['icons'] = "../img/alerticons/success.png";
                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "Movie Added Successfully";
                    header("Location: ../movies.php");
                    exit();
                } else {
                    $_SESSION['icons'] = "../img/alerticons/error.png";
                    $_SESSION['status'] = "error";
                    $_SESSION['status_code'] = "Error Uploading Movie Image";
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
        $sql = "INSERT INTO movies (movie_name, videoID, movie_duration, release_date, end_date, movie_description, movie_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $movie_name, $videoID, $movie_duration, $release_date, $end_date, $movie_description, $movie_price);
        mysqli_stmt_execute($stmt);

        $_SESSION['icons'] = "../img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "Movie Added Successfully";
        header("Location: ../movies.php");
        exit();
    }
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
        <h2>Add Movies</h2>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Movie Name:</label>
              <input type="text" name="movie_name" required>
            </div>
            <div class="form-group">
              <label for="confirm-password">Movie Image:</label><br>
              <input style="color: #232836; height:35px; background-color:white" type="file" name="movie_banner">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="text">Video ID:</label>
              <input type="text" name="videoID" required>
            </div>
            <div class="form-group">
                <label for="text">Duration(in minute):</label>
                <input type="text" name="movie_duration" required>
            </div>
            <div class="form-group">
                <label for="text">Price(Hall Price if blank):</label>
              <input type="text" name="movie_price">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="text">Release Date:</label>
              <input type="date" name="release_date">
            </div>
            <div class="form-group">
            <label for="text">End Date:</label>
              <input type="date" name="end_date">
            </div>
          </div>
          <div class="form-row">
          <div class="form-group">
              <label for="email">Movie Description:</label>
              <input style="height:45px" type="text" name="movie_description" required>
            </div>
          </div>
          <div class="form-row">
            <button type="submit" name="add" class="update-button">Add Movies</button>
          </div>
        </form>
      </div>
    </main>
    <script src="../assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>