<?php
include './db/connect.php';
include './includes/links.php';
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
    <title>Movies <?php echo $title ?></title>
</head> 
<br>
  <?php
include './includes/header.php';
?>
<br><br><br>
  <span class="line"></span>
  <div class="page-title">
      <h1>MOVIES</h1>
    </div>
    <span class="line"></span>
  <section class="top-rated">
    <div class="container">
      <div class="title-wrapper">
        <br><br>
        <h2 class="h2 section-title">
          Now Showing
        </h2>
      </div>
      <br><br>

<?php
$sql1 = "SELECT * FROM movies WHERE CURRENT_DATE() BETWEEN release_date AND end_date";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
?>

<?php
$sql2 = "SELECT * FROM movies WHERE CURRENT_DATE() < release_date";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
?>

      <ul class="movies-list">
      <?php
      while($row1 = mysqli_fetch_assoc($result1)) {
      ?>
        <li>
          <div class="movie-card">
            <figure class="card-banner">
              <img src="<?php echo $row1['movie_banner'] ?>" alt="">

              <div class="hover-items">
                <a class="movie-a" href="./movie-details.php?id=<?php echo $row1['movieID'] ?>">
                  <ion-icon name="ticket-outline"></ion-icon>
                  <span>Buy Tickets</span>
                </a>

                <a class="watch-trailer movie-a" href="https://youtu.be/<?php echo $row1['videoID'] ?>">
                  <ion-icon href="https://youtu.be/<?php echo $row1['videoID'] ?>" name="play-circle-outline"></ion-icon>
                  <span href="https://youtu.be/<?php echo $row1['videoID'] ?>">Play Trailer</span>
                </a>
              </div>
            </figure>
            <div class="title-wrapper">
              <a href="./movie-details.php?id=<?php echo $row1['movieID'] ?>">
                <h3 class="movie-title"><?php echo $row1['movie_name'] ?></h3>
              </a>
            </div>
          </div>
        </li>
        <?php
      }
      ?>
      </ul>
    </div>
  </section>
  <br><br>
  <span class="line"></span>

  <section class="top-rated">
    <div class="container">
      <div class="title-wrapper">
      <br><br>
        <h2 class="h2 section-title">Coming Soon</h2>
      </div>
      <br><br>
      <ul class="movies-list">
      <?php
      while($row2 = mysqli_fetch_assoc($result2)) {
      ?>  
        <li>
          <div class="movie-card">
            <figure class="card-banner">

              <img src="<?php echo $row2['movie_banner'] ?>" alt="">

              <div class="hover-items">
                <a class="movie-a" href="./movie-details.php?id=<?php echo $row2['movieID'] ?>">
                  <ion-icon name="eye-outline"></ion-icon>
                  <span>View Details</span>
                </a>
                <a class="watch-trailer movie-a" href="https://youtu.be/<?php echo $row2['videoID'] ?>">
                  <ion-icon href="https://youtu.be/<?php echo $row2['videoID'] ?>" name="play-circle-outline"></ion-icon>
                  <span href="https://youtu.be/<?php echo $row2['videoID'] ?>">Play Trailer</span>
                </a>
              </div>
            </figure>
            <div class="title-wrapper">
              <a href="./movie-details.php?id=<?php echo $row2['movieID'] ?>">
                <h3 class="movie-title"><?php echo $row2['movie_name'] ?></h3>
              </a>
            </div>
          </div>
        </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </section>
  <br><br>
  </article>
  </main>

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

        // Show the span within the link
        const span = link.querySelector('span');
        span.style.display = 'inline';
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


  <script src="<?php echo $homejs ?>"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
include './includes/alert.php';
?>