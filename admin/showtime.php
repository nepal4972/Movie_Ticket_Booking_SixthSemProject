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

$sql2 = "SELECT * FROM movies WHERE CURRENT_DATE() >= release_date ORDER BY inserted_date DESC";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

function getAssignedShowtimes($conn, $movieID) {
    $assignedShowtimes = [];
    $sql = "SELECT st.show_time, mt.start_date, mt.end_date FROM movietime AS mt
            JOIN showtime AS st ON mt.showID = st.showID
            WHERE mt.movieID = ? ORDER BY st.show_time ASC";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $movieID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $assignedShowtimes[] = $row;
        }
    }
    
    return $assignedShowtimes;
}

$request = './config/deleteshowtime.php';
include './includes/confirmation.php';
?>

<style>
</style>

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
        <?php include './includes/header.php'; ?>
        <main>
            <div class="page-header">
                <h1>Movies</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <button onclick="toggleSections()">Assign Showtime/Default Showtime</button>
                        </div>
                        <div class="browse">
                            <a href="./config/addshowtime.php">Add Show Time</a>
                        </div>
                    </div>
                    <div id="section1">
                        <div class="page-header-small">
                            <h1>Assign Show Time For Showing Movies</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>&nbsp&nbsp&nbsp&nbspMovie Title With Show Times</th>
                                        <th>Assign Showtime</th>
                                        <th>Assign Start Date</th>
                                        <th>Assign End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $showingcount = 1;
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $movieID = $row2['movieID'];
                                        $assignedShowtimes = getAssignedShowtimes($conn, $movieID);
                                    ?>
                                    <tr>
                                        <td>#<?php echo $showingcount ?></td>
                                        <td>
                                        <div class="client">
                                                <div class="client-info">
                                                    <h4 style="text-align:center; font-size:16px;"><?php echo $row2['movie_name'] ?></h4>
                                                    <span style="font-weight: normal;"><?php
                                                        foreach ($assignedShowtimes as $showtime) {
                                                            echo date('h:i A', strtotime($showtime['show_time'])) . ' &rarr; ' . date('Y-m-d', strtotime($showtime['start_date'])) . ' - ' . date('Y-m-d', strtotime($showtime['end_date'])) . '<br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <form action="config/assignshowtime" method="POST">
                                            <input type="hidden" name="movieID" value="<?php echo $row2['movieID'] ?>">
                                            <div class="select-container">
                                                <select name="showtime">
                                                    <?php
                                                    mysqli_data_seek($result1, 0);
                                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                                        echo "<option value='{$row1['showID']}'>" . date('h:i A', strtotime($row1['show_time'])) . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="input-custom" type="date" name="start_date" min="<?php echo date('Y-m-d'); ?>" required>
                                        </td>
                                        <td>
                                            <input class="input-custom" type="date" name="end_date" min="<?php echo date('Y-m-d'); ?>" required>
                                        </td>
                                        <td>
                                            <div class="add">
                                                <button style="background:#ff595a;" type="submit">Assign Showtime</button>
                                            </div>
                                        </td>
                                        </form>
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
                                        <th>Show Times</th>
                                        <th> ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $showingcount1 = 1;
                                    mysqli_data_seek($result1, 0);
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $showingcount1 ?></td>
                                        <td>
                                            <div class="client-info">
                                                <h4><?php echo date('h:i A', strtotime($row1['show_time'])) ?></h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="./config/updateshowtime.php?id=<?php echo $row1['showID'] ?>">
                                                    <ion-icon name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/deleteshowtime.php?id=<?php echo $row1['showID'] ?>" onclick="return showConfirmation(event)">
                                                    <ion-icon name="trash-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $showingcount1++;
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
    </div>
</body>
</html>
<?php
include '../includes/alert.php';
?>
