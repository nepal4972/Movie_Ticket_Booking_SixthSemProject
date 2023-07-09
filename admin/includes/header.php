
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
                        <a href="../">Home Page</a>
                        <a onclick="return showConfirmation(event)" href="../logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>