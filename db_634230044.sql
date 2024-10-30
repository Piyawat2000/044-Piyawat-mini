-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 09:40 AM
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
-- Database: `db_634230044`
--

-- --------------------------------------------------------

--
-- Table structure for table `request_shoe`
--

CREATE TABLE `request_shoe` (
  `id` int(11) NOT NULL,
  `shoe_name` varchar(100) NOT NULL,
  `addBy` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_shoe`
--

INSERT INTO `request_shoe` (`id`, `shoe_name`, `addBy`, `user_id`, `reg_date`) VALUES
(5, 'Jodan', 'admin admin', 17, '2024-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_shoesproduct`
--

CREATE TABLE `tb_shoesproduct` (
  `shoe_id` int(9) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `addBy` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_shoesproduct`
--

INSERT INTO `tb_shoesproduct` (`shoe_id`, `name`, `price`, `addBy`, `reg_date`, `user_id`) VALUES
(10, 'Jodan', 4000, 'admin admin', '2024-10-22 03:38:45', 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `role`, `reg_date`) VALUES
(15, 'besa6404@gmail.com', 'ssssxx', 'maoezxooo@gmail.com', '$2y$10$nxUhSuCOvVOldpSmOYr8Q.vC4wAyRMeUODbBeWpkiJvwH6FCEetBG', 0, '2024-09-18'),
(17, 'admin', 'admin', 'admin@gmail.com', '$2y$10$GEajwL4Wlx7ik5B6WMtEQ.e.jDvvK8fZnrAQuQ99O97VoQ2dCQ2gq', 1, '2024-10-22'),
(18, '123', '12', 'test@gmail.com', '$2y$10$fL.0iCNhAI0Bgt6i6c6nl.lUSn9bu/5B4MGAOiDxwvxAmFaZ.3GWa', 0, '2024-10-22'),
(19, '1', '1222', 'test@g1mail.com', '$2y$10$tEgQWjUjWA42IU1YJZMdWOqsfMkmxaX9oKACh.xdcHTsynBaiQiqe', 0, '2024-10-22'),
(20, 'nice', 'TG-Gamer', 'maoezxooo444@gmail.com', '$2y$10$Und7KcamAL3bE0pShRiZvuxtcfA3aEdrE/mILs6uAasy9LuSoHL5i', 0, '2024-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `fname`, `lname`, `email`, `address`, `avatar`, `role`, `user_id`, `reg_date`) VALUES
(10, 'besa6404@gmail.com', 'ssssxx', 'maoezxooo@gmail.com', 'asdasdasd', '15.jpg', 0, 15, '2024-09-18'),
(12, 'admin', 'admin', 'admin@gmail.com', 'Not Set', '17.jpg', 1, 17, '2024-10-22'),
(13, '123', '12', 'test@gmail.com', NULL, NULL, 0, 18, '2024-10-22'),
(14, '1', '1222', 'test@g1mail.com', 'Not Set', '19.png', 0, 19, '2024-10-22'),
(15, 'nice', 'TG-Gamer', 'maoezxooo444@gmail.com', NULL, NULL, 0, 20, '2024-10-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_shoe`
--
ALTER TABLE `request_shoe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_shoesproduct`
--
ALTER TABLE `tb_shoesproduct`
  ADD PRIMARY KEY (`shoe_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_shoe`
--
ALTER TABLE `request_shoe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_shoesproduct`
--
ALTER TABLE `tb_shoesproduct`
  MODIFY `shoe_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
