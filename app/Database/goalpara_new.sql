-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 02:23 PM
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
  `harga_reg` int(10) NOT NULL DEFAULT 0,
  `harga_reg2` int(10) NOT NULL DEFAULT 0,
  `harga_reg3` int(10) NOT NULL DEFAULT 0,
  `harga_fix` int(10) NOT NULL DEFAULT 0,
  `harga_fix2` int(10) NOT NULL DEFAULT 0,
  `harga_fix3` int(10) NOT NULL DEFAULT 0,
  `stat` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wahana`
--

INSERT INTO `wahana` (`id`, `name`, `code`, `harga_reg`, `harga_reg2`, `harga_reg3`, `harga_fix`, `harga_fix2`, `harga_fix3`, `stat`) VALUES
(1, 'Checkout', 'CO', 0, 0, 0, 0, 0, 0, 0),
(2, 'Checkout', 'CO', 0, 0, 0, 0, 0, 0, 0),
(3, 'Checkin', 'CI', 0, 0, 0, 0, 0, 0, 0),
(4, 'ATV Motor', 'ATV', 75000, 150000, 225000, 0, 0, 0, 1),
(5, 'Mini Outbound', 'MN', 30000, 60000, 90000, 0, 0, 0, 1),
(6, 'TamanLL', 'TL', 35000, 70000, 105000, 0, 0, 0, 1),
(7, 'Flying Fox', 'FF', 25000, 40000, 60000, 0, 0, 0, 1),
(8, 'Rainbow Slide', 'RS', 40000, 70000, 100000, 0, 0, 0, 1),
(9, 'Mini Zoo', 'MZ', 50000, 60000, 90000, 0, 0, 0, 1),
(10, 'Kereta Labirin', 'KRL', 15000, 20000, 90000, 0, 0, 0, 1),
(11, 'Mini Golf', 'MG', 50000, 100000, 150000, 0, 0, 0, 1),
(12, 'Check In', 'CI', 30000, 90000, 12000, 50000, 0, 0, 1),
(15, 'CheckIn', 'CI', 50000, 0, 0, 75000, 0, 0, 0),
(16, 'CheckIn', 'CI', 50000, 0, 0, 75000, 0, 0, 0),
(17, 'Row Boat', 'RB', 30000, 60000, 90000, 0, 0, 0, 1),
(18, 'UTV', 'UTV', 100000, 250000, 350000, 250000, 350000, 450000, 1),
(19, 'Sepeda Listrik', 'SL', 30000, 30000, 30000, 30000, 30000, 30000, 1);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
