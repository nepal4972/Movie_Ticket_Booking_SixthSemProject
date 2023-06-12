<?php
error_reporting(0);
include '../db/connect.php';
include '../includes/links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
	<link rel="stylesheet" href="../assets/seats/style.css">
	<title>Seats <?php echo $title ?></title>
</head>

<body>
	<option hidden id="movie" value="10"></option>
	<div class="main">
		<div class="booking-details">
			<h3 class="moviename">Fulbari</h3>
			<span class="booking-date">May 8, 2023&nbsp&nbsp</span><span class="booking-time">12:30 PM</span>
		</div>

		<a onclick="history.back()" id="closeSeats" class="page-close-btn"></a>

		<div class="seat-status">
			<ul>
				<li><span class="available-seat"></span>Available</li>
				<li><span class="booked-seat"></span>Booked</li>
				<li><span class="selected-seat"></span>Selected</li>
				<li><span class="sold-seat"></span>Sold</li>
			</ul>
		</div>
		<?php
		$status = "booked";
		?>
		<div class="all">
			<select hidden id="movie">
			</select>
			<div class="container">
				<div class="screen">SCREEN</div>

				<div class="row">
					<div class="seat" data-value="F1">F1</div>
					<div class="seat" data-value="F2">F2</div>
					<div class="seat" data-value="F3">F3</div>
					<div class="seat" data-value="F4">F4</div>
					<div class="seat sold" data-value="F5">F5</div>
					<div class="seat sold" data-value="F6">F6</div>
					<div class="seat sold" data-value="F7">F7</div>
					<div class="seat" data-value="F8">F8</div>
				</div>
				<div class="row">
					<div class="seat" data-value="E1">E1</div>
					<div class="seat" data-value="E2">E2</div>
					<div class="seat" data-value="E3">E3</div>
					<div class="seat sold" data-value="E4">E4</div>
					<div class="seat sold" data-value="E5">E5</div>
					<div class="seat" data-value="E6">E6</div>
					<div class="seat" data-value="E7">E7</div>
					<div class="seat" data-value="E8">E8</div>
				</div>
				<div class="row">
					<div class="seat" data-value="D1">D1</div>
					<div class="seat" data-value="D2">D2</div>
					<div class="seat" data-value="D3">D3</div>
					<div class="seat" data-value="D4">D4</div>
					<div class="seat" data-value="D5">D5</div>
					<div class="seat" data-value="D6">D6</div>
					<div class="seat" data-value="D7">D7</div>
					<div class="seat" data-value="D8">D8</div>
				</div>
				<div class="row">
					<div class="seat" data-value="C1">C1</div>
					<div class="seat" data-value="C2">C2</div>
					<div class="seat" data-value="C3">C3</div>
					<div class="seat" data-value="C4">C4</div>
					<div class="seat" data-value="C5">C5</div>
					<div class="seat" data-value="C6">C6</div>
					<div class="seat sold" data-value="C7">C7</div>
					<div class="seat sold" data-value="C8">C8</div>
				</div>
				<div class="row">
					<div class="seat" data-value="B1">B1</div>
					<div class="seat" data-value="B2">B2</div>
					<div class="seat" data-value="B3">B3</div>
					<div class="seat sold" data-value="B4">B4</div>
					<div class="seat sold" data-value="B5">B5</div>
					<div class="seat <?php echo $status ?>" data-value="B6">B6</div>
					<div class="seat" data-value="B7">B7</div>
					<div class="seat" data-value="B8">B8</div>
				</div>
				<div class="row">
					<div class="seat" data-value="A1">A1</div>
					<div class="seat" data-value="A2">A2</div>
					<div class="seat" data-value="A3">A3</div>
					<div class="seat" data-value="A4">A4</div>
					<div class="seat" data-value="A5">A5</div>
					<div class="seat" data-value="A6">A6</div>
					<div class="seat" data-value="A7">A7</div>
					<div class="seat" data-value="A8">A8</div>
				</div>

			</div>
			<div class="proceed-container">
				<span class="hidden" hidden id="count"></span>
				<div class="total-amount">
					<h2>Total Rs. <span id="total">0</span></h2>
				</div>
				<h5>
					<div style="font-size:12px" hidden id="selected-values"></div>
				</h5>
				<button class="proceed-btn" onclick="submitForm()" id="reserver-ticket">Proceed</button>
			</div>
		</div>
		<script>
			function submitForm() {
				var divValue = document.getElementById("selected-values").innerHTML;
				var form = document.createElement("form");
				form.setAttribute("method", "POST");
				form.setAttribute("action", "../config/seatprocess.inc");
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "seats");
				hiddenField.setAttribute("value", divValue);
				form.appendChild(hiddenField);
				document.body.appendChild(form);
				form.submit();
			}
		</script>
		<script src="../assets/seats/script.js"></script>
	</div>
</body>

</html>