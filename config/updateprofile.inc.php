<?php
include '../db/connect.php';
include '../includes/links.php';
?>

<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">

<?php
$userID = $_SESSION['userID'];
$sql = "SELECT * FROM users WHERE userID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if(isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    echo $filename;

    // Check if an image is selected
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
                $uploadPath = '../img/profile-img/' . $newFileName;
                $dbimgPath = './img/profile-img/' . $newFileName;

                // Move the uploaded file to the specified folder
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $sql = "UPDATE users SET profile_img = '$dbimgPath' WHERE userID = '$userID'";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['icons'] = "./img/alerticons/success.png";
                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "Image Uploaded Successfully";
                    header("Location: ../profile.php");
                    exit();

                } else {
                    $_SESSION['icons'] = "./img/alerticons/error.png";
                    $_SESSION['status'] = "error";
                    $_SESSION['status_code'] = "Error Uploading File";
                    header("Location: ../profile.php");
                    exit();
                }
            } else {
                $_SESSION['icons'] = "./img/alerticons/error.png";
                $_SESSION['status'] = "error";
                $_SESSION['status_code'] = "File Upload Error";
                header("Location: ../profile.php");
                exit();
            }
        } else {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Invalid file extension";
            header("Location: ../profile.php");
            exit();
        }
    } else {
        $_SESSION['icons'] = "./img/alerticons/error.png";
        $_SESSION['status'] = "error";
        $_SESSION['status_code'] = "Please select an image.";
        header("Location: ../profile.php");
        exit();
    }
} elseif (isset($_POST['cancel'])) {
    header("Location: ../");
    exit();
} else {
    header("Location: ../");
    exit();
}
?>

<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
include '../includes/alert.php';
?>
``
