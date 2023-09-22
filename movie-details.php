<?php
include './db/connect.php';
include './includes/links.php';

$movieid = $_GET['id'];

date_default_timezone_set('Asia/Kathmandu');
$currentdate = date("Y-m-d");

$sql1 = "SELECT * FROM movies WHERE movieID = '$movieid'";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = "SELECT * FROM movies WHERE movieID = ? AND CURDATE() BETWEEN release_date AND end_date";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $movieid);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);


if (isset($_GET['date'])) {
  $selectedDate = $_GET['date'];
  if ($selectedDate < $currentdate) {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Invalid Date";
    echo '<script>window.history.back();</script>';
    exit();
  }
} else {
  $selectedDate = date('Y-m-d');
}

$sql5 = "SELECT st.show_time FROM movietime AS mt JOIN showtime AS st ON mt.showID = st.showID WHERE mt.movieID = ? AND ? BETWEEN mt.start_date AND mt.end_date";
$stmt5 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt5, $sql5);
mysqli_stmt_bind_param($stmt5, "is", $movieid, $selectedDate);
mysqli_stmt_execute($stmt5);
$result5 = mysqli_stmt_get_result($stmt5);
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
  <title><?php echo $row1['movie_name'] ?> | Movie Details <?php echo $title ?></title>
</head>

<body>
  <?php include './includes/header.php'; ?>

  <main>
    <article>
      <section class="movie-detail">
        <div class="container">
          <figure class="movie-detail-banner">
            <img src="<?php echo $row1['movie_banner'] ?>" alt="">
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
              <span>Release Date : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<small>
                  <?php echo $formattedDate ?>
                </small></span>
            </div>
            <br>
            <div class="date-time">
              <span>Duration :
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<small>
                  <?php echo $row1['movie_duration'] ?>
                  min
                </small></span>
            </div>
          </div>
        </div>
        <br> <br> <br>
        <?php
        if (mysqli_num_rows($result2) > 0) {
        ?>
        <span class="line"></span>
        <div id="showTimings" class="view-time">
          <div class="nowshowing-detail title-section">
            <div>
              <h3 class="title-txt">Viewing Times</h3>
            </div>
            <div class="selectShowDays">
              <ul class="ulShowDays">
                <a href="?id=<?php echo $movieid ?>&date=<?php echo $currentdate ?>" class="tomm">Today</a>
                <a href="?id=<?php echo $movieid ?>&date=<?php echo date('Y-m-d', strtotime('+1 day', strtotime($currentdate))) ?>"
                  class="tomm">Tomorrow</a>
              </ul>
            </div>
          </div>
        </div>

        <div class="hall-info">
          <span class="hall-info-text">Select Time :
          </span>
          <ul class="show-time-info">
            <?php
            $noShowAvailable = true;
            while ($row5 = mysqli_fetch_assoc($result5)) {
              $time = $row5['show_time'];
              $changedTime = date("h:i A", strtotime($time));

              $startTime = strtotime($row5['start_time']);
              $endTime = strtotime($row5['end_time']);
              $selectedTime = strtotime($selectedDate);

              if ($selectedTime >= $startTime && $selectedTime <= $endTime) {
                $noShowAvailable = false;
                ?>
                <?php
              } else {
                ?>
                <?php
                $currentDateTime = date("Y-m-d H:i:s");
                $currentTimestamp = strtotime($currentDateTime);
                $selectedHour = date("H", strtotime($time));
                $selectedMinute = date("i", strtotime($time));
                $selectedDateTime = $selectedDate . ' ' . $selectedHour . ':' . $selectedMinute . ':00';
                $selectedTimestamp = strtotime($selectedDateTime);
                $diffInMinutes = round(($selectedTimestamp - $currentTimestamp) / 60);

                if ($diffInMinutes <= 15) {
                  ?>
                  <a href="./seatlayout/seats?id=<?php echo $movieid ?>&date=<?php echo $selectedDate ?>&time=<?php echo $time ?>" style="pointer-events: none; border: 2px solid #ff2a26; color:#ff2a26" class="unavailable">
                <?php } else { ?>
                  <a href="./seatlayout/seats?id=<?php echo $movieid ?>&date=<?php echo $selectedDate ?>&time=<?php echo $time ?>" style="border: 2px solid #4caf50; color:#4caf50" class="available">
                <?php } ?>
                  <?php echo $changedTime ?>
                </a>
                <?php
                $noShowAvailable = false;
              }
            }

            if ($noShowAvailable) {
              echo "<p style='color:#ff2a26'>No shows available.</p>";
            }
            ?>
          </ul>
        </div>
        <br>

        <?php } else { ?>
        <?php } ?>
      </section>
    </article>
  </main>

  <span class="line"></span>
  <?php include './includes/footer.php'; ?>

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
</body>
</html>
