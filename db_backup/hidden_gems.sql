-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 10:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hidden_gems`
--
CREATE DATABASE IF NOT EXISTS `hidden_gems` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hidden_gems`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Trails'),
(2, 'Food');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `title`, `lat`, `lng`, `category_id`) VALUES
(1, 'Lake Poway ', 32.96273, -117.03624, 1),
(2, 'Del Mar Trails', 32.959492, -117.265244, 1),
(3, 'Box Lunch - Boba', 32.762260764670565, -117.06566017385607, 2),
(4, 'Box Lunch - Boba', 32.762260764670565, -117.06566017385607, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `body`, `photo`, `date`, `is_approved`, `rating`, `user_id`, `location_id`) VALUES
(1, 'I had a great time at this location! Great trails and lots of cheap food place. ', 'https://placebear.com/300/300', '2023-05-25 08:41:06', 1, 5, 1, 2),
(2, 'This restaurant has a great skate park next to it', 'https://placebear.com/600/600', '2023-05-25 09:24:20', 1, 4, 2, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `profile_pic`, `bio`, `area`, `admin`, `join_date`, `access_token`) VALUES
(1, 'UserRic', 'unsecurepassword', 'ric@gmail.com', NULL, 'I love hiking', 'San Diego', 1, '2023-05-25 00:00:00', NULL),
(2, 'UserNick', 'unsecurepassword', 'usernick@gmail.com', NULL, 'Ima skater bro', 'Vista', 0, '2023-05-25 09:23:25', NULL);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fav_local`
--
ALTER TABLE `fav_local`
  MODIFY `fl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
