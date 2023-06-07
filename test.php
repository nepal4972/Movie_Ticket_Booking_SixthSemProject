<style>

* {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 20px;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.booking-details {
  text-align: center;
  margin-bottom: 20px;
}

.movie-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.booking-info {
  font-size: 16px;
  margin-bottom: 5px;
}

.seats {
  text-align: center;
  margin-bottom: 20px;
}

.screen {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.seat-row {
  display: flex;
  justify-content: center;
}

.seat {
  width: 30px;
  height: 30px;
  margin: 5px;
  border-radius: 5px;
  background-color: #e9e9e9;
  cursor: pointer;
}

.available {
  background-color: #e9e9e9;
}

.selected {
  background-color: #52c41a;
}

.unavailable {
  background-color: #ccc;
  cursor: not-allowed;
}

.proceed-container {
  text-align: center;
}

.total-amount {
  font-size: 18px;
  margin-bottom: 10px;
}

.proceed-btn {
  padding: 10px 20px;
  font-size: 16px;
  background-color: #1890ff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.proceed-btn:hover {
  background-color: #40a9ff;
}


</style>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Movie Ticket Booking</title>
</head>

<body>
  <div class="container">
    <div class="booking-details">
      <h2 class="movie-title">Movie Name</h2>
      <p class="booking-info">City Cinema > Hall B</p>
      <p class="booking-info">May 8, 2023 | 12:30 PM</p>
    </div>

    <div class="seats">
      <div class="screen">SCREEN</div>
      <div class="seat-row">
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat unavailable"></div>
        <div class="seat available"></div>
      </div>
      <div class="seat-row">
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat available"></div>
      </div>
      <div class="seat-row">
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat selected"></div>
        <div class="seat available"></div>
      </div>
      <div class="seat-row">
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat unavailable"></div>
        <div class="seat available"></div>
      </div>
      <div class="seat-row">
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat available"></div>
        <div class="seat available"></div>
      </div>
    </div>

    <div class="proceed-container">
      <div class="total-amount">
        Total: <span id="total">0</span> seats
      </div>
      <button class="proceed-btn">Proceed to Payment</button>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>
