<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';

if (isset($_POST['update'])) {
    $setting_id = 1;
    $newSiteTitle = $_POST['site_title'];
    $newSeatPrice = $_POST['seat_price'];

    $newSiteLogo = $_POST['hidden_logo'];
    $newSiteFavicon = $_POST['hidden_favicon'];

    // Handle site logo upload
    if (!empty($_FILES['site_logo']['name'])) {
        $file = $_FILES['site_logo'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileError === 0) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $uploadPath = '../../img/favicons/' . $newFileName;
                $newSiteLogo = $newFileName;

                move_uploaded_file($fileTmpName, $uploadPath);
            }
        }
    }

    // Handle site favicon upload
    if (!empty($_FILES['site_favicon']['name'])) {
        $file = $_FILES['site_favicon'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileError === 0) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $uploadPath = '../../img/favicons/' . $newFileName;
                $newSiteFavicon = $newFileName;

                move_uploaded_file($fileTmpName, $uploadPath);
            }
        }
    }

    $sql = "UPDATE settings SET site_title = ?, seat_price = ?, site_logo = ?, site_favicon = ? WHERE settingID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $newSiteTitle, $newSeatPrice, $newSiteLogo, $newSiteFavicon, $setting_id);
    mysqli_stmt_execute($stmt);

    $_SESSION['icons'] = "../img/alerticons/success.png";
    $_SESSION['status'] = "success";
    $_SESSION['status_code'] = "Updated Successfully";
    header("Location: ../settings.php");
    exit();

} else {
    $_SESSION['icons'] = "../img/alerticons/error.png";
    $_SESSION['status'] = "error";
    $_SESSION['status_code'] = "SQL Error";
    header("Location: ../settings.php");
    exit();
}
?>