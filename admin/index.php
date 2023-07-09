<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
include './includes/confirmation.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
<script src="../assets/home/js/script.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Dashboard <?php echo $title ?></title>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <?php
    include './includes/navbar.php';
    ?>
    </div>
    <div class="main-content">
        <?php
        include './includes/header.php';
        ?>
        <main>
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>
            <div class="page-content">
                <div class="analytics">
                    <div class="card">
                        <div class="card-head">
                            <h2>5</h2>
                            <ion-icon style="font-size:50px" name="people-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>Total Users</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>5</h2>
                            <ion-icon style="font-size:50px" name="videocam-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>Showing Movies</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>4</h2>
                            <ion-icon style="font-size:50px" name="videocam-off-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>upcoming Movies</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>28</h2>
                            <ion-icon style="font-size:50px" name="bookmarks-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>Total Bookings</small>
                        </div>
                    </div>
                </div>

                <div class="page-content">
                    <div class="records table-responsive">
                            <div class="page-header-small">
                                <h1>Recent bookings</h1>
                            </div>
                            <br>
                            <div>
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Booked Movie</th>
                                            <th>Booked By</th>
                                            <th>Booked Seats</th>
                                            <th>Booked Date</th>
                                            <th>Booked Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1</td>
                                            <td>
                                                <h4>Lakhey</h4>
                                            </td>
                                            <td>
                                            <div class="client">
                                                <img src="<?php echo $imglogopath?>../profile-img/profile.jpg" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4>Saugat Nepal</h4>
                                                    <small>nepal4972@gmail.com</small>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                F1, F2, C4
                                            </td>
                                            <td>
                                                11 June, 2023
                                            </td>
                                            <td>
                                                12:45 PM
                                            </td>
                                            <td>
                                                Booked
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#2</td>
                                            <td>
                                                <h4>Fulbari</h4>
                                            </td>
                                            <td>    
                                            <div class="client">
                                                <img src="<?php echo $imglogopath?>../profile-img/profile.jpg" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4>Saugat Nepal</h4>
                                                    <small>nepal4972@gmail.com</small>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                C2, C5, C6
                                            </td>
                                            <td>
                                                11 June, 2023
                                            </td>
                                            <td>
                                                9:45 AM
                                            </td>
                                            <td>
                                                Sold
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="./assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>