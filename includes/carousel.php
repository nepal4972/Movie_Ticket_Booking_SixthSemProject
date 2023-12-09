<?php
include './db/connect.php';
include './includes/links.php';

$sqlCarousel = "SELECT c.*, m.*
FROM carousel c
LEFT JOIN movies m ON c.movieID = m.movieID";
$resultCarousel = mysqli_query($conn, $sqlCarousel);

?>

<link rel="stylesheet" href="./assets/carousel/css/style.css">

<style>

  .carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.3);
    color: #fff;
    text-align: center;
  }

  .carousel-caption h5 {
    font-size: 30px;
    margin-bottom: 10px;
    text-align: center;
  }

  .carousel-caption a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #001242;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    margin-left: 6px;
  }

  @media (max-width: 768px) {
    .carousel-caption {
      padding: 6px;
    }
    .carousel-caption h5 {
      font-size: 15px;
      padding: 0px;
    }

    .carousel-caption a {
      font-size: 10px;
      padding: 5px 10px;
    }
  }
</style>

<body>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $firstItem = true;

        while ($rowCarousel = mysqli_fetch_assoc($resultCarousel)) {
            $isActive = $firstItem ? 'active' : '';
            $firstItem = false;
        ?>
            <div class="carousel-item <?php echo $isActive; ?>">
                <img class="d-block w-100 fixed-height" src="img/carousel/<?php echo $rowCarousel['carousel_image'] ?>" alt="Carousel Slide">
                <?php
                if($rowCarousel['movieID'] !== null) { ?>
                  <div class="carousel-caption">
                    <h5><?php echo $rowCarousel['movie_name']; ?></h5>
                    <a href="movie-details?id=<?php echo $rowCarousel['movieID'] ?>" class="btn btn-primary">Buy Now</a>
                  </div>
               <?php } else {}
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>