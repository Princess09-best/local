-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 03:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ashesigram_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts_db`
--

CREATE TABLE `posts_db` (
  `id` bigint(19) NOT NULL,
  `post_id` bigint(19) NOT NULL,
  `user_id` bigint(19) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `has_image` tinyint(1) NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_profile` tinyint(1) NOT NULL,
  `is_cover` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(19) NOT NULL,
  `user_id` bigint(19) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(1000) NOT NULL,
  `cover_image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `first_name`, `last_name`, `gender`, `email`, `password`, `url_address`, `date`, `profile_image`, `cover_image`) VALUES
(1, 39744689813492348, 'Shay', 'Leblanc', 'Female', 'zupavuqaza@mailinator.com', '', 'shay.leblanc', '2024-04-18 15:26:51', '', ''),
(2, 4670, 'Shay', 'Leblanc', 'Female', 'zupavuqaza@mailinator.com', '', 'shay.leblanc', '2024-04-18 15:29:06', '', ''),
(3, 8575192744059638956, 'Princess', 'AsiruBalogun', 'Female', 'faymousse09@gmail.com', '', 'princess.asirubalogun', '2024-04-18 15:30:06', '', ''),
(5, 630541655, 'Terry', 'Thompson', 'Male', 'terrythompson@gmail.com', '', 'terry.thompson', '2024-04-19 01:46:36', '', ''),
(6, 89027101, 'Terry', 'Thompson', 'Female', 'perrythompson@gmail.com', '$2y$10$U2tDQHlm55X06xkuC/1hceQgm27wToGZADA1mzWzNVL1zDrd4GacW', 'terry.thompson', '2024-04-19 02:18:48', '', ''),
(7, 42584, 'Layla', 'Love', 'Female', 'laylalove@gmail.com', '$2y$10$ZUCohxOmWhVSlQiZlmFVLuN/xq6/y9n94Bdpy4a/ai.qUcUhE2EPi', 'layla.love', '2024-04-19 02:20:18', '', ''),
(8, 66252, 'Layla', 'Lorry', 'Female', 'princess.asirubalogun@gmail.com', '$2y$10$aJZX5C/lq97YHRSYbA/bQeOUR8D5mS/M5zByloxUfkyXvRZHlCKli', 'layla.lorry', '2024-04-19 09:22:59', '', ''),
(9, 3550, 'Erica', 'Richmond', 'Male', 'erica@gmail.com', '$2y$10$NwA2pkw1ZAK4MI9xoxIgAeUYz6t6s8VTAqKzk.jCQ60Drd/.MJIRW', 'erica.richmond', '2024-04-19 09:55:39', '', ''),
(10, 6595610821596663690, 'Jessica', 'Garrett', 'Male', 'jessica@gmail.com', '$2y$10$wxhMtrfqTYhriL4UbZt/ru8A73FQRMdL4Dwj6Ui/l14WINhIN0y4u', 'jessica.garrett', '2024-04-19 09:58:37', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts_db`
--
ALTER TABLE `posts_db`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `likes` (`likes`),
  ADD KEY `date` (`date`),
  ADD KEY `has_image` (`has_image`),
  ADD KEY `is_profile` (`is_profile`),
  ADD KEY `is_cover` (`is_cover`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `gender` (`gender`),
  ADD KEY `email` (`email`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts_db`
--
ALTER TABLE `posts_db`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
