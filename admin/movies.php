<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$sql1 = "SELECT * FROM movies WHERE CURRENT_DATE() BETWEEN release_date AND end_date ORDER BY inserted_date DESC";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
?>

<?php
$sql2 = "SELECT * FROM movies WHERE CURRENT_DATE() < release_date ORDER BY inserted_date DESC";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
?>

<?php
$request = './config/deletemovie.php';
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
    <title>Movies <?php echo $title ?></title>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <?php include './includes/navbar.php'; ?>
    </div>
    <div class="main-content">
        <?php include './includes/header.php' ; ?>
        <main>
            <div class="page-header">
                <h1>Movies</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <button onclick="toggleSections()">Showing/Upcoming</button>
                        </div>

                        <div class="browse">
                            <a href="./config/addmovie.php">Add Movies</a>
                        </div>
                    </div>
                    <div id="section1">
                        <div class="page-header-small">
                            <h1>Now Showing Movies</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Movie Name</th>
                                        <th>Movie Thumbnail</th>
                                        <th>Movie Price</th>
                                        <th>Ending Date</th>
                                        <th>Video ID</th>
                                        <th> ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $showingcount = 1;
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $showingcount ?></td>
                                        <td>
                                            <div class="client-info">
                                                <h4><?php echo $row1['movie_name'] ?></h4>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="<?php echo $base?><?php echo $row1['movie_banner'] ?>" class="client-img" alt="Image">
                                        </td>
                                        <td>
                                            <?php
                                            if(!$row1['movie_price'] == null) { ?>
                                            <?php echo $row1['movie_price'];    
                                            }
                                            else {
                                                echo 'Hall Price';
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        $time1 = $row1['end_date'];
                                        $formattedtime1 = date("F d, Y", strtotime($time1));
                                        ?>
                                        <td>
                                        <?php echo $formattedtime1 ?>
                                        </td>
                                        <td>
                                        <?php echo $row1['videoID'] ?>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="./config/updatemovie.php?id=<?php echo $row1['movieID']?>">
                                                    <ion-icon name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/deletemovie.php?id=<?php echo $row1['movieID']?>" onclick="return showConfirmation(event)">
                                                    <ion-icon name="trash-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/notify_trigger.inc.php?trigid=<?php echo $row1['movieID']?>">
                                                    <ion-icon name="notifications-outline"></ion-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $showingcount++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="section2" class="hidden">
                        <div class="page-header-small">
                            <h1>Upcoming Movies</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Movie Name</th>
                                        <th>Movie Thumbnail</th>
                                        <th>Movie Price</th>
                                        <th>Releasing Date</th>
                                        <th>Video ID</th>
                                        <th> ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $upcount = 1;
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $upcount ?></td>
                                        <td>
                                            <div class="client-info">
                                                <h4><?php echo $row2['movie_name'] ?></h4>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="<?php echo $base?><?php echo $row2['movie_banner'] ?>" class="client-img" alt="Image">
                                        </td>
                                        <td>
                                        <?php
                                            if(!$row2['movie_price'] == null) { ?>
                                            <?php echo $row2['movie_price'];    
                                            }
                                            else {
                                                echo 'Hall Price';
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        $time2 = $row1['release_date'];
                                        $formattedtime2 = date("F d, Y", strtotime($time1));
                                        ?>
                                        <td>
                                            <?php echo $formattedtime2 ?>
                                        </td>
                                        <td>
                                            <?php echo $row2['videoID'] ?>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="./config/updatemovie.php?id=<?php echo $row2['movieID']?>">
                                                    <ion-icon name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/deletemovie.php?id=<?php echo $row2['movieID']?>" onclick="return showConfirmation(event)">
                                                    <ion-icon name="trash-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $upcount++;
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