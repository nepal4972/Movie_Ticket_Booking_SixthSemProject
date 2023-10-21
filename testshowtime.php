<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
?>

<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$sql1 = "SELECT * FROM showtime";
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
                <h1>Show Time</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <input type="search" placeholder="Search">
                            <button name="search">Search</button>&nbsp&nbsp&nbsp&nbsp
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
                                        <th>Movie Title</th>
                                        <th>Showtime</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $showingcount = 1;
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $showingcount ?></td>
                                        <td><?php echo $row2['movie_name'] ?></td>
                                        <td>
                                            <select name="showtime">
                                                <?php
                                                mysqli_data_seek($result1, 0); // Reset the showtime result pointer
                                                while($row1 = mysqli_fetch_assoc($result1)) {
                                                    echo "<option value='{$row1['showID']}'>{$row1['show_time']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <button>Assign Showtime</button>
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
