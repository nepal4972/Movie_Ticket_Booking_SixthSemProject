-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 09:36 PM
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
(1, 'Lakhey', 'Sameer Maharjan, born in a family Lakhey, is a bank manager. He regards Lakhey as Lord Indra and the protector of the community. His professional and family life is ruined as he gets trapped in the bank fraud case. Then he devises an increasingly perilous series of revenge tactics.', 12, 'xyyKHCbD1jo', 104, '2023-06-25', '2023-07-10', '/phpcode/test-projects/testtesttesttste/admin-database-connect-users/img/movie-img/lakhey-thumbnail.jpeg'),
(2, 'Fulbari', 'Hello This is description', 0, 'gnuTqK0E6EE', 115, '2023-07-25', '2023-07-05', '/phpcode/test-projects/testtesttesttste/admin-database-connect-users/img/movie-img/fulbari-banner.jpeg'),
(3, 'Fulbari', 'Hello This is description', 0, 'gnuTqK0E6EE', 110, '2023-06-25', '2023-07-01', '/phpcode/test-projects/testtesttesttste/admin-database-connect-users/img/movie-img/fulbari-banner.jpeg'),
(4, 'Lakhey', 'Hello This is description', 0, 'xyyKHCbD1jo', 108, '2023-07-25', '2023-07-10', '/phpcode/test-projects/testtesttesttste/admin-database-connect-users/img/movie-img/lakhey-thumbnail.jpeg');

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
  `user_type` varchar(50) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `reset_code` varchar(50) NOT NULL,
  `register_date` varchar(50) NOT NULL,
  `expiry_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fullname`, `email`, `phone_number`, `password`, `user_type`, `profile_img`, `reset_code`, `register_date`, `expiry_time`) VALUES
(1, 'Saugat Nepal', 'nepal4972@gmail.com', '9862517280', 'nepal4972', 'admin', './img/profile-img/WhatsApp Image 2023-06-05 at 10.01.40 PM.jpeg', '1GI3HUOQBC', '2023-05-23', '1686648061'),
(5, 'Saugat Nepal', 'sandnnepal4972@gmail.com', '', 'nepal4972', 'customer', './img/profile-img/WhatsApp Image 2023-06-05 at 10.01.40 PM.jpeg', 'MRWK1EHNZ3', '2023-05-23', '1685483050'),
(35, 'defghjkl', 'wdfgh@gmail.com', '1234567880', '123456789', 'admin', '', '', '2023-06-08', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieID`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `movieID_2` (`movieID`);

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
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
