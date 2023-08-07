
<?php
include '../../db/connect.php';
include '../../includes/links.php';
include './verifyadmin.php';
$testpath = './img/favicons/whitecinepal.jpg'
?>
<div class="side-header">
<?php if($sitelogo == './img/favicons/whitecinepal.jpg') { ?>
    <img src="<?php echo $imglogopath?>orangecinepal.jpg" class="sidebar-logo" alt="">
    <?php }
    else {?>
        <img src="<?php echo $base ?><?php echo $sitelogo ?>" class="sidebar-logo" alt="">
    <?php }?>
</div>
<br>
<div class="side-content">
    <div class="side-menu">
        <ul>
            <li>
                <a href="./" class="menu-item">
                    <ion-icon name="home-outline"></ion-icon>
                    <small>&nbsp&nbspDashboard</small>
                </a>
            </li>
            <li>
                <a href="./users.php" class="menu-item">
                    <ion-icon name="people-outline"></ion-icon>
                    <small>&nbsp&nbspUsers</small>
                </a>
            </li>
            <li>
                <a href="./movies.php" class="menu-item">
                    <ion-icon name="videocam-outline"></ion-icon>
                    <small>&nbsp&nbspMovies</small>
                </a>
            </li>
            <li>
                <a href="./bookings.php" class="menu-item">
                    <ion-icon name="bookmarks-outline"></ion-icon>
                    <small>&nbsp&nbspBookings</small>
                </a>
            </li>
            <li>
                <a href="./showtime.php" class="menu-item">
                    <ion-icon name="albums-outline"></ion-icon>
                    <small>&nbsp&nbspShowTimes</small>
                </a>
            </li>
            <li>
                <a href="./settings.php" class="menu-item">
                <ion-icon name="settings-outline"></ion-icon>
                    <small>&nbsp&nbspSettings</small>
                </a>
            </li>
        </ul>
    </div>
</div>


<script src="./script.js"></script>