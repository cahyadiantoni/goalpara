-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 06:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goalpara_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` bigint(250) NOT NULL,
  `tiket` int(250) NOT NULL,
  `wahana_id` int(250) NOT NULL,
  `amount` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `selected_transaction`
--

CREATE TABLE `selected_transaction` (
  `id` bigint(250) NOT NULL,
  `transaction_id` int(50) NOT NULL,
  `tiket` int(50) NOT NULL,
  `wahana_id` int(250) NOT NULL,
  `amount` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(250) NOT NULL,
  `tiket` int(50) NOT NULL,
  `total` int(250) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `ref_number` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role_id` int(10) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role_id`) VALUES
(1, 'Administrator', 'admin', '$2y$10$Fc1gDg0ZDsPPavaSQp6RjO6p177tGukBTTxrqZnH.YId5.ecfcqtS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wahana`
--

CREATE TABLE `wahana` (
  `id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `code` varchar(4) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kapasitas` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL DEFAULT 0,
  `type` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wahana`
--

INSERT INTO `wahana` (`id`, `name`, `code`, `kategori`, `kapasitas`, `harga`, `type`, `status`) VALUES
(1, 'HTM', 'HTMR', 'Reguler', '1', 40000, 1, 1),
(2, 'HTM', 'HTMA', 'Anak', '1', 20000, 1, 1),
(3, 'Rowboat', 'RBR', 'Reguler', '3', 30000, 2, 1),
(4, 'Taman Lalu Lintas', 'TLLR', 'Reguler', '1', 35000, 2, 1),
(5, 'Rumah Kucing', 'RKR', 'Reguler', '1', 35000, 2, 1),
(6, 'Sepeda Listrik', 'SLR', 'Reguler', '1', 35000, 2, 1),
(7, 'Kereta Labirin', 'KLR', 'Reguler', '1', 15000, 2, 1),
(8, 'Kereta Labirin', 'KLS', 'Silver', '2', 20000, 2, 1),
(9, 'Mini Golf', 'MGR', 'Reguler', '1', 50000, 2, 1),
(10, 'Flying Fox', 'FFR', 'Reguler', '1', 25000, 2, 1),
(11, 'Flying Fox', 'FFS', 'Silver', '2', 40000, 2, 1),
(12, 'Mini Outbond', 'MOR', 'Reguler', '1', 30000, 2, 1),
(13, 'ATV', 'ATVR', 'Reguler', '1', 75000, 2, 1),
(14, 'UTV', 'UTVR', 'Reguler', '2', 100000, 2, 1),
(15, 'Rainbow Slide', 'RSR', 'Reguler', '1', 40000, 2, 1),
(16, 'Rainbow Slide', 'RSS', 'Silver', '2', 70000, 2, 1),
(17, 'Rainbow Slide', 'RSG', 'Gold', 'Unlimited', 100000, 2, 1),
(18, 'Mini Zoo', 'MZR', 'Reguler', '1', 40000, 3, 1),
(19, 'Mini Zoo', 'MZA', 'Anak', '1', 20000, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selected_transaction`
--
ALTER TABLE `selected_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wahana`
--
ALTER TABLE `wahana`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `selected_transaction`
--
ALTER TABLE `selected_transaction`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wahana`
--
ALTER TABLE `wahana`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
