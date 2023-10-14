-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 05:19 PM
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
  `booked_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `userID`, `movieID`, `seats`, `show_date`, `show_time`, `booked_date`) VALUES
(1, 1, 1, 'A1, A2', '2023-07-25', '16:00:00', '2023-07-19 15:30:00'),
(2, 2, 3, 'C3, D2', '0000-00-00', '13:00:00', '2023-06-29 10:45:00'),
(3, 2, 1, 'E5, F4', '2023-07-02', '16:00:00', '2023-06-30 09:15:00'),
(87, 2, 1, 'E4,C6,D7', '2023-07-06', '16:00:00', '2023-07-05 01:45:09'),
(88, 1, 1, 'E4,C6,D7', '2023-07-06', '16:00:00', '2023-07-06 00:56:07'),
(89, 1, 1, 'E4,C6,D7', '2023-07-04', '16:00:00', '2023-08-11 03:03:13'),
(90, 1, 1, 'E4,C6,D7', '2023-10-08', '13:00:00', '2023-08-11 03:04:35'),
(91, 2, 3, 'E4,C6,D7', '2023-08-11', '16:00:00', '2023-08-11 03:04:51'),
(92, 2, 1, 'E4,C6,D7', '2023-09-25', '16:00:00', '2023-08-11 03:05:33'),
(93, 1, 1, 'E4,C6,D7', '2023-10-14', '13:00:00', '2023-10-06 00:42:01');

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
(1, 'Lakhey', 'Sameer Maharjan, born in a family Lakhey, is a bank manager. He regards Lakhey as Lord Indra and the protector of the community. His professional and family life is ruined as he gets trapped in the bank fraud case. Then he devises an increasingly perilous series of revenge tactics.', 120, 'gnuTqK0E6EE', 120, '2023-06-25', '2023-10-30', 'img/movie-img/lakhey-thumbnail.jpeg'),
(2, 'Fulbari', 'Hello This is description', 113, 'gnuTqK0E6EE', 115, '2023-08-25', '2023-10-30', 'img/movie-img/fulbari-banner.jpeg'),
(3, 'Fulbari', 'Hello This is description', 143, 'gnuTqK0E6EE', 110, '2023-06-25', '2023-09-30', 'img/movie-img/fulbari-banner.jpeg'),
(4, 'Lakhey', 'Hello This is description', 11, 'xyyKHCbD1jo', 108, '2023-10-10', '2023-010-25', 'img/movie-img/lakhey-thumbnail.jpeg');

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
(2, 93, '20.00', '2023-10-06 00:42:01', 'Online Payment', '123456789');

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
(15, 1, 'A1', 'booked'),
(16, 1, 'A2', 'booked'),
(17, 1, 'A5', 'sold'),
(18, 2, 'C3', 'booked'),
(19, 2, 'D2', 'booked'),
(154, 88, 'E4', 'booked'),
(155, 88, 'C6', 'booked'),
(156, 88, 'D7', 'booked'),
(157, 89, 'E4', 'booked'),
(158, 89, 'C6', 'booked'),
(159, 89, 'D7', 'booked'),
(160, 90, 'E4', 'booked'),
(161, 90, 'C6', 'booked'),
(162, 90, 'D7', 'booked'),
(163, 91, 'E4', 'sold'),
(164, 91, 'C6', 'booked'),
(165, 91, 'D7', 'booked'),
(166, 92, 'D3', 'booked'),
(167, 92, 'C6', 'booked'),
(168, 92, 'D7', 'booked'),
(169, 93, 'E4', 'sold'),
(170, 93, 'C6', 'sold'),
(171, 93, 'D7', 'sold');

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
(1, 'Saugat Nepal', 'nepal4972@gmail.com', '9862517280', 'ed76516ed5436cea91dfac6a53886d6c', 'admin', 'img/profile-img/profile.jpg', '8TK3SDBYG2', '2023-05-23', '1696270978'),
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
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `movietime`
--
ALTER TABLE `movietime`
  MODIFY `movietimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

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
