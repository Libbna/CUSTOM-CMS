-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2022 at 06:45 PM
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
  `category` mediumtext NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `user_id`, `category`, `image`) VALUES
(16, '22 Best Air Fryer Recipes', 'These air fryer recipes are just what you need if you want to expand your air fryer horizons.Did you just get a new air fryer? Maybe you want to be a little healthier? Are you looking for new things to make other than frozen french fries? we love our air fryer and these recipes represent the best things we’ve made with it.One thing: look into getting a rack for your air fryer because you can triple your air fryer abilities. If you’re buying a rack, whether online or offline, don’t forget to check the diameter so you can be sure it fits in your air fryer!', 2, 'Food', 'assets/images/food.jpeg'),
(21, 'Some minutes of light. Light.', 'We are in the middle of December now, and for many weeks we haven’t even seen a glimpse of the sun. It’s been hidden under a thick layer of clouds. And december is a very dark time of the year even if its a clear sky, since we only can see the sun for about an hour above the treetops before it goes back down.&nbsp;But in some way I really love this time. I love the extremes. The very dark December, and the very light June. The midnight sun and the polar night.&nbsp;It’s so special and magical in some way.&nbsp;But today, we FINALLY saw the light from the sun again. It was still behind clouds but it was so beautiful to just see the light and the beautiful colors on the sky. That really made my day! I flew up with my drone so that I could take a photo of it.&nbsp;It’s only in the contrasts where we really can appreciate life. We need the darkness to see the light. We need the cold to feel the warmth. We need to put ourself in discomfort to appreciate the comfort.&nbsp;And every year this time I get the same deep feelings of gratitude for the light and the sun. It’s ok to live in darkness for a long time each year just to get this feeling when standing in the window and suddenly feel a little ray of sunlight hitting your face. It’s like being flushed with a wave of love. Hey', 9, 'Lifee', 'assets/images/Screenshot from 2022-01-02 17-53-43.png'),
(25, 'The Delhi Leh Flight at Sunrise', 'I recently visited Ladakh for the 5th time. The first time, way back in 2005 my husband and I did a road trip using public transport. After that I have always taken a flight. Since my first flight in 2016 I knew the magnificent views of the Ladakh Range was on the A side window seats while going and on the F side while coming back.\r\n\r\nMagic over the Ladakh Rage, Delhi Leh Flight\r\nThis time when I was booking my flights I saw one with 5.30 am departure from Delhi. I thought I would get to see the sunrise over the mountains, so I took my chance and booked it. And magic happened! I do not regret leaving home at 3.00 am nor do I regret paying 200 rupees to block A 29 seat in advance, so that I could sleep in peace knowing my seat was assured.\r\nThe Day Break over the Ladakh Range, Delhi Leh Flight', 9, 'Travel', 'assets/images/sunrise-over-ladakh-range.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `logo` longtext NOT NULL,
  `siteName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `logo`, `siteName`) VALUES
(1, 'assets/images/logo/logo.png', ''),
(3, 'assets/images/logo/resized_r.png', 'Reverie');

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
(12, 'Contact', 'contact'),
(13, 'About', 'aboutus');

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
(1, 'admin', 'admin', 'authenticated'),
(2, 'Tony Stark', '$2y$10$bNzv4mgxJUsxvPmSrMhHseozyvWLpsZOJO5PDjpcnBeMlcMKXNZeu', 'authenticated'),
(8, 'Ted', '$2y$10$3p/.U3SbtvGafdXV7vDxFuhEN9vxXrh1N12AWofHLPu.x5OtxpEgC', 'authenticated'),
(9, 'Raj', '$2y$10$f5s6qIKrJ26FsXm9xBUI9uQRtDK7u0x5LI7NZEEv2yl4.qGjdU1t2', 'admin'),
(10, 'John', '$2y$10$hVSvnPG9VFp8VFzaEt2Ykujm4Kz03NLT5uRkjnSLBlsW/9NHJkDhy', 'admin'),
(14, 'Demo', '$2y$10$wtKO3IOifVoYSTlt1Yk62uY/gE9Wb1QLRwSQ5Hq2ITp/D9/MovuSC', 'authenticated'),
(15, 'xyz', '$2y$10$bCK5nSqVvYzXRtOUdZE4XuGwETnvy0qnTTXKcRfuy/hqLl9.2Q9by', 'authenticated'),
(16, 'Steve Rogers', '$2y$10$gMOJbgc/yIz2j8CjxrNQJOMz2Y/JvZ7ohdSQUYMDqQWfM00TxFr5K', 'authenticated');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `title`, `description`) VALUES
(1, 'home', 'link to homepage'),
(2, 'contact', 'link to contact details page'),
(3, 'block', 'Link to block details page');

-- --------------------------------------------------------

--
-- Table structure for table `userauth`
--

CREATE TABLE `userauth` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('admin','authenticated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userauth`
--

INSERT INTO `userauth` (`username`, `password`, `roles`) VALUES
('Vivek', '$2y$10$NS1WRopghpnkEzVUX2Rr9OJxntxJV.4Quig7wEJ9SxlBT5Gs7VVae', 'authenticated');

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
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customBlock`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customBlock`
--
ALTER TABLE `customBlock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `userauth`
--
ALTER TABLE `userauth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
