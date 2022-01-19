-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2022 at 07:27 PM
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
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `user_id`, `category`, `image`) VALUES
(16, '22 Best Air Fryer Recipes', 'These air fryer recipes are just what you need if you want to expand your air fryer horizons.Did you just get a new air fryer? Maybe you want to be a little healthier? Are you looking for new things to make other than frozen french fries? we love our air fryer and these recipes represent the best things we’ve made with it.One thing: look into getting a rack for your air fryer because you can triple your air fryer abilities. If you’re buying a rack, whether online or offline, don’t forget to check the diameter so you can be sure it fits in your air fryer!', 2, 'Food', 'assets/images/skillet-fried-chicken.jpg'),
(21, 'Some minutes of light.', 'We are in the middle of December now, and for many weeks we haven’t even seen a glimpse of the sun. It’s been hidden under a thick layer of clouds. And december is a very dark time of the year even if its a clear sky, since we only can see the sun for about an hour above the treetops before it goes back down.&nbsp;But in some way I really love this time. I love the extremes. The very dark December, and the very light June. The midnight sun and the polar night.&nbsp;It’s so special and magical in some way.&nbsp;But today, we FINALLY saw the light from the sun again. It was still behind clouds but it was so beautiful to just see the light and the beautiful colors on the sky. That really made my day! I flew up with my drone so that I could take a photo of it.&nbsp;It’s only in the contrasts where we really can appreciate life. We need the darkness to see the light. We need the cold to feel the warmth. We need to put ourself in discomfort to appreciate the comfort.&nbsp;And every year this time I get the same deep feelings of gratitude for the light and the sun. It’s ok to live in darkness for a long time each year just to get this feeling when standing in the window and suddenly feel a little ray of sunlight hitting your face. It’s like being flushed with a wave of love.', 9, 'Life', 'assets/images/MDLBEAST-Soundstorm.jpg'),
(25, '24 Hour Challenge', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 23, 'Fashion', 'assets/images/glo4.jpg'),
(37, 'Hello', '<p><s>This is an <strong>example of <em>test in ckeditor</em></strong></s></p>\r\n', 5, 'aaaa', 'assets/images/smile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `logo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `siteName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `logo`, `alt_text`, `siteName`) VALUES
(1, 'assets/images/logo/resized_Vitality.png', 'Logo of a CSGO team, Team Vitality', 'Team Vitality');

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
(5, 'Site Logo', '<p>fghjk</p>\r\n');

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
(25, 'About', 'about'),
(53, 'Contact Us', 'contact');

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
(65, 'vivek', '$2y$10$UNijCv3MrU.hD8/xdbkUqO6AhsTR1/TYmbR2yagfyTNIf2WP.kZ7m', 'admin'),
(66, 'vbad', '$2y$10$ov8MXWnd/mesZR0kz74AceKUCX1ahFKXIfbsWQ96/OPz8QlB.IV5y', 'authenticated'),
(67, 'max', '$2y$10$5bDzLEMsiD7znM97Tg1StuTj8FpuIRBAbMEQ/jmk/UVxEgL3se7kS', 'authenticated'),
(68, 'tom', '$2y$10$73nXJx899Z6c8ZKfuLFCkObq2expDXwxF0w4ol4KyCz.0pElfuC7S', 'authenticated'),
(69, 'han', '$2y$10$O3O/2SsDcSppAObU2PvmHOLhCO0IKFiiRLc2mya.BDQlPBR5WQ1X2', 'authenticated');

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
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customBlock`
--
ALTER TABLE `customBlock`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customBlock`
--
ALTER TABLE `customBlock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `userauth`
--
ALTER TABLE `userauth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;