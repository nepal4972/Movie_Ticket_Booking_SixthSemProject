<?php
include './db/connect.php';
include './includes/links.php';
?>

<?php
  $sql1 = "SELECT * FROM movies WHERE CURRENT_DATE() BETWEEN release_date AND end_date";
  $stmt1 = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt1, $sql1);
  mysqli_stmt_execute($stmt1);
  $result1 = mysqli_stmt_get_result($stmt1);

  $nowShowingMovies = fetchAndSortMovies($result1);
?>

<?php
  $sql2 = "SELECT * FROM movies WHERE CURRENT_DATE() < release_date";
  $stmt2 = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt2, $sql2);
  mysqli_stmt_execute($stmt2);
  $result2 = mysqli_stmt_get_result($stmt2);

  $comingSoonMovies = fetchAndSortMovies($result2);
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
  <title>Home <?php echo $title ?></title>
</head>
<br>
<?php
include './includes/header.php';
?>
<br><br><br>
<?php
include './includes/carousel.php';
?>
<span class="line"></span>
<section class="movies">
  <div class="container">
    <div class="title-wrapper">
      <h2 class="h2 section-title">Now Showing</h2>
    </div>
    <ul class="movies-list">
      <?php
        foreach ($nowShowingMovies as $movie) {
      ?>
        <li>
          <div class="movie-card">

            <figure class="card-banner">
              <img src="<?php echo $base?><?php echo $movie['movie_banner'] ?>" alt="">

              <div class="hover-items">
                <a class="movie-a" href="./movie-details.php?id=<?php echo $movie['movieID'] ?>">
                  <ion-icon name="ticket-outline"></ion-icon>
                  <span>Buy Tickets</span>
                </a>

                <a class="watch-trailer movie-a" href="https://youtu.be/<?php echo $movie['videoID'] ?>">
                  <ion-icon href="https://youtu.be/<?php echo $movie['videoID'] ?>" name="play-circle-outline"></ion-icon>
                  <span href="https://youtu.be/<?php echo $movie['videoID'] ?>">Play Trailer</span>
                </a>
              </div>
            </figure>
            <div class="title-wrapper">
              <a href="./movie-details.php?id=<?php echo $movie['movieID'] ?>">
                <h3 class="movie-title"><?php echo $movie['movie_name'] ?></h3>
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

<span class="line"></span>

<section class="movies">
  <div class="container">
    <div class="title-wrapper">
      <h2 class="h2 section-title">Coming Soon</h2>
    </div>
    <ul class="movies-list">
        <?php
          foreach ($comingSoonMovies as $movie) {
        ?>
          <li>
            <div class="movie-card">
              <figure class="card-banner">

              <form action="config/notify.inc" method="POST">
                <button name="notify">
                  <div class="wishlist-icon">
                    <ion-icon name="notifications-outline"></ion-icon>
                    <span class="notify-text">Notify on release</span>
                    <input type="hidden" name="id" value="<?php echo $movie['movieID'] ?>">
                  </div>
                </button>
              </form>

                <img src="<?php echo $base?><?php echo $movie['movie_banner'] ?>" alt="">

                <div class="hover-items">
                  <a class="movie-a" href="./movie-details.php?id=<?php echo $movie['movieID'] ?>">
                    <ion-icon name="eye-outline"></ion-icon>
                    <span>View Details</span>
                  </a>
                  <a class="watch-trailer movie-a" href="https://youtu.be/<?php echo $movie['videoID'] ?>">
                    <ion-icon href="https://youtu.be/<?php echo $movie['videoID'] ?>" name="play-circle-outline"></ion-icon>
                    <span href="https://youtu.be/<?php echo $movie['videoID'] ?>">Play Trailer</span>
                  </a>
                </div>
              </figure>
              <div class="title-wrapper">
                <a href="./movie-details.php?id=<?php echo $movie['movieID'] ?>">
                  <h3 class="movie-title"><?php echo $movie['movie_name'] ?></h3>
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
</article>
</main>

<?php
include './includes/footer.php';
?>

<script src="https://www.youtube.com/iframe_api"></script>
<script>
  let player;

  function loadYouTubeAPI() {
    const tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  }

  function loadYouTubeVideo(event) {
    event.preventDefault();

    const link = event.target;
    const videoUrl = link.getAttribute('href');

    const videoId = videoUrl.split('/').pop();

    player = new YT.Player('player', {
      height: '100%',
      width: '100%',
      videoId: videoId,
      playerVars: {
        autoplay: 1,
      },
      events: {
        onReady: function () {
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

    link.style.display = 'none';
  }

  function closeVideoContainer() {
    if (player) {
      player.stopVideo();
      player.destroy();
      player = null;
    }

    const videoContainer = document.querySelector('.video-container');
    videoContainer.style.display = 'none';

    const watchTrailerLinks = document.querySelectorAll('.watch-trailer');
    watchTrailerLinks.forEach(function (link) {
      link.style.display = 'flex';

      const icon = link.querySelector('ion-icon');
      icon.style.display = 'inline';

      const span = link.querySelector('span');
      span.style.display = 'inline';
    });
  }


  const watchTrailerLinks = document.querySelectorAll('.watch-trailer');
  watchTrailerLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
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

  loadYouTubeAPI();
</script>


<script src="<?php echo $homejs ?>"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>


<!-- Insertion Search Algorithm -->
<?php
function fetchAndSortMovies($result) {
    $movies = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $movies[] = $row;
    }

    for ($i = 1; $i < count($movies); $i++) {
        $key = $movies[$i];
        $j = $i - 1;
        while ($j >= 0 && strtotime($movies[$j]['release_date']) < strtotime($key['release_date'])) {
            $movies[$j + 1] = $movies[$j];
            $j = $j - 1;
        }
        $movies[$j + 1] = $key;
    }

    return $movies;
}
?>

<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
include './includes/alert.php';
?>