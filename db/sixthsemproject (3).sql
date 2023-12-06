-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 06:16 PM
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
  `movie_banner` varchar(255) NOT NULL,
  `inserted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `movie_name`, `movie_description`, `movie_price`, `videoID`, `movie_duration`, `release_date`, `end_date`, `movie_banner`, `inserted_date`) VALUES
(1, 'Lakhey', 'Sameer Maharjan, born in a family Lakhey, is a bank manager. He regards Lakhey as Lord Indra and the protector of the community. His professional and family life is ruined as he gets trapped in the bank fraud case. Then he devises an increasingly perilous series of revenge tactics.', 120, 'gnuTqK0E6EE', 120, '2023-12-20', '2023-10-30', 'img/banners/652bf4eb07ef36.82396125.jpeg', '2023-10-10 17:24:11'),
(3, 'Fulbari', 'Hello This is description', 143, 'gnuTqK0E6EE', 110, '2023-10-25', '2023-12-30', 'img/movie-img/fulbari-banner.jpeg', '2023-10-05 17:24:11'),
(4, 'Lakhey', 'Hello This is description', 40, 'xyyKHCbD1jo', 108, '2023-11-10', '2023-12-25', 'img/movie-img/lakhey-thumbnail.jpeg', '2023-10-14 17:24:11'),
(5, 'test 4', 'asdfghgdfsda', 120, 'gnuTqK0E6EE', 123, '2023-12-21', '2023-10-30', 'img/banners/6532c5519bce13.00654439.jpeg', '2023-10-21 00:07:09');

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
(1, 'Saugat Nepal', 'nepal4972@gmail.com', '9862517280', 'ed76516ed5436cea91dfac6a53886d6c', 'admin', 'img/profile-img/652bf3c46e28e8.46157727.jpg', 'AC60DVZYOR', '2023-05-23', '1697808545'),
(2, 'Saugat Nepal', 'sandnnepal4972@gmail.com', '9862517282', 'ed76516ed5436cea91dfac6a53886d6c', 'customer', 'img/profile-img/profile.jpg', '', '2023-05-23', ''),
(56, '', 'snnepal4972@gmail.com', '9862517247', 'c8d86ad5ed1add319e802f7f659df166', 'customer', NULL, '', '2023-10-10', '');

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
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
