<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
?>

<?php
$namepart = explode(' ', $_SESSION['fullname']);
$firstname = $namepart[0];
$testimg = "s";
?>

<script src="./alerts/dist/js/iziToast.min.js"></script>
<header class="header">
  <div class="container">
    <a href="./" class="logo">
      <img class="logo-img" src="<?php echo $imglogopath ?>whitecinepal.jpg" alt="">
    </a>
    <div class="header-actions">
      <div class="lang-wrapper">
      </div>
      <?php
        if(isset($_SESSION['fullname'])==null) {
        ?>
      <a href="./login.php" class="btn btn-primary">Sign in</a>
      <?php
        }
        else { ?>
      <div class="profile-icon">
        <p class="profile-name">Hello, <span style='letter-spacing:2.5px'><?php echo $firstname?>&nbsp&nbsp</span></p>
        <div class="dropdown">
          <?php
          if(!empty($testimg)) { ?>
            <img class="profile-img" src="./img/banners/profile.jpg" alt="">
            <?php }
          else { ?>
            <ion-icon class="profile-icon dropdownbtn" name="person-circle-outline"></ion-icon>
            <ion-icon class="profile-icon-down dropdownbtn" name="chevron-down-outline"></ion-icon>
            <?php } ?>
          <div class="dropdown-content">
            <a href="./profile.php">My Profile</a>
            <a href="./logout.php">Logout</a>
          </div>
        </div>
      </div>
      <?php
        }
        ?>
    </div>
    <button class="menu-open-btn" data-menu-open-btn>
      <ion-icon name="reorder-two"></ion-icon>
    </button>
    
    <nav class="navbar" data-navbar>
      <div class="navbar-top">
        <div class="profile-icon">
          <?php
        if(!empty($testimg)) { ?>
          <img class="profile-img" src="./img/banners/profile.jpg" alt="">
        <?php }
        else { ?>
          <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
        <?php } ?>
        <p class="profile-name">Hello,
        <?php
        if(!isset($_SESSION['fullname'])==null) {
        ?>  
        <span style='letter-spacing:2.5px'><?php echo $firstname?>&nbsp&nbsp</span></p>
        <?php
        } else { 
          echo "<span style='letter-spacing:2.5px'>User&nbsp&nbsp</span></p>";
        } ?>
      </div>
        <button class="menu-close-btn" data-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <span class="line hide"></span>
      <ul class="navbar-list">
        <?php
          if(isset($_SESSION['fullname'])==null) {
          ?>
        <li>
          <a href="./login.php" class="navbar-link hide">Sign In</a>
        </li>
        <?php } else { ?>
        <li>
          <a href="./profile.php" class="navbar-link hide">My Profile</a>
        </li>
        <?php } ?>
        <li>
          <a href="./" class="navbar-link">Home</a>
        </li>
        <li>
          <a href="./movies.php" class="navbar-link">Movies</a>
        </li>
        <li>
          <a href="#" class="navbar-link">Contact</a>
        </li>
        <?php
          if(!isset($_SESSION['fullname'])==null) {
          ?>
        <li>
          <a href="./logout.php" class="navbar-link logout">Logout</a>
        </li>
        <?php
          } else {} ?>
  </div>
  </ul>
  </nav>
  </div>
  <span class="line"></span>
</header>

<?php
include './includes/alert.php';
?>