-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 12:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hidden_gems`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Trails'),
(2, 'Food'),
(3, 'Lake'),
(4, 'Indoor');

-- --------------------------------------------------------

--
-- Table structure for table `fav_local`
--

DROP TABLE IF EXISTS `fav_local`;
CREATE TABLE `fav_local` (
  `fl_id` int(11) NOT NULL,
  `follow_date` datetime NOT NULL,
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav_local`
--

INSERT INTO `fav_local` (`fl_id`, `follow_date`, `location_id`, `user_id`) VALUES
(1, '2023-05-25 08:54:17', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `location_id` mediumint(9) NOT NULL,
  `title` varchar(300) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_published` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `title`, `lat`, `lng`, `category_id`, `image`, `user_id`, `is_published`) VALUES
(22, 'Treehouse', 0, 0, 1, '4915a364d9bfedbe60baa5cef222cd90e603801d', 5, 1),
(23, 'The Cycle Bed and Breakfast', 0, 0, 4, '1722b855fb27e6861a5787740e62d051375fa9d7', 4, 1),
(24, 'Yummy Store', 0, 0, 2, 'af9651894b1fa4b834fba922cd746d732dadea0e', 6, 1),
(25, 'Landing Platform and Cantina', 0, 0, 2, '7f1e4615fdc2a0214309e1b305fde9c753f538b7', 7, 1),
(26, 'Mission Beach', 0, 0, 3, '0b720bdfa401ebce7194e306bafa1106f3f37773', 7, 1),
(27, 'Book Store', 0, 0, 2, '257982171e1663d38029b16aadb20e310156773e', 7, 1),
(29, 'El Cajon Trail', 0, 0, 1, 'b0557e4e5fa9c1256075b31a1e7e6720c18b346c', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` mediumint(9) NOT NULL,
  `body` text NOT NULL,
  `photo` text NOT NULL,
  `date` datetime NOT NULL,
  `is_approved` int(2) NOT NULL,
  `rating` tinyint(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `body`, `photo`, `date`, `is_approved`, `rating`, `user_id`, `location_id`) VALUES
(8, 'Me and my friends found this tree house near vista trails. Really Cool!', '', '2023-06-04 12:53:21', 1, 4, 5, 22),
(9, 'I hade a great night stay at this little bed and breakfast', '', '2023-06-04 12:56:49', 1, 3, 4, 23),
(10, 'This place looks cool!', '', '2023-06-04 13:02:30', 1, 5, 6, 22),
(11, 'Yummy cups of whipped cream', '', '2023-06-04 13:02:59', 1, 2, 6, 24),
(12, 'I did not like sleeping here, Not enough pup space', '', '2023-06-04 13:03:43', 1, 3, 6, 23),
(13, 'Took great care of my ship. Cantina was decent', '', '2023-06-04 13:05:55', 1, 4, 7, 25),
(14, 'My kinda place. Cheep drinks and clean bed', '', '2023-06-04 13:06:15', 1, 4, 7, 23),
(15, 'Me and my friends had a really fun photoshoot here', '', '2023-06-04 13:27:06', 1, 5, 7, 26),
(16, 'This bookstore is great! and Allows pets', '', '2023-06-04 13:45:50', 1, 5, 6, 27),
(17, 'This place looks scary!', '', '2023-06-04 14:02:14', 1, 0, 6, 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(254) NOT NULL,
  `profile_pic` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `area` text NOT NULL,
  `admin` int(2) NOT NULL,
  `join_date` datetime NOT NULL,
  `access_token` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `profile_pic`, `bio`, `area`, `admin`, `join_date`, `access_token`) VALUES
(4, 'Username', '$2y$10$jWDKySRgNjxGPhZ0Hhh9DebIfeJN8TmnIgUIqX0v0PaNZ.YWErS/e', 'username@gmail.com', '', '', '', 0, '2023-05-26 09:06:49', 11704705),
(5, 'hidden_aric', '$2y$10$vKyJNRdX0Ngz2kJ0xcK7muHhvib0grfD4/rCo.XppukKjjXx5zdJK', 'hidden_aric@gmail.com', '', '', '', 0, '2023-06-03 20:26:24', 33),
(6, 'SmokeyBasil', '$2y$10$WTtCW3umvijw3eEXcGVtiuVLgs9vdepo4ky8C1hFSgUZed3rDb0xO', 'SmokeyBasil@gmail.com', '', '', '', 0, '2023-06-04 13:00:58', 0),
(7, 'Password', '$2y$10$jKMsXSfx1aJ51HYGeoJ5CuBiv9qXwxt15WRtKLw6rsrCtzuO8sVgy', 'password@gmail.com', '', '', '', 0, '2023-06-04 13:04:20', 414298),
(8, 'Sirachacha', '$2y$10$yDF3u6LYn960/nfy1rT0bu1RzHe135LG88PPEPWJlcLIHxRgRFwJ6', 'Sirachachachacha@gmail.com', '', '', '', 0, '2023-06-04 14:23:09', 396876);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `fav_local`
--
ALTER TABLE `fav_local`
  ADD PRIMARY KEY (`fl_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fav_local`
--
ALTER TABLE `fav_local`
  MODIFY `fl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
