-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2021 at 06:09 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `custom_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` mediumtext NOT NULL,
  `body` longtext NOT NULL,
  `user_id` int NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `user_id`, `category`, `image`) VALUES
(1, 'Test Article Title 1', 'Test Article Body 1', 10, '', '0'),
(2, 'Test Article Title 2', 'Test Article Body 2', 10, '', '0'),
(3, 'Demo Title', 'Demo Body', 10, '', '0'),
(4, 'Test Title 3', 'Test Body 3', 10, '', '0'),
(5, 'Demo', 'Demo', 10, '', '0'),
(6, 'Testing', 'Testing', 10, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `customBlock`
--

CREATE TABLE `customBlock` (
  `id` int NOT NULL,
  `block_title` varchar(255) DEFAULT NULL,
  `block_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customBlock`
--

INSERT INTO `customBlock` (`id`, `block_title`, `block_desc`) VALUES
(1, 'test', '<p>test</p>'),
(2, 'test 2', '<p>test 2</p>'),
(3, 'test 3', 'test 3'),
(4, 'Demo Block Title', 'Demo Block Body');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int NOT NULL,
  `title` text NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `title`, `link`) VALUES
(1, 'Home', 'home'),
(3, 'Blocks', 'block-info'),
(5, 'Menus', 'menu-info'),
(8, 'Add menu', 'menu-form');

-- --------------------------------------------------------

--
-- Table structure for table `userauth`
--

CREATE TABLE `userauth` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('admin','authenticated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userauth`
--

INSERT INTO `userauth` (`id`, `username`, `password`, `roles`) VALUES
(1, 'Vivek', '$2y$10$NS1WRopghpnkEzVUX2Rr9OJxntxJV.4Quig7wEJ9SxlBT5Gs7VVae', 'authenticated'),
(2, 'vbad', '$2y$10$HC98C1paWK.75EEZSb8fq.NCkrXQXOsWrsQmM/3GmFZ5UyU9as/Zi', 'authenticated'),
(3, 'vivek', '$2y$10$LK.J3qXSDnvncCVm1FOhoOdZbak48CZ94W8bAUhMzHu/Z6sBrhmSC', 'authenticated');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`) VALUES
(1, 'Tony Stark', '1234567890'),
(2, 'ABC', '0987654321'),
(3, 'ahdcjah', '2173126e481'),
(4, 'SDHAHKA', '1919914'),
(5, 'wdfghj23456789', '2345678'),
(10, 'qwerty', '123456789'),
(11, 'qwerty', '123456789'),
(12, 'qqwert', '1234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `userauth`
--
ALTER TABLE `userauth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userauth`
--
ALTER TABLE `userauth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
