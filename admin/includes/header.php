<script src="../../alerts/dist/js/iziToast.min.js"></script>
<link rel="stylesheet" href="../../alerts/dist/css/iziToast.min.css">
<header>
    <div class="header-content">
        <label for="menu-toggle">
            <ion-icon style="font-size:35px; color:white ;margin-top:10px;" name="menu-outline"></ion-icon>
        </label>

        <div class="header-menu">
            <div class="user profile-icon">
                <p style="margin-right:10px;">Hello, <br> Admin</p>
                <div class="dropdown">
                    <img class="profile-img" src="<?php echo $imglogopath?>../profile-img/profile.jpg" alt="">
                    <div class="dropdown-content">
                        <a href="<?php echo $base ?>">Home Page</a>
                        <a href="<?php echo $base?>logout.php" onclick="return confirm('Want To Logout');">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
