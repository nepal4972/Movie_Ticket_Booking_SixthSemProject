<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<?php
$sql1 = "SELECT * FROM users WHERE user_type = 'admin'";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
?>

<?php
$sql2 = "SELECT * FROM users WHERE user_type = 'customer'";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
?>

<?php
$request = './config/deleteuser.php';
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
    <title>Users <?php echo $title ?></title>
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
                <h1>Users</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <button onclick="toggleSections()">Admins/Customers</button>
                        </div>

                        <div class="browse">
                            <a href="./config/adduser.php">Add Users</a>
                        </div>
                    </div>
                    <div id="section1">
                        <div class="page-header-small">
                            <h1>Admins</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Admins</th>
                                        <th>Contact Number</th>
                                        <th>Register Date</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $admincount = 1;
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $admincount ?></td>
                                        <td>
                                            <div class="client">
                                                <img src="<?php echo $base?><?php echo $row1['profile_img'] ?>" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4><?php echo $row1['fullname'] ?></h4>
                                                    <small><?php echo $row1['email'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $row1['phone_number'] ?>
                                        </td>
                                        <?php
                                        $time1 = $row1['register_date'];
                                        $formattedtime1 = date("F d, Y", strtotime($time1));
                                        ?>
                                        <td>
                                            <?php echo $formattedtime1 ?>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="./config/updateuser.php?id=<?php echo $row1['userID']?>">
                                                    <ion-icon id="open-popup" name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/deleteuser.php?id=<?php echo $row1['userID']?>" onclick="return showConfirmation(event)">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $admincount++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="section2" class="hidden">
                        <div class="page-header-small">
                            <h1>Customers</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Customers</th>
                                        <th>Contact Number</th>
                                        <th>Register Date</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usercount = 1;
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $usercount ?></td>
                                        <td>
                                            <div class="client">
                                                <img src="<?php echo $base?><?php echo $row2['profile_img'] ?>" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4><?php echo $row2['fullname'] ?></h4>
                                                    <small><?php echo $row2['email'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $row2['phone_number'] ?>
                                        </td>
                                        <?php
                                        $time2 = $row2['register_date'];
                                        $formattedtime2 = date("F d, Y", strtotime($time2));
                                        ?>
                                        <td>
                                            <?php echo $formattedtime2 ?>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="./config/updateuser.php?id=<?php echo $row2['userID']?>">
                                                    <ion-icon  name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="./config/deleteuser.php?id=<?php echo $row2['userID']?>" onclick="return showConfirmation(event)">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $usercount++;
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