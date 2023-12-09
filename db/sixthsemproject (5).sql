-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 03:10 PM
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
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `ticket` varchar(50) DEFAULT NULL,
  `booked_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `userID`, `movieID`, `show_date`, `show_time`, `invoice_no`, `ticket`, `booked_date`) VALUES
(684, 1, 4, '2023-11-21', '07:00:00', '9FKVEKQT', 'Ticket_9FKVEKQT.pdf', '2023-11-21 00:24:11'),
(712, 1, 4, '2023-11-30', '07:00:00', 'DSQPIMYG', NULL, '2023-11-29 23:18:30'),
(713, 1, 4, '2023-11-30', '07:00:00', 'K71CLV4A', NULL, '2023-11-29 23:18:33'),
(733, 1, 4, '2023-12-03', '07:00:00', '7IIW4PBX', 'Ticket_7IIW4PBX.pdf', '2023-12-02 20:39:04'),
(734, 1, 4, '2023-12-03', '07:00:00', 'IOJV2E84', 'Ticket_.pdf', '2023-12-02 21:43:40'),
(735, 1, 4, '2023-12-03', '07:00:00', 'KPJD18JV', 'Ticket_KPJD18JV.pdf', '2023-12-02 21:50:20'),
(736, 1, 4, '2023-12-03', '07:00:00', 'UWEPME8G', 'Ticket_UWEPME8G.pdf', '2023-12-02 22:16:33'),
(737, 1, 4, '2023-12-03', '07:00:00', 'UN92GZLY', 'Ticket_UN92GZLY.pdf', '2023-12-02 22:19:42'),
(738, 1, 4, '2023-12-03', '07:00:00', 'YFO9TWZ3', 'Ticket_YFO9TWZ3.pdf', '2023-12-02 22:41:32'),
(739, 1, 4, '2023-12-07', '07:00:00', 'JOXFJ0G8', 'Ticket_JOXFJ0G8.pdf', '2023-12-06 21:12:48'),
(740, 1, 4, '2023-12-07', '07:00:00', 'JQRDCO39', 'Ticket_JQRDCO39.pdf', '2023-12-06 21:34:34'),
(741, 1, 4, '2023-12-07', '07:00:00', 'SIRIFVKK', 'Ticket_SIRIFVKK.pdf', '2023-12-06 21:48:06'),
(742, 1, 4, '2023-12-07', '07:00:00', 'OTY1ZRZJ', 'Ticket_OTY1ZRZJ.pdf', '2023-12-06 21:49:26'),
(743, 1, 4, '2023-12-07', '07:00:00', 'P45O6DZS', 'Ticket_P45O6DZS.pdf', '2023-12-06 22:12:32'),
(744, 1, 4, '2023-12-07', '07:00:00', '0W34W782', 'Ticket_0W34W782.pdf', '2023-12-06 22:13:48'),
(745, 1, 4, '2023-12-07', '07:00:00', 'LNSL1ED6', 'Ticket_LNSL1ED6.pdf', '2023-12-06 22:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `carouselID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `carousel_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`carouselID`, `movieID`, `carousel_image`) VALUES
(1, 4, 'fulbari-banner.jpeg');

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
  `movie_banner` varchar(255) NOT NULL,
  `inserted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `movie_name`, `movie_description`, `movie_price`, `videoID`, `movie_duration`, `release_date`, `end_date`, `movie_banner`, `inserted_date`) VALUES
(1, 'Lakhey', 'Sameer Maharjan, born in a family Lakhey, is a bank manager. He regards Lakhey as Lord Indra and the protector of the community. His professional and family life is ruined as he gets trapped in the bank fraud case. Then he devises an increasingly perilous series of revenge tactics.', 120, 'gnuTqK0E6EE', 120, '2023-11-20', '2023-12-30', 'img/banners/652bf4eb07ef36.82396125.jpeg', '2023-10-10 17:24:11'),
(3, 'Fulbari', 'Hello This is description', 143, 'gnuTqK0E6EE', 110, '2023-10-25', '2023-12-30', 'img/movie-img/fulbari-banner.jpeg', '2023-10-05 17:24:11'),
(4, 'Lakhey', 'Hello This is description', 40, 'xyyKHCbD1jo', 108, '2023-11-10', '2023-12-25', 'img/movie-img/lakhey-thumbnail.jpeg', '2023-10-14 17:24:11'),
(5, 'test test', 'asdfghgdfsda34512', 120, 'gnuTqK0E6EE', 123, '2023-12-21', '2023-12-21', 'img/banners/6532c5519bce13.00654439.jpeg', '2023-10-21 00:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `movietime`
--

CREATE TABLE `movietime` (
  `movietimeID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `showID` int(11) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movietime`
--

INSERT INTO `movietime` (`movietimeID`, `movieID`, `showID`, `start_date`, `end_date`) VALUES
(21, 4, 1, '2023-12-08', '2023-12-27'),
(22, 4, 2, '2023-12-08', '2023-12-19'),
(23, 4, 3, '2023-12-08', '2023-12-18'),
(25, 4, 4, '2023-12-08', '2023-12-21'),
(26, 4, 5, '2023-12-08', '2023-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `notify_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`notify_id`, `userID`, `movieID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 56, 1),
(32, 1, 3),
(33, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `reference_code` varchar(50) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `bookingID`, `payment_amount`, `payment_method`, `payment_status`, `reference_code`, `payment_date`) VALUES
(3, 684, '20.00', 'esewa', 'unpaid', '123456789', '2023-10-16 23:40:01'),
(13, 733, '80.00', '', 'unpaid', '', '2023-12-02 20:39:04'),
(14, 734, '40.00', '', 'unpaid', '', '2023-12-02 21:43:40'),
(15, 735, '120.00', '', 'unpaid', '', '2023-12-02 21:50:20'),
(16, 736, '120.00', 'esewa', 'paid', '', '2023-12-02 22:16:33'),
(17, 737, '120.00', '', 'unpaid', '', '2023-12-02 22:19:42'),
(18, 738, '40.00', 'esewa', 'paid', '', '2023-12-02 22:41:32'),
(19, 739, '80.00', 'esewa', 'paid', '', '2023-12-06 21:12:49'),
(20, 740, '40.00', 'esewa', 'paid', '', '2023-12-06 21:34:34'),
(21, 741, '40.00', 'esewa', 'paid', '', '2023-12-06 21:48:06'),
(22, 742, '40.00', 'esewa', 'paid', '', '2023-12-06 21:49:26'),
(23, 743, '40.00', '', 'unpaid', '', '2023-12-06 22:12:32'),
(24, 744, '40.00', '', 'unpaid', '', '2023-12-06 22:13:48'),
(25, 745, '40.00', 'esewa', 'paid', '0006IPM', '2023-12-06 22:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seatID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `seat_number` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seatID`, `bookingID`, `seat_number`, `status`) VALUES
(241, 684, 'D4', 'booked'),
(268, 712, 'A4', NULL),
(269, 712, 'A5', NULL),
(270, 713, 'A4', NULL),
(271, 713, 'A5', NULL),
(294, 733, 'A4', 'booked'),
(295, 733, 'A5', 'booked'),
(296, 734, 'A6', 'sold'),
(297, 735, 'E3', 'sold'),
(298, 735, 'E4', 'sold'),
(299, 735, 'D5', 'sold'),
(300, 736, 'C2', 'sold'),
(301, 736, 'C3', 'sold'),
(302, 736, 'B7', 'sold'),
(303, 737, 'E7', 'sold'),
(304, 737, 'E8', 'sold'),
(305, 737, 'D7', 'sold'),
(306, 738, 'B5', 'sold'),
(307, 739, 'B5', 'sold'),
(308, 739, 'A5', 'sold'),
(309, 740, 'B4', 'sold'),
(310, 741, 'A7', 'sold'),
(311, 742, 'B8', 'sold'),
(312, 743, 'C7', 'booked'),
(313, 744, 'C8', 'booked'),
(314, 745, 'D4', 'sold');

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
(1, 'Cinepal', 30, '653520ba594d07.45107113.jpg', '653520ba597210.41155176.ico');

-- --------------------------------------------------------

--
-- Table structure for table `showtime`
--

CREATE TABLE `showtime` (
  `showID` int(11) NOT NULL,
  `show_time` varchar(50) NOT NULL
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
  `register_date` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `expiry_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fullname`, `email`, `phone_number`, `password`, `user_type`, `profile_img`, `reset_code`, `register_date`, `expiry_time`) VALUES
(1, 'Saugat Nepal', 'nepal4972@gmail.com', '9862517280', 'ed76516ed5436cea91dfac6a53886d6c', 'admin', 'img/profile-img/652bf3c46e28e8.46157727.jpg', 'EMVYK57JX1', '2023-05-23', '1701881628'),
(2, 'Saugat Nepal', 'sandnnepal4972@gmail.com', '9862517282', 'ed76516ed5436cea91dfac6a53886d6c', 'customer', 'img/profile-img/profile.jpg', '', '2023-05-23', ''),
(56, '', 'snnepal4972@gmail.com', '9862517247', 'c8d86ad5ed1add319e802f7f659df166', 'customer', NULL, '', '2023-10-10', '');

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
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`carouselID`),
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
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=746;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `carouselID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `movietime`
--
ALTER TABLE `movietime`
  MODIFY `movietimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showtime`
--
ALTER TABLE `showtime`
  MODIFY `showID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Constraints for table `carousel`
--
ALTER TABLE `carousel`
  ADD CONSTRAINT `carousel_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`);

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
