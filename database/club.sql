-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(30) NOT NULL,
  `content` varchar(400) NOT NULL,
  `wherewas` varchar(1000) NOT NULL,
  `roaring` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `content`, `wherewas`, `roaring`) VALUES
(1, 'The Rotary Club\'s commitment to service above self is embodied in its motto, \"Service Above Self,\" reflecting its dedication to improving lives and building a better world.', 'Avarampatti, Chettikulam, Rajapalayam', 'Since 1980\r\n10 December');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(100) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `photo`) VALUES
(1, 'uploads/g1.jpg'),
(2, 'uploads/g2.jpg'),
(3, 'uploads/g3.jpg'),
(4, 'uploads/g4.jpg'),
(5, 'uploads/g5.jpg'),
(6, 'uploads/g6.jpg'),
(7, 'uploads/g7.jpg'),
(8, 'uploads/g8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `homebg`
--

CREATE TABLE `homebg` (
  `id` int(30) NOT NULL,
  `homeimage` varchar(100) NOT NULL,
  `hometext` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homebg`
--

INSERT INTO `homebg` (`id`, `homeimage`, `hometext`) VALUES
(1, 'uploads/compressed_bg.jpg', 'THE\r\nROTARY CLUB\r\nFH76+VC4, RJPM Avarampatti, Chettikulam, Tamil Nadu');

-- --------------------------------------------------------

--
-- Table structure for table `leaders`
--

CREATE TABLE `leaders` (
  `id` int(30) NOT NULL,
  `leadername` varchar(100) NOT NULL,
  `photo` varchar(1000) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `leadername`, `photo`, `role`) VALUES
(9, 'Andrew', 'uploads/1.jpg', 'Chair Person'),
(10, 'Shelby', 'uploads/2.jpg', 'President'),
(11, 'Tennyson', 'uploads/3.jpg', 'Vice- President'),
(12, 'Queen Tellien', 'uploads/4.jpg', 'Dean Head'),
(13, 'Alison Parker', 'uploads/5.jpg', 'Chief Secretary'),
(14, 'John', 'uploads/6.jpg', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(30) NOT NULL,
  `ourlogo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `ourlogo`) VALUES
(1, 'uploads/compressed_newlogo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sponsers`
--

CREATE TABLE `sponsers` (
  `id` int(100) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsers`
--

INSERT INTO `sponsers` (`id`, `photo`) VALUES
(1, 'uploads/s1.png'),
(2, 'uploads/s2.png'),
(3, 'uploads/s3.png'),
(4, 'uploads/s4.png'),
(5, 'uploads/s5.png'),
(6, 'uploads/s6.png'),
(7, 'uploads/s7.png'),
(8, 'uploads/s8.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `message` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `message`) VALUES
(1, 'pk', 'viperprabhakaran@gmail.com', 'hai');

-- --------------------------------------------------------

--
-- Table structure for table `weimages`
--

CREATE TABLE `weimages` (
  `id` int(100) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weimages`
--

INSERT INTO `weimages` (`id`, `photo`) VALUES
(10, 'uploads/v1.jpg'),
(11, 'uploads/v2.jpg'),
(12, 'uploads/v3.jpg'),
(13, 'uploads/v4.jpg'),
(14, 'uploads/v5.jpg'),
(15, 'uploads/v6.jpg'),
(16, 'uploads/v7.jpg'),
(17, 'uploads/v8.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homebg`
--
ALTER TABLE `homebg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaders`
--
ALTER TABLE `leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsers`
--
ALTER TABLE `sponsers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weimages`
--
ALTER TABLE `weimages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `homebg`
--
ALTER TABLE `homebg`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leaders`
--
ALTER TABLE `leaders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sponsers`
--
ALTER TABLE `sponsers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weimages`
--
ALTER TABLE `weimages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
