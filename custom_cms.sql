-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2021 at 07:07 PM
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
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `user_id`) VALUES
(1, 'Test Article Title 1', 'Test Article Body 1', 10),
(2, 'Test Article Title 2', 'Test Article Body 2', 10),
(3, 'Demo Title', 'Demo Body', 10),
(4, 'Test Title 3', 'Test Body 3', 10),
(5, 'Demo', 'Demo', 10),
(6, 'Testing', 'Testing', 10);

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
(4, 'Demo Block Title', 'Demo Block Body'),
(5, 'custom', 'custom'),
(6, 'Test 4', 'Test 4'),
(7, 'abc', 'abc'),
(8, 'Testing', 'Testing'),
(9, 'test', 'TeSt'),
(10, 'Hey', 'Hey'),
(11, 'ReTest', 'ReTest');

-- --------------------------------------------------------

--
-- Table structure for table `userauth`
--

CREATE TABLE `userauth` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('admin','authenticated') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userauth`
--

INSERT INTO `userauth` (`id`, `username`, `password`, `roles`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'Tony Stark', '$2y$10$bNzv4mgxJUsxvPmSrMhHseozyvWLpsZOJO5PDjpcnBeMlcMKXNZeu', 'authenticated'),
(3, 'Thor', '$2y$10$LlsfGSRgqhMmOjD3FEJkCees31VbVaD0F5lZKM.Pun7QSGHikh6W.', 'authenticated'),
(4, 'Cap', '$2y$10$lV2prS8Yw2l96dtqNgN6HeJE2bbQyHyWrj8hltSSevz3G5ntPpI86', 'authenticated'),
(5, 'Tom', '$2y$10$JBjWu2l1MTgKwZTACcj3kOLO5zxamRMSA6DNh/Qyr9N.UMXOfButO', 'authenticated'),
(6, 'Test', '$2y$10$qSAljbyYr7Jj4j0I0ypIvu2Xk1uRGwbDPJgpXtKbiK/VEdQdxGuWS', 'authenticated'),
(7, 'DemoUser', '$2y$10$NSlYkRI7ZaMdSu/RUtd4LeyDoOXuvQJYlBAAI3b0WUiaumCRnkrg.', 'authenticated'),
(8, 'Ted', '$2y$10$3p/.U3SbtvGafdXV7vDxFuhEN9vxXrh1N12AWofHLPu.x5OtxpEgC', 'authenticated'),
(9, 'Raj', '$2y$10$f5s6qIKrJ26FsXm9xBUI9uQRtDK7u0x5LI7NZEEv2yl4.qGjdU1t2', 'authenticated'),
(10, 'John', '$2y$10$hVSvnPG9VFp8VFzaEt2Ykujm4Kz03NLT5uRkjnSLBlsW/9NHJkDhy', 'authenticated'),
(11, 'xyz', '$2y$10$x5lTIngFgchMrJsRAgp7CuaUJsbB9aeGVB2/Ss6r05Hzfs1JxJ2MW', 'authenticated');

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
(3, 'Tom', '8776623451'),
(9, 'Cap', '098765'),
(11, 'xyz', '0987654321'),
(14, 'John', '9992223334'),
(15, 'pqr', '12345'),
(16, 'Demo', '1234567'),
(17, 'Lmn', '123456'),
(18, 'Raj', '876543'),
(20, 'Test', '23456'),
(22, 'Vidya', '8765');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customBlock`
--
ALTER TABLE `customBlock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userauth`
--
ALTER TABLE `userauth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customBlock`
--
ALTER TABLE `customBlock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userauth`
--
ALTER TABLE `userauth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
