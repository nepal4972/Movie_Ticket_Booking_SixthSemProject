<?php
include './db/connect.php';
include './includes/links.php';
?>

<?php
$movieid = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo $homecss ?>">
  <title>Movie Details <?php echo $title ?></title>
</head>
<body>
  <?php
include './includes/header.php';
?>
<?php
$sql1 = "SELECT * FROM movies WHERE movieID = '$movieid'";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$row1 = mysqli_fetch_assoc($result1);
?>
<?php
$sql2 = "SELECT * FROM movies WHERE movieID = ? AND CURRENT_DATE() BETWEEN release_date AND end_date";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $movieid);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
?>
  <main>
    <article>
      <section class="movie-detail">
        <div class="container">
          <figure class="movie-detail-banner">
            <img style="width" src="<?php echo $row1['movie_banner'] ?>" alt="">
            <button class="watch-trailer play-btn">
              <ion-icon name="play-circle-outline" href="https://youtu.be/<?php echo $row1['videoID'] ?>"></ion-icon>
            </button>
          </figure>

          <div class="movie-detail-content">
            <h1 class="h1 detail-title">
              <?php echo $row1['movie_name'] ?>
            </h1>
            <p class="description">
              <?php echo $row1['movie_description'] ?>
            </p>
            <?php
            $dateString = $row1['release_date'];
            $formattedDate = date('F d, Y', strtotime($dateString));            
            ?>
            <div class="date-time">
              <span>Release Date : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<small><?php echo $formattedDate ?></small></span>
            </div>
            <br>
            <div class="date-time">
              <span>Duration :
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<small><?php echo $row1['movie_duration'] ?>
                  min</small></span>
            </div>
          </div>
        </div>
        <br> <br> <br>
        <?php
        if($row2 = mysqli_fetch_assoc($result2) > 0) {
        ?>
        <span class="line"></span>
        <div id="showTimings" class="view-time">
          <div class="nowshowing-detail title-section">
            <div>
              <h3 class="title-txt">Viewing Times</h3>
            </div>
            <div class="selectShowDays">
              <ul class="ulShowDays">
                <a href="" class="tomm">Today</a>
                <a href="" class="tomm">Tomm</a>
                <a href="" class="tomm">14 Jun</a>
                <a href="" class="tomm">15 Jun</a>
                <a href="" class="tomm">16 Jun</a>
                <a href="" class="tomm">16 Jun</a>
            </div>
          </div>
        </div>

        <div class="hall-info">
          <span class="hall-info-text">Select Time</span>
          <ul class="show-time-info">
            <a href="" class="available">10:30 AM</a>
            <a href="" class="available">01:15 PM</a>
            <a href="" class="available">04:00 PM</a>
            <a href="" class="available">06:45 PM</a>
          </ul>
        </div>
        <br>
      </section>
    </article>
  </main>
  <?php } ?>
  <span class="line"></span>

  <?php
  include './includes/footer.php';
  ?>

  <script src="https://www.youtube.com/iframe_api"></script>
  <script>
    let player; // Global variable to store the YouTube player instance

    // Load the YouTube IFrame Player API asynchronously
    function loadYouTubeAPI() {
      const tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      const firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }

    // Function to load the YouTube video when the link is clicked
    function loadYouTubeVideo(event) {
      event.preventDefault();

      const link = event.target;
      const videoUrl = link.getAttribute('href');

      // Extract the video ID from the YouTube URL
      const videoId = videoUrl.split('/').pop();

      // Create the YouTube player
      player = new YT.Player('player', {
        height: '100%',
        width: '100%',
        videoId: videoId,
        playerVars: {
          autoplay: 1, // Autoplay the video
        },
        events: {
          onReady: function () {
            // Show the video container once the video is ready
            const videoContainer = document.querySelector('.video-container');
            videoContainer.style.display = 'flex';
          },
          onStateChange: function (event) {
            if (event.data === YT.PlayerState.ENDED) {
              closeVideoContainer();
            }
          },
        },
      });

      // Hide the clicked link
      link.style.display = 'none';
    }
    // Function to close the video container and stop the video
    // Function to close the video container and stop the video
    function closeVideoContainer() {
      if (player) {
        player.stopVideo(); // Stop the YouTube video playback
        player.destroy(); // Destroy the player instance
        player = null; // Reset the player variable
      }

      const videoContainer = document.querySelector('.video-container');
      videoContainer.style.display = 'none'; // Hide the video container

      // Show the clicked links and icons
      const watchTrailerLinks = document.querySelectorAll('.watch-trailer');
      watchTrailerLinks.forEach(function (link) {
        link.style.display = 'flex';

        // Show the ion-icon within the link
        const icon = link.querySelector('ion-icon');
        icon.style.display = 'inline';

        // Adjust the position of the ion-icon
        icon.style.position = 'relative';
        icon.style.left = '75px';
        icon.style.transform = 'none';
      });
    }



    // Event listeners for the click event on the links
    const watchTrailerLinks = document.querySelectorAll('.watch-trailer');
    watchTrailerLinks.forEach(function (link) {
      link.addEventListener('click', function (event) {
        // Create the video container dynamically if it doesn't exist
        if (!document.querySelector('.video-container')) {
          const videoContainer = document.createElement('div');
          videoContainer.classList.add('video-container');
          videoContainer.innerHTML = `
            <span class="close-button">&times;</span>
            <div id="player"></div>
          `;
          document.body.appendChild(videoContainer);

          // Event listener for the click event on the close button
          const closeButton = videoContainer.querySelector('.close-button');
          closeButton.addEventListener('click', closeVideoContainer);
        }

        loadYouTubeVideo(event);
      });
    });

    // Function to load the YouTube API
    loadYouTubeAPI();
  </script>


  <script src="./assets/js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>