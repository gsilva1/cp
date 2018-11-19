-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2018 at 03:12 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instit12_wp462`
--

-- --------------------------------------------------------

--
-- Table structure for table `cp_posts`
--

CREATE TABLE `cp_posts` (
  `id` int(11) NOT NULL,
  `titulo` varchar(120) DEFAULT NULL,
  `descricao` varchar(2000) DEFAULT NULL,
  `inserido_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cp_posts`
--

INSERT INTO `cp_posts` (`id`, `titulo`, `descricao`, `inserido_em`) VALUES
(1, 'ww', 'www', '2018-11-15 13:12:38'),
(2, 'titulo2', 'descricao2', '2018-11-15 13:12:58'),
(3, 't3', 'd3', '2018-11-15 13:13:12'),
(4, NULL, NULL, '2018-11-15 13:14:12'),
(5, NULL, NULL, '2018-11-15 13:14:14'),
(6, NULL, NULL, '2018-11-15 13:14:15'),
(7, 'titulo', 'descricao', '2018-11-15 13:16:55'),
(8, 'titulo', 'kkkkkk', '2018-11-15 14:30:35'),
(9, 't3', 'a9', '2018-11-15 14:30:51'),
(10, 't3', 'a9', '2018-11-15 14:32:30'),
(11, 't3', 'kakakaka', '2018-11-15 14:33:40'),
(12, 'tt', 'audi', '2018-11-15 14:34:13'),
(13, 'tt', '1111111111111111111', '2018-11-15 14:35:24'),
(14, 'tt', '1111111111111111111', '2018-11-15 14:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `cp_users`
--

CREATE TABLE `cp_users` (
  `id` int(11) NOT NULL,
  `login` varchar(10) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cp_users`
--

INSERT INTO `cp_users` (`id`, `login`, `password`) VALUES
(1, 'like', '$2y$10$wktOBIasVe0iV6MCfrTMV.GgOCbv1xUifp9ygoItD3c3iZkGDVtO6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_posts`
--
ALTER TABLE `cp_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_users`
--
ALTER TABLE `cp_users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cp_posts`
--
ALTER TABLE `cp_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cp_users`
--
ALTER TABLE `cp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
