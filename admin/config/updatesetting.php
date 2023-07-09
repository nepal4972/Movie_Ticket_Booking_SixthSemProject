<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';

if(isset($_POST['update_setting'])) {
    $file = $_FILES['site_logo'];
    $price = $_POST['seat_price'];
    $title = $_POST['site_title'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

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
                $uploadPath = '../../img/favicons/' . $newFileName;
                $dbimgPath = './img/favicons/' . $newFileName;

                // Move the uploaded file to the specified folder
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $sql = "UPDATE settings SET site_logo = '$dbimgPath', seat_price = '$price', site_title = '$title' WHERE settingID = '1'";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['icons'] = "../img/alerticons/success.png";
                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "Details Updated Successfully";
                    header("Location: ../settings.php");
                    exit();
                } else {
                    $_SESSION['icons'] = "../img/alerticons/error.png";
                    $_SESSION['status'] = "error";
                    $_SESSION['status_code'] = "Error Updating Image";
                    header("Location: ../settings.php");
                    exit();
                }
            } else {
                $_SESSION['icons'] = "../img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "File Upload Error";
                header("Location: ../settings.php");
                exit();
            }
        } else {
            $_SESSION['icons'] = "../img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Invalid file extension";
            header("Location: ../settings.php");
            exit();
        }
    } 
    else {
        $sql = "UPDATE settings SET site_title = '$title' WHERE settingID = '1'";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
    
        $_SESSION['icons'] = "../img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "Details Updated Successfully";
        header("Location: ../settings.php");
        exit();
    }
} elseif (isset($_POST['cancel'])) {
    header("Location: ../settings");
    exit();
} else {
    header("Location: ../settings");
    exit();
}
?>