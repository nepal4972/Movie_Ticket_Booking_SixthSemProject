<?php
error_reporting(0);
include './db/connect.php';
include './includes/links.php';
?>

<?php
$userID = $_SESSION['userID'];
$sql = "SELECT * FROM users WHERE userID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$namepart = explode(' ', $row['fullname']);
$firstname = $namepart[0];
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<header class="header">
  <div class="container">
    <?php
    if($sitelogo == './img/favicons/whitecinepal.jpg') { ?>
    <style>
      .logo-img:hover {
      content: url(./img/favicons/orangecinepal.jpg);
      width: 88px;
      height: 50px;
      }
      </style>
    <?php }else {} ?>
    <a href="./" class="logo">
      <img style="logo" class="logo-img" src="img/favicons/<?php echo $sitelogo ?>" alt="">
    </a>
    <div class="header-actions">
      <div class="lang-wrapper">
      </div>
      <?php
        if(isset($_SESSION['userID'])==null) {
        ?>
      <a href="./login.php" class="btn btn-primary">Sign in</a>
      <?php
        }
        else { ?>
      <div class="profile-icon">
        <p class="profile-name">Hello, <span style='letter-spacing:2.5px'><?php echo $firstname?>&nbsp&nbsp</span></p>
        <div class="dropdown">
          <?php
          if(!empty($row['profile_img'])) { ?>
            <img class="profile-img" src="<?php echo $row['profile_img'] ?>" alt="">
            <?php }
          else { ?>
            <ion-icon class="profile-icon dropdownbtn" name="person-circle-outline"></ion-icon>
            <ion-icon class="profile-icon-down dropdownbtn" name="chevron-down-outline"></ion-icon>
            <?php } ?>
          <div class="dropdown-content">
            <a href="./profile.php">My Profile</a>
            <?php
            if($row['user_type'] == 'admin') {
            ?>
            <style>
              .dropdown-content {
                bottom: -136px;
              }
            </style>
            <a href="./admin.php">Admin Dashboard</a>
            <?php } else { } ?>
            <a href="./ticket.php">My Tickets</a>
            <a href="./logout.php" onclick="return showConfirmation(event)">Logout</a>
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
        if(!empty($row['profile_img'])) { ?>
          <img class="profile-img" src="<?php echo $row['profile_img'] ?>" alt="">
        <?php }
        else { ?>
          <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
        <?php } ?>
        <p class="profile-name">Hello,
        <?php
        if(!isset($_SESSION['userID'])==null) {
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
          if(isset($_SESSION['userID'])==null) {
          ?>
        <li>
          <a href="./login.php" class="navbar-link hide">Sign In</a>
        </li>
        <?php } else { ?>
        <li>
          <a href="./profile.php" class="navbar-link hide">My Profile</a>
        </li>
        <li>
          <a href="./ticket.php" class="navbar-link hide">My Tickets</a>
        </li>
        <?php } ?>
        <li>
          <a href="./" class="navbar-link">Home</a>
        </li>
        <li>
          <a href="./movies.php" class="navbar-link">Movies</a>
        </li>
        <?php
          if(!isset($_SESSION['userID'])==null) {
          ?>
        <li>
          <a href="./logout.php" onclick="return showConfirmation(event)" class="navbar-link logout">Logout</a>
        </li>
        <?php
          } else {} ?>
  </div>
  </ul>
  </nav>
  </div>
  <span class="line"></span>
</header>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php
include './includes/alert.php';
?>