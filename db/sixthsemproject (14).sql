-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 07:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sixthsemproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `seats` text NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `ticket` varchar(50) NOT NULL,
  `pay_status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `booked_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `userID`, `movieID`, `seats`, `show_date`, `show_time`, `invoice_no`, `ticket`, `pay_status`, `booked_date`) VALUES
(671, 1, 1, 'E8', '2023-10-17', '13:00:00', '', '', 'unpaid', '2023-10-17 02:53:22'),
(672, 1, 1, 'D5', '2023-10-17', '13:00:00', '', '', 'unpaid', '2023-10-17 02:54:04'),
(673, 1, 1, 'C5', '2023-10-17', '13:00:00', '', '', 'unpaid', '2023-10-17 02:54:35'),
(674, 1, 1, 'D3', '2023-10-17', '13:00:00', '', '', 'unpaid', '2023-10-17 02:55:33'),
(675, 1, 1, 'D6, D7, C6, C7, B6', '2023-10-18', '16:00:00', '', '', 'unpaid', '2023-10-17 02:55:45'),
(676, 1, 1, 'C2', '2023-10-18', '13:00:00', 'RJA2VBW0', 'Download_ticket_RJA2VBW0', 'unpaid', '2023-10-17 19:13:34'),
(677, 1, 1, 'C4', '2023-10-18', '13:00:00', '631C6QXV', 'Download_ticket_631C6QXVpdf', 'unpaid', '2023-10-17 19:14:14'),
(678, 1, 1, 'A3', '2023-10-17', '13:00:00', 'Y0DIOLQT', 'Ticket_Y0DIOLQT.pdf', 'unpaid', '2023-10-17 19:14:32'),
(679, 1, 1, 'D3, D5', '2023-10-18', '13:00:00', 'LTTW2EOJ', 'Ticket_LTTW2EOJ.pdf', 'unpaid', '2023-10-17 21:58:25'),
(680, 2, 1, 'D3, D4, C3', '2023-10-18', '16:00:00', '6NTCRHXV', 'Ticket_6NTCRHXV.pdf', 'unpaid', '2023-10-18 13:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieID` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `movie_description` text NOT NULL,
  `movie_price` int(11) NOT NULL,
  `videoID` varchar(50) NOT NULL,
  `movie_duration` int(50) NOT NULL,
  `release_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `movie_banner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `movie_name`, `movie_description`, `movie_price`, `videoID`, `movie_duration`, `release_date`, `end_date`, `movie_banner`) VALUES
(1, 'Lakhey', 'Sameer Maharjan, born in a family Lakhey, is a bank manager. He regards Lakhey as Lord Indra and the protector of the community. His professional and family life is ruined as he gets trapped in the bank fraud case. Then he devises an increasingly perilous series of revenge tactics.', 120, 'gnuTqK0E6EE', 120, '2023-09-20', '2023-10-30', 'img/banners/652bf4eb07ef36.82396125.jpeg'),
(2, 'Fulbari', 'Hello This is description', 113, 'gnuTqK0E6EE', 115, '2023-08-25', '2023-10-30', 'img/movie-img/fulbari-banner.jpeg'),
(3, 'Fulbari', 'Hello This is description', 143, 'gnuTqK0E6EE', 110, '2023-10-25', '2023-10-30', 'img/movie-img/fulbari-banner.jpeg'),
(4, 'Lakhey', 'Hello This is description', 11, 'xyyKHCbD1jo', 108, '2023-11-10', '2023-11-30', 'img/movie-img/lakhey-thumbnail.jpeg'),
(13, 'barbie', 'yaguygsias', 120, 'erds54w32', 123, '2023-10-20', '2023-10-25', 'img/banners/652f8c6c78a4b8.61824608.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `movietime`
--

CREATE TABLE `movietime` (
  `movietimeID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `showID` int(11) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `movietime_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movietime`
--

INSERT INTO `movietime` (`movietimeID`, `movieID`, `showID`, `start_date`, `end_date`, `movietime_status`) VALUES
(1, 1, 3, '2023-06-28', '2023-10-30', 'verified'),
(2, 1, 4, '2023-06-29', '2023-10-29', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `notify_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_referenceID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `bookingID`, `payment_amount`, `payment_date`, `payment_method`, `payment_referenceID`) VALUES
(1, 92, '20.00', '2023-08-11 03:05:33', 'Online Payment', '123456789'),
(2, 93, '20.00', '2023-10-06 00:42:01', 'Online Payment', '123456789'),
(3, 653, '20.00', '2023-10-16 23:40:01', 'Online Payment', '123456789'),
(4, 654, '20.00', '2023-10-16 23:41:27', 'Online Payment', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seatID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `seat_number` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seatID`, `bookingID`, `seat_number`, `status`) VALUES
(219, 671, 'E8', 'booked'),
(220, 672, 'D5', 'booked'),
(221, 673, 'C5', 'booked'),
(222, 674, 'D3', 'booked'),
(223, 675, 'D6', 'booked'),
(224, 675, 'D7', 'booked'),
(225, 675, 'C6', 'booked'),
(226, 675, 'C7', 'booked'),
(227, 675, 'B6', 'booked'),
(228, 676, 'C2', 'booked'),
(229, 677, 'C4', 'booked'),
(230, 678, 'A3', 'booked'),
(231, 679, 'D3', 'booked'),
(232, 679, 'D5', 'booked'),
(233, 680, 'D3', 'booked'),
(234, 680, 'D4', 'booked'),
(235, 680, 'C3', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settingID` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `seat_price` int(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_favicon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingID`, `site_title`, `seat_price`, `site_logo`, `site_favicon`) VALUES
(1, 'Cinepal', 20, 'img/favicons/whitecinepal.jpg', 'img/favicons/favicon.ico');

-- --------------------------------------------------------

--
-- Table structure for table `showtime`
--

CREATE TABLE `showtime` (
  `showID` int(11) NOT NULL,
  `show_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtime`
--

INSERT INTO `showtime` (`showID`, `show_time`) VALUES
(1, '07:00:00'),
(2, '10:00:00'),
(3, '13:00:00'),
(4, '16:00:00'),
(5, '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'customer',
  `profile_img` varchar(400) DEFAULT NULL,
  `reset_code` varchar(50) NOT NULL,
  `register_date` varchar(50) NOT NULL,
  `expiry_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fullname`, `email`, `phone_number`, `password`, `user_type`, `profile_img`, `reset_code`, `register_date`, `expiry_time`) VALUES
(1, 'Saugat Nepal', 'nepal4972@gmail.com', '9862517280', 'ed76516ed5436cea91dfac6a53886d6c', 'admin', 'img/profile-img/652bf3c46e28e8.46157727.jpg', '8TK3SDBYG2', '2023-05-23', '1696270978'),
(2, 'Saugat Nepal', 'sandnnepal4972@gmail.com', '9862517282', 'ed76516ed5436cea91dfac6a53886d6c', 'customer', 'img/profile-img/profile.jpg', '', '2023-05-23', ''),
(56, '', 'nepal49727@gmail.com', '9862517247', 'c8d86ad5ed1add319e802f7f659df166', 'customer', NULL, '', '2023-10-10', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `bookingID` (`bookingID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bookingID_2` (`bookingID`),
  ADD KEY `movieID` (`movieID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieID`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `movieID_2` (`movieID`);

--
-- Indexes for table `movietime`
--
ALTER TABLE `movietime`
  ADD PRIMARY KEY (`movietimeID`),
  ADD KEY `showID` (`showID`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `movietimeID` (`movietimeID`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `movieID` (`movieID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `paymentID` (`paymentID`,`bookingID`),
  ADD KEY `bookingID` (`bookingID`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seatID`),
  ADD KEY `bookingID` (`bookingID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingID`);

--
-- Indexes for table `showtime`
--
ALTER TABLE `showtime`
  ADD PRIMARY KEY (`showID`),
  ADD KEY `showID` (`showID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `userID_2` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `movietime`
--
ALTER TABLE `movietime`
  MODIFY `movietimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showtime`
--
ALTER TABLE `showtime`
  MODIFY `showID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`);

--
-- Constraints for table `movietime`
--
ALTER TABLE `movietime`
  ADD CONSTRAINT `movietime_ibfk_1` FOREIGN KEY (`showID`) REFERENCES `showtime` (`showID`),
  ADD CONSTRAINT `movietime_ibfk_2` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`);

--
-- Constraints for table `notify`
--
ALTER TABLE `notify`
  ADD CONSTRAINT `notify_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `notify_ibfk_2` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `bookings` (`bookingID`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `bookings` (`bookingID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
