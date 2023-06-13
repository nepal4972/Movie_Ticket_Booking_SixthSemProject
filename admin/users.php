<?php
include '../db/connect.php';
include '../includes/links.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>

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
                            <input type="search" placeholder="Search">
                            <button name="search">Search</button>&nbsp&nbsp&nbsp&nbsp
                            <button onclick="toggleSections()">Admins/Users</button>
                        </div>

                        <div class="browse">
                            <select name="" id="">
                                <option value="">Date Registered</option>
                            </select>
                            <a href="./adduser.php">Add Users</a>
                        </div>
                    </div>
                    <div id="section1" class="hidden">
                        <div class="page-header-small">
                            <h1>Admins</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Admins</th>
                                        <th>Contact Number</th>
                                        <th>Register Date</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#1</td>
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
                                            9800000000
                                        </td>
                                        <td>
                                            11 June, 2023
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="">
                                                    <ion-icon id="open-popup" name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#2</td>
                                        <td>
                                            <div class="client">
                                                <img src="<?php echo $imglogopath?>../profile-img/profile.jpg" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4>Anish Shrestha</h4>
                                                    <small>anishshrestha@gmail.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            9800000000
                                        </td>
                                        <td>
                                            11 June, 2023
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="">
                                                    <ion-icon id="open-popup" name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="section2">
                        <div class="page-header-small">
                            <h1>Users</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Admins</th>
                                        <th>Contact Number</th>
                                        <th>Register Date</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#1</td>
                                        <td>
                                            <div class="client">
                                                <img src="<?php echo $imglogopath?>../profile-img/profile.jpg" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4>Saugat Nepal</h4>
                                                    <small>sandnnepal4972@gmail.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            9800000000
                                        </td>
                                        <td>
                                            11 June, 2023
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href='./updateuser.php?id=12'>
                                                    <ion-icon  name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
                                                </a>
                                                <a href="">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
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