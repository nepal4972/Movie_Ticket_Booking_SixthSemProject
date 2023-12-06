<?php
include './links.php';
?>
<link rel="stylesheet" href="./assets/css/style.css">

<footer class="footer">
  <div class="footer-logo">
    <img src="img/favicons/<?php echo $sitelogo ?>" class="footer-logo" alt="">
  </div>

  <ul class="footer-nav">
    <li class="nav-item">
      <h2 class="nav-title">Quick Links :</h2>

      <ul class="nav-ul">
        <li>
          <a href="./">Home</a>
        </li>

        <li>
          <a href="./profile.php">My Profile</a>
        </li>

        <li>
          <a href="./movies.php">Movies</a>
        </li>

        <li>
          <a href="./login.php">Signin</a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <h2 class="nav-title">Social Handles :</h2>

      <ul class="nav-ul">
        <li>
          <a href="">Instagram</a>
        </li>

        <li>
          <a href="">facebook</a>
        </li>

        <li>
          <a href="">Twitter</a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <h2 class="nav-title">Contacts :</h2>

      <ul class="nav-ul">
        <li>
          <p>Email : nepal4972+cinepal@gmail.com</p>
        </li>
        <li>
          <p>Contact No. : +977 9800000000</p>
        </li>
      </ul>
    </li>
  </ul>
  <span class="line"></span><br>
  <div class="copyright-info">
    <p>&copy; 2023
      <?php echo $title ?>. All rights reserved.
    </p>
  </div>
</footer>