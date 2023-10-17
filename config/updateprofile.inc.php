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

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    if (!empty($fileName)) {
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];

        if (in_array($fileExt, $allowedExtensions)) {

            if ($fileError === 0) {
                $newFileName = uniqid('', true) . '.' . $fileExt;

                $uploadPath = '../img/profile-img/' . $newFileName;
                $dbimgPath = 'img/profile-img/' . $newFileName;

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
} elseif (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND userID != '$userID'") or die ("Query Failed");
    $checkphone_number = mysqli_query($conn, "SELECT * FROM users WHERE phone_number = '$phone_number' AND userID != '$userID'") or die ("Query Failed");
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(mysqli_num_rows($checkEmail) > 0) {
            $_SESSION['icons'] = "./img/alerticons/warning.png";
            $_SESSION['status'] = "warning";
            $_SESSION['status_code'] = "This Email is Already Used";
            header("Location: ../profile.php");
            exit();                                         
        } else {
            if(mysqli_num_rows($checkphone_number) > 0) {
                $_SESSION['icons'] = "./img/alerticons/warning.png";
                $_SESSION['status'] = "warning";
                $_SESSION['status_code'] = "This Phone Number is Already Used or is Invalid";
                header("Location: ../profile.php");
                exit();
            } else {
                $sql = "UPDATE users SET fullname = '$fullname', email = '$email', phone_number = '$phone_number' WHERE userID = '$userID'";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_execute($stmt);
                $_SESSION['icons'] = "./img/alerticons/success.png";
                $_SESSION['status'] = "success";
                $_SESSION['status_code'] = "Profile Updated Successfully";
                header("Location: ../profile.php");
                exit();
                exit();
            }
        }
    } else {
        $_SESSION['icons'] = "./img/alerticons/warning.png";
        $_SESSION['status'] = "warning";
        $_SESSION['status_code'] = "Invalid Email";
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
