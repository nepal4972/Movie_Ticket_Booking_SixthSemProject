<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>

<style>
    .main-row {
  display: flex;
  justify-content: space-between;
}

</style>

<?php 
$sql5 ="SELECT * FROM showtime";
$result5 = $conn->query($sql5);
if($result5->num_rows> 0){
    $row5 = mysqli_fetch_all($result5, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
  <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Settings <?php echo $title ?> </title>
</head>

<body>
  <input type="checkbox" id="menu-toggle">
  <div class="sidebar">
    <?php include './includes/navbar.php'; ?>
  </div>
  <div class="main-content">
    <?php include './includes/header.php'; ?>
    <div class="main-row">
      <main>
        <div style="padding: 147px 35px;" class="form-container">
          <h2>Show Times</h2>
          <br>
          <form action="./config/updateshowtime" method="GET">
            <div class="form-row">
              <div class="form-group">
                <label for="logo">Site Logo:</label><br>
                <input style="color: #232836; height:35px; background-color:white" type="file" name="site_logo">
              </div>
              <div class="form-group">
                <label for="logo">Site Favicon:</label><br>
                <input style="color: #232836; height:35px; background-color:white" type="file" name="site_favicon">
              </div>
            </div>
            <br><br>
            <div class="form-row">
              <div class="form-group">
                <label for="text">Show Times:</label>
                <br>
                <?php
                    $time = $row5['show_time'];
                    $changedTime = date("h:i A", strtotime($row5['show_time']));
                ?>
                <select name="showtime">
                        <option value="">Select ShowTimes</option>
                            <?php 
                            foreach ($row5 as $row5) {
                            ?>
                            <option value="<?php echo $row5['showID'] ?>"><?php echo date("h:i A", strtotime($row5['show_time'])) ?></option>
                            <?php
                            }
                            ?>  
                        </select>
              </div>
              <div class="form-group">
                <label for="text">Seat Price(in Rs):</label>
                <input type="text" value="<?php echo $row5['seat_price'] ?>" name="seat_price">
              </div>
            </div>
            <div class="form-row">
              <button type="submit" name="update_setting" class="update-button">Update ShowTime</button>
            </div>
          </form>
        </div>
      </main>
      <main>
        <div style="padding: 147px 35px;" class="form-container">
          <h2>Assign MovieTime</h2>
          <br>
          <form action="./config/updatesetting" method="POST">
            <div class="form-row">
              <div class="form-group">
                <label for="logo">Site Logo:</label><br>
                <input style="color: #232836; height:35px; background-color:white" type="file" name="site_logo">
              </div>
              <div class="form-group">
                <label for="logo">Site Favicon:</label><br>
                <input style="color: #232836; height:35px; background-color:white" type="file" name="site_favicon">
              </div>
            </div>
            <br><br>
            <div class="form-row">
              <div class="form-group">
                <label for="text">Site Name:</label>
                <input type="text" value="<?php echo $row5['site_title'] ?>" name="site_title">
              </div>
              <div class="form-group">
                <label for="text">Seat Price(in Rs):</label>
                <input type="text" value="<?php echo $row5['seat_price'] ?>" name="seat_price">
              </div>
            </div>
            <div class="form-row">
              <button type="submit" name="update_setting" class="update-button">Assign ShowTime</button>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>

  <script src="./assets/js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
include '../includes/alert.php';
?>
