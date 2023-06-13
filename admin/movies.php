<?php
include '../db/connect.php';
include '../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

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
                            <input type="search" placeholder="Search">
                            <button name="search">Search</button>&nbsp&nbsp&nbsp&nbsp
                            <button onclick="toggleSections()">Showing/Upcoming</button>
                        </div>

                        <div class="browse">
                            <select name="" id="">
                                <option value="">Date Registered</option>
                            </select>
                            <a href="">Add Movies</a>
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
                                        <th>Movie ID</th>
                                        <th>Movie Name</th>
                                        <th>Movie Thumbnail</th>
                                        <th>Movie Price</th>
                                        <th>Date</th>
                                        <th>Video ID</th>
                                        <th> ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>
                                            <div class="client-info">
                                                <h4>Fulbari</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="<?php echo $imglogopath?>../banners/lakhey-thumbnail.jpeg" class="client-img" alt="Image">
                                        </td>
                                        <td>
                                            Rs. 180 
                                        </td>
                                        <td>
                                            19 April, 2022
                                        </td>
                                        <td>
                                            xyyKHCbD1jo
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="">
                                                    <ion-icon name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
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
                    <div id="section2" class="hidden">
                        <div class="page-header-small">
                            <h1>Upcoming Movies</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>Movie ID</th>
                                        <th>Movie Name</th>
                                        <th>Movie Thumbnail</th>
                                        <th>Movie Price</th>
                                        <th>Date</th>
                                        <th>Video ID</th>
                                        <th> ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>
                                            <div class="client-info">
                                                <h4>Lakhey</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="./lakhey-thumbnail.jpeg" class="client-img" alt="Image">
                                        </td>
                                        <td>
                                            Rs. 180 
                                        </td>
                                        <td>
                                            19 April, 2022
                                        </td>
                                        <td>
                                            xyyKHCbD1jo
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="">
                                                    <ion-icon name="create-outline"></ion-icon>&nbsp&nbsp&nbsp
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