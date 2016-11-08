-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2016 at 12:22 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global_death`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `user_admin` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ip` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `user_admin`, `password`, `email`, `ip`, `date`, `logs`) VALUES
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@live.es', '127.0.0.1', '2016', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id_conversations` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `message` varchar(3000) COLLATE utf8_spanish2_ci NOT NULL,
  `ip_users` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `date_message` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id_conversations`, `user_name`, `message`, `ip_users`, `date_message`) VALUES
(5, '0', 'hi', '127.0.0.1', '16/08/17  10:56:43'),
(7, 'dead_*88', 'buenas :3', '127.0.0.1', '16/08/17  11:59:00'),
(9, 'clear', 'hello\r\n', '127.0.0.1', '2016/10/18  07:24:33'),
(10, 'faro', 'hi', '127.0.0.1', '2016/10/18  07:42:30'),
(11, 'faro', 'Que onda', '127.0.0.1', '2016/10/18  07:43:27'),
(12, 'clear', 'qui onda', '127.0.0.1', '2016/10/19  04:20:12'),
(13, 'clear', 'a', '127.0.0.1', '2016/10/19  04:27:13'),
(14, 'clear', 'aaa', '127.0.0.1', '2016/10/19  04:30:37'),
(15, 'clear', 'ss', '127.0.0.1', '2016/10/19  04:30:40'),
(17, 'clear', 'los hakooo', '127.0.0.1', '2016/10/19  05:17:22'),
(18, 'clear', 'hamooo :V', '127.0.0.1', '2016/10/19  05:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `entrada_users` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `user` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `entrada_users`, `user`, `ip`) VALUES
(1, '', '', ''),
(3, '2016/10/18 07:25:25', 'Array', ''),
(4, '2016/10/18 07:26:20', 'clear', ''),
(5, '2016/10/18 07:28:22', 'clear', '127.0.0.1'),
(6, '2016/10/18 07:40:43', 'clear', '127.0.0.1'),
(7, '2016/10/18 07:42:23', 'faro', '127.0.0.1'),
(8, '2016/10/18 07:43:15', 'faro', '127.0.0.1'),
(9, '2016/10/18 08:34:15', 'clear', '127.0.0.1'),
(10, '2016/10/19 04:08:07', 'clear', '127.0.0.1'),
(11, '2016/10/19 04:09:49', 'clear', '127.0.0.1'),
(12, '2016/10/19 04:33:12', 'faro', '127.0.0.1'),
(13, '2016/10/19 04:35:02', 'admin', '127.0.0.1'),
(14, '2016/10/19 05:15:35', 'admin', '127.0.0.1'),
(15, '2016/10/19 05:17:07', 'clear', '127.0.0.1'),
(16, '2016/10/19 05:19:04', 'admin', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_blog` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `article` varchar(10000) COLLATE utf8_spanish2_ci NOT NULL,
  `img` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `autor` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ip` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_blog`, `title`, `article`, `img`, `date`, `autor`, `ip`) VALUES
(19, 'sdfsdfd', 'sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss sddssssssssssssssss ', 'maquinas.php', '2016/10/19 04:01:52', 'sdfsdfsdf', '127.0.0.1'),
(21, 'Hacking', '8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h 8yhyhy8h8h .l.l.ll', '4.jpg', '2016-10-19 05:16:38', 'dead_*88', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `users` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ip_user` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `date_registry` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `users`, `password`, `email`, `ip_user`, `date_registry`) VALUES
(1, 'clear', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', ''),
(3, 'faro', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'arjenismejia@gmail.comm', '127.0.0.1', '2016/10/18  05:03:53'),
(4, 'faros', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'arjeni', '127.0.0.1', '2016/10/18  05:27:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id_conversations`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id_conversations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
