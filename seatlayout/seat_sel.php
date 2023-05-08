<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/jquery.seat-charts.css">
	<link rel="stylesheet" href="seat/style.css">
	<title>Test</title>
</head>

<body>
	<style>
		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		:root {
			--primary-color: #ffa84e;
			--primary-color-dark: #f89832;
			--primary-color-darker: #f88c18;
			--secondary-color: #59427D;
			--secondary-tert: #2F4858;
			--seat-available: #4caf50;
			--seat-booked: #ffc107;
			--seat-sold: #e11e26;
			--seat-unavailable: #999999;
			--seat-booking-available: #495760;
			--seat-booking-selected: #4caf50;
			--seat-booking-booked: #ffc107;
			--seat-booking-sold: #e11e26;
			--seat-booking-unavailable: #ebebeb;
			--seat-booking-available-hover: #b0b1bd;
			--seat-empty: #cdced5;
			--color-white: #fff;
			--color-gray-100: #f8f9fa;
			--color-gray-200: #e9ecef;
			--color-gray-300: #dee2e6;
			--color-gray-400: #ced4da;
			--color-gray-500: #adb5bd;
			--color-gray-600: #777777;
			--color-gray-700: #495057;
			--color-gray-800: #343a40;
			--color-gray-900: #212529;
			--color-black: #000;
			--tabs-item-bg: #fff;
			--font-color: #fff;
			--anchor-hover-color: #e9bb8b;
			--bg-color: #192e41;
			--card-bg: #213444;
			--header-bg: #121212;
			--menu-text-color: #fff;
			--input-field-bg: #425768;
			--input-field-bg-hover: #2d4050;
			--link-font-color: #ffa84e;
			--border-color: #30465a;
			--input-border-color: --input-field-bg;
			--seat-booking-available: #495760;
			--seat-booking-selected: #4caf50;
			--seat-booking-booked: #ffc107;
			--seat-booking-sold: #e11e26;
			--seat-booking-unavailable: #ebebeb;
			--seat-booking-available-hover: #b0b1bd;
			--seat-booking-empty: #323645;
		}

		body {
			font-family: "Poppins", sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
			background: #192027;
			color: var(--font-color);
			position: relative;
		}

		.booking-details {
			width: 100%;
			padding: 20px;
		}

		.booking-details {
			background: var(--bg-color);
			padding: 15px 30px 10px 15px;
		}

		.booking-details h3 {
			color: #fff;
			margin: 0 30px 5px 0;
		}

		.booking-details span {
			color: var(--font-color);
			margin-right: 15px;
			font-size: 13px;
			opacity: 0.75;
		}

		.sfPageSliderCloseBtn {
			cursor: pointer;
			background: url(cancel.png) no-repeat 50% 50%;
			width: 20px;
			height: 18px;
			position: absolute;
			right: 30px;
			top: 30px;
		}

		a {
			color: var(--link-font-color);
			text-decoration: none;
		}

		.seat-status {
			background: var(--card-bg);
			padding: 5px 10px;
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.seat-status ul {
			margin: 0 -50px;
		}

		ul,
		ol {
			margin-top: 0;
			margin-bottom: 10px;
			padding: 0;
		}


		ul {
			display: block;
			list-style-type: disc;
			margin-block-start: 1em;
			margin-block-end: 1em;
			margin-inline-start: 0px;
			margin-inline-end: 0px;
			padding-inline-start: 40px;
		}

		.seat-status ul li {
			line-height: 28px;
			padding: 0 10px;
			font-size: 14px;
			display: inline-flex;
			align-items: center;
		}

		li {
			display: list-item;
			text-align: -webkit-match-parent;
		}

		ul {
			list-style-type: disc;
		}

		.seat-status ul li span {
			width: 16px;
			height: 16px;
			border-radius: 4px;
			margin-right: 8px;
			display: inline-block;
		}

		.sfAvailableSeat {
			background: var(--seat-booking-available);
			color: var(--font-color);
			font-size: 10px;
		}

		.sfSelectedSeat {
			background: var(--seat-booking-selected);
			color: #f2f2f2;
			font-size: 10px;
		}

		.sfBookedSeat {
			background: var(--seat-booking-booked);
			color: #f2f2f2;
			font-size: 10px;
		}

		.sfSoldSeat {
			background: var(--seat-booking-sold);
			color: #f2f2f2;
			font-size: 10px;
		}


		.booking-right-panel .seatplan .sfSeatPlanGrid {
			height: 100%;
			width: 100vw;
			overflow: auto;
		}

		table {
			max-width: 100%;
			background-color: transparent;
			width: 100%;
			margin-bottom: 20px;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		table {
			display: table;
			border-collapse: separate;
			box-sizing: border-box;
			text-indent: initial;
			border-spacing: 2px;
			border-color: gray;
		}

		tbody {
			display: table-row-group;
			vertical-align: middle;
			border-color: inherit;
		}

		tr {
			display: table-row;
			vertical-align: inherit;
			border-color: inherit;
		}

		.coridor_2 {
			background-color: var(--bg-color);
		}

		.sfSeatPlanGrid tr td {
			padding: 5px;
			text-align: center;
			vertical-align: middle;
			border-bottom: none;
		}

		.seatType_2,
		.sfSeat {
			background-color: var(--bg-color);
			padding: 8px 5px !important;
		}

		.seatType_1 {
			background-color: var(--bg-color);
		}

		.content-right {
			display: flex;
			justify-content: space-between;
			padding: 10px;
			position: sticky;
			bottom: 0;
			background: var(--bg-color);
			border-top: 1px solid var(--border-color);
			align-items: center;
		}

		input:not([type=image]),
		textarea,
		textarea.materialize-textarea,
		.sfInputbox {
			background: var(--input-field-bg);
			border-radius: 6px;
			box-sizing: border-box;
			font-size: 16px;
			padding: 10px 15px !important;
			border: none;
			color: white;
		}

		input,
		button,
		select,
		textarea {
			font-family: inherit;
			font-size: inherit;
			line-height: inherit;
		}

		button,
		input,
		select,
		textarea {
			font-family: inherit;
			font-size: 100%;
			margin: 0;
		}

		.booking-right-panel .seatplan {
			display: block;
			overflow: hidden;
			width: 100%;
			background: var(--bg-color);
			display: flex;
			flex-direction: column;
			flex: 1;
		}

		.seatplan {
			position: relative;
		}

		.booking-right-panel {
			flex: 1;
			overflow-y: auto;
			display: flex;
			flex-direction: column;
		}

		#main-booking.is-visible,
		#main-trailer.is-visible {
			transform: translateY(0px);
			height: inherit;
			margin: 0 auto;
			position: relative;
			width: inherit;
		}
	</style>

	<div class="main">

		<div class="booking-details">
			<h3 class="movieName">Jaari</h3>
			<span class="booking-audi">City Cinema &gt; HALL B</span>
			<span class="booking-date">May 8, 2023</span><span class="booking-time">12:30 PM</span>
		</div>

		<a onclick="history.back()" id="closeSeats" class="sfPageSliderCloseBtn close-menu"></a>

		<div class="seat-status">
			<ul>
				<li><span class="sfAvailableSeat"></span>Available</li>
				<li><span class="sfSelectedSeat"></span>Selected</li>
				<li><span class="sfBookedSeat"></span>Booked</li>
				<li><span class="sfSoldSeat"></span>Sold</li>
				<li class="mobile-notice" style="display:none">** Please use right side space if scroll do not work
					normally
				</li>
			</ul>
		</div>
		


		<div class="all">
			<select hidden id="movie">
			</select>	

			<div class="container">
				<div class="screen">SCREEN</div>
				
				<div class="row">
					<div class="seat" data-value="F1">F1</div>
					<div class="seat box" data-value="F2">F2</div>
					<div class="seat box" data-value="F3">F3</div>
					<div class="seat box" data-value="F4">F4</div>
					<div class="seat box sold" data-value="F5">F5</div>
					<div class="seat box sold" data-value="F6">F6</div>
					<div class="seat box sold" data-value="F7">F7</div>
					<div class="seat box" data-value="F8">F8</div>
				</div>
				<div class="row">
					<div class="seat box" data-value="E1">E1</div>
					<div class="seat box" data-value="E2">E2</div>
					<div class="seat box" data-value="E3">E3</div>
					<div class="seat box sold" data-value="E4">E4</div>
					<div class="seat box sold" data-value="E5">E5</div>
					<div class="seat box" data-value="E6">E6</div>
					<div class="seat box" data-value="E7">E7</div>
					<div class="seat box" data-value="E8">E8</div>
				</div>
				<div class="row">
					<div class="seat box" data-value="D1">D1</div>
					<div class="seat box" data-value="D2">D2</div>
					<div class="seat box" data-value="D3">D3</div>
					<div class="seat box" data-value="D4">D4</div>
					<div class="seat box" data-value="D5">D5</div>
					<div class="seat box" data-value="D6">D6</div>
					<div class="seat box" data-value="D7">D7</div>
					<div class="seat box" data-value="D8">D8</div>
				</div>
				<div class="row">
					<div class="seat box" data-value="C1">C1</div>
					<div class="seat box" data-value="C2">C2</div>
					<div class="seat box" data-value="C3">C3</div>
					<div class="seat box" data-value="C4">C4</div>
					<div class="seat box" data-value="C5">C5</div>
					<div class="seat box" data-value="C6">C6</div>
					<div class="seat box sold" data-value="C7">C7</div>
					<div class="seat box sold" data-value="C8">C8</div>
				</div>
				<div class="row">
					<div class="seat box" data-value="B1" >B1</div>
					<div class="seat box" data-value="B2">B2</div>
					<div class="seat box" data-value="B3">B3</div>
					<div class="seat box sold" data-value="B4">B4</div>
					<div class="seat box sold" data-value="B5">B5</div>
					<div class="seat box <?php echo $sold ?>" data-value="B6">B6</div>
					<div class="seat box" data-value="B7">B7</div>
					<div class="seat box" data-value="B8">B8</div>
				</div>
				<div class="row">
					<div class="seat box" data-value="A1">A1</div>
					<div class="seat box" data-value="A2">A2</div>
					<div class="seat box" data-value="A3">A3</div>
					<div class="seat box" data-value="A4">A4</div>
					<div class="seat box" data-value="A5">A5</div>
					<div class="seat box" data-value="A6">A6</div>
					<div class="seat box" data-value="A7">A7</div>
					<div class="seat box" data-value="A8">A8</div>
				</div>

			</div>
			<script src="seat/app.js"></script>
			
			<p class="text">
				<?php
				if (isset($_POST['values'])) {
					$selectedValues = $_POST['values'];
					
					echo $selectedValues;
				  }
				  
				?>
				<div id="selected-values"></div>
				You have selected <span id="count">0</span> seat for a price of RS.<span id="total">0</span>
			</p>
		</div>
		<script src="seat/script.js"></script>
		
	</body>
	
	</html>