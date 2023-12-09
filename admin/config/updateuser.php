<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$userID = $_GET['id'];  

$sql5 = "SELECT * FROM users WHERE userID = ?";
$stmt5 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt5, $sql5);
mysqli_stmt_bind_param($stmt5, "i", $userID);
mysqli_stmt_execute($stmt5);
$result5 = mysqli_stmt_get_result($stmt5);
$row5 = mysqli_fetch_assoc($result5);
?>

<?php
$id = $_GET['id'];
if (isset($_POST['update'])) {
    $file = $_FILES['profile_img'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    if (!empty($fileName)) {
        $file = $_FILES['profile_img'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileError === 0) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $uploadPath = '../../img/profile-img/' . $newFileName;
                $dbimgPath = 'img/profile-img/' . $newFileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $sql = "UPDATE users SET fullname = ?, email = ?, phone_number = ?, password = ?, user_type = ?, profile_img = ? WHERE userID = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssssi", $fullname, $email, $phone_number, $password, $user_type, $dbimgPath, $userID);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['icons'] = "./img/alerticons/success.png";
                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "User Updated Successfully";
                    header("Location: ../users.php");
                    exit();
                } else {
                    $_SESSION['icons'] = "./img/alerticons/error.png";
                    $_SESSION['status'] = "error";
                    $_SESSION['status_code'] = "Error Updating User Image";
                    header("Location: ../users.php");
                    exit();
                }
            } else {
                $_SESSION['icons'] = "./img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "File Upload Error";
                header("Location: ../users.php");
                exit();
            }
        } else {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Invalid file extension";
            header("Location: ../users.php");
            exit();
        }
    } else {
        $sql = "UPDATE users SET fullname = ?, email = ?, phone_number = ?, password = ?, user_type = ? WHERE userID = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $fullname, $email, $phone_number, $password, $user_type, $userID);
        mysqli_stmt_execute($stmt);

        $_SESSION['icons'] = "./img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "User Updated Successfully";
        header("Location: ../users.php");
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
    <title>Update User <?php echo $title ?></title>
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
      <div style="padding: 105px 35px;" class="form-container">
        <h2>Update User</h2>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name:</label>
              <input type="text" name="fullname" value="<?php echo $row5['fullname']?>">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" value="<?php echo $row5['email']?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Phone Number:</label>
              <input type="phone" name="phone_number" value="<?php echo $row5['phone_number']?>">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" value="<?php echo $row5['password']?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <div class="field">
                <span style="color: #232836;">User Role:</span><br>
                <select name="user_type">
                  <option value="<?php echo $row5['user_type']?>">Select User Type</option>
                  <option value="customer">Customer</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="image">Image:</label><br>
              <input type="file" style="color: #232836; height:35px; background-color:white" name="profile_img">
            </div>
          </div>
          <div class="form-row">
            <button type="submit" name="update" class="update-button">Update User</button>
          </div>
        </form>
      </div>
    </main>
    <script src="../assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
