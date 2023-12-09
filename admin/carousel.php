<?php
include '../db/connect.php';
include '../includes/links.php';
include './config/verifyadmin.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$userID = $_SESSION['userID'];

$sql = "SELECT c.*, m.*
FROM carousel c
LEFT JOIN movies m ON c.movieID = m.movieID";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<?php
$request = './config/deletecarousel.php';
include './includes/confirmation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Carousel <?php echo $title ?></title>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <?php include './includes/navbar.php'; ?>
    </div>
    <div class="main-content">
        <?php include './includes/header.php'; ?>
        <main>
            <div class="page-header">
                <h1>Carousel</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                <div class="record-header">
                        <div class="add">
                        </div>

                        <div class="browse">
                            <a href="./config/addcarousel.php">Add Carousel</a>
                        </div>
                    </div>
                    <div id="section2">
                        <div class="page-header-small">
                            <h1>Carousel</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Assigned Movie</th>
                                        <th>Carousel Image</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $count ?></td>
                                        <?php
                                        if($row['movie_name'] == null) { ?>
                                            <td>Movie Not Assigned</td>
                                        <?php } else { ?>
                                            <td><?php echo $row['movie_name'] ?></td>
                                        <?php }
                                        ?>
                                        <td>
                                            <div class="client">
                                                <img src="<?php echo $base ?>img/carousel/<?php echo $row['carousel_image'] ?>" style="height: 80px;width: 140px;margin-right: 1rem;" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="./config/updatecarousel.php?id=<?php echo $row['carouselID']?>">
                                                    <ion-icon name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/deletecarousel.php?id=<?php echo $row['carouselID']?>" onclick="return showConfirmation(event)">
                                                    <ion-icon name="trash-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="./assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

<?php
include '../includes/alert.php';
?>