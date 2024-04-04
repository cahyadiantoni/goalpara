-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 04:46 AM
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
  `tiket` varchar(250) NOT NULL,
  `wahana_id` int(250) NOT NULL,
  `amount` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `tiket`, `wahana_id`, `amount`) VALUES
(46, '123', 1, 2),
(47, '123', 3, 2),
(48, '123', 5, 1),
(49, '123', 4, 3),
(50, '123', 6, 1),
(51, '123', 18, 1000),
(52, '123', 9, 2),
(53, '123', 12, 2),
(54, '123', 15, 2),
(55, '123', 17, 2),
(56, '234', 1, 1),
(57, '234', 3, 1),
(58, '567', 1, 1),
(59, '567', 3, 1),
(60, '890', 1, 1),
(61, '890', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gate`
--

CREATE TABLE `gate` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gate`
--

INSERT INTO `gate` (`id`, `name`, `code`, `status`) VALUES
(1, 'Check In', 'CI', 1),
(2, 'Check Out', 'CO', 1),
(3, 'Row Boat', 'RB', 1),
(4, 'Taman Lalu Lintas', 'TLL', 1),
(5, 'Rumah Kucing', 'RK', 1),
(6, 'Sepeda Listrik', 'SL', 1),
(7, 'Kereta Labirin', 'KL', 1),
(8, 'Mini Golf', 'MG', 1),
(9, 'Flying Fox', 'FF', 1),
(10, 'Mini Outbond', 'MO', 1),
(11, 'ATV', 'ATV', 1),
(12, 'UTV', 'UTV', 1),
(13, 'Rainbow Slide', 'RS', 1),
(14, 'Mini Zoo', 'MZ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id` int(50) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_wahana`
--

CREATE TABLE `riwayat_wahana` (
  `id` int(50) NOT NULL,
  `gate_id` int(50) NOT NULL,
  `wahana_id` int(50) NOT NULL,
  `tiket` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
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
(1, 'Admin'),
(2, 'Office'),
(3, 'Staff'),
(4, 'Wahana'),
(5, 'Booth');

-- --------------------------------------------------------

--
-- Table structure for table `selected_transaction`
--

CREATE TABLE `selected_transaction` (
  `id` bigint(250) NOT NULL,
  `transaction_id` int(50) NOT NULL,
  `tiket` varchar(250) NOT NULL,
  `wahana_id` int(250) NOT NULL,
  `amount` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selected_transaction`
--

INSERT INTO `selected_transaction` (`id`, `transaction_id`, `tiket`, `wahana_id`, `amount`) VALUES
(98, 48, '123', 1, 1),
(99, 48, '123', 3, 1),
(100, 48, '123', 5, 1),
(101, 48, '123', 4, 3),
(102, 48, '123', 6, 1),
(103, 48, '123', 18, 1000),
(104, 48, '123', 9, 2),
(105, 48, '123', 12, 2),
(106, 48, '123', 15, 2),
(107, 48, '123', 17, 2),
(108, 49, '123', 1, 1),
(109, 49, '123', 3, 1),
(110, 50, '234', 1, 1),
(111, 50, '234', 3, 1),
(112, 51, '567', 1, 1),
(113, 51, '567', 3, 1),
(114, 52, '890', 1, 1),
(115, 52, '890', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(250) NOT NULL,
  `tiket` varchar(250) NOT NULL,
  `total` int(250) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `ref_number` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `tiket`, `total`, `payment_type`, `ref_number`, `phone`, `created_at`, `updated_at`) VALUES
(48, '123', 470000, 'Tunai', '123', '123', '2024-03-26 15:13:32', '2024-03-26 15:13:32'),
(49, '123', 40000, 'Tunai', '1234', '1234', '2024-03-27 13:37:09', '2024-03-27 13:37:09'),
(50, '234', 40000, 'Tunai', '234567890', '234567890', '2024-03-27 13:59:22', '2024-03-27 13:59:22'),
(51, '567', 40000, 'Tunai', '234567890', '234567890', '2024-03-27 13:59:22', '2024-03-27 13:59:22'),
(52, '890', 40000, 'Tunai', '234567890', '234567890', '2024-03-27 13:59:22', '2024-03-27 13:59:22');

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
(1, 'Administrator', 'admin', '$2y$10$Fc1gDg0ZDsPPavaSQp6RjO6p177tGukBTTxrqZnH.YId5.ecfcqtS', 1),
(2, 'Office', 'office', '$2y$10$Fc1gDg0ZDsPPavaSQp6RjO6p177tGukBTTxrqZnH.YId5.ecfcqtS', 2),
(3, 'Staff', 'staff', '$2y$10$Fc1gDg0ZDsPPavaSQp6RjO6p177tGukBTTxrqZnH.YId5.ecfcqtS', 3),
(4, 'Wahana', 'wahana', '$2y$10$Fc1gDg0ZDsPPavaSQp6RjO6p177tGukBTTxrqZnH.YId5.ecfcqtS', 4),
(5, 'Booth', 'booth', '$2y$10$Fc1gDg0ZDsPPavaSQp6RjO6p177tGukBTTxrqZnH.YId5.ecfcqtS', 5);

-- --------------------------------------------------------

--
-- Table structure for table `wahana`
--

CREATE TABLE `wahana` (
  `id` int(3) NOT NULL,
  `gate_id` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `code` varchar(4) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kapasitas` int(50) NOT NULL,
  `harga` int(10) NOT NULL DEFAULT 0,
  `type` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wahana`
--

INSERT INTO `wahana` (`id`, `gate_id`, `name`, `code`, `kategori`, `kapasitas`, `harga`, `type`, `status`) VALUES
(1, 1, 'Check In', 'CIR', 'Reguler', 1, 40000, 1, 1),
(2, 1, 'Check In', 'CIA', 'Anak', 1, 20000, 1, 1),
(3, 2, 'Check Out', 'CO', 'Reguler', 1, 0, 1, 1),
(4, 3, 'Rowboat', 'RBR', 'Reguler', 3, 30000, 2, 1),
(5, 4, 'Taman Lalu Lintas', 'TLLR', 'Reguler', 1, 35000, 2, 1),
(6, 5, 'Rumah Kucing', 'RKR', 'Reguler', 1, 35000, 2, 1),
(7, 6, 'Sepeda Listrik', 'SLR', 'Reguler', 1, 35000, 2, 1),
(8, 7, 'Kereta Labirin', 'KLR', 'Reguler', 1, 15000, 2, 1),
(9, 7, 'Kereta Labirin', 'KLS', 'Silver', 2, 20000, 2, 1),
(10, 8, 'Mini Golf', 'MGR', 'Reguler', 1, 50000, 2, 1),
(11, 9, 'Flying Fox', 'FFR', 'Reguler', 1, 25000, 2, 1),
(12, 9, 'Flying Fox', 'FFS', 'Silver', 2, 40000, 2, 1),
(13, 10, 'Mini Outbond', 'MOR', 'Reguler', 1, 30000, 2, 1),
(14, 11, 'ATV', 'ATVR', 'Reguler', 1, 75000, 2, 1),
(15, 12, 'UTV', 'UTVR', 'Reguler', 2, 100000, 2, 1),
(16, 13, 'Rainbow Slide', 'RSR', 'Reguler', 1, 40000, 2, 1),
(17, 13, 'Rainbow Slide', 'RSS', 'Silver', 2, 70000, 2, 1),
(18, 13, 'Rainbow Slide', 'RSG', 'Gold', 1000, 100000, 2, 1),
(19, 14, 'Mini Zoo', 'MZR', 'Reguler', 1, 40000, 3, 1),
(20, 14, 'Mini Zoo', 'MZA', 'Anak', 1, 20000, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gate`
--
ALTER TABLE `gate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_wahana`
--
ALTER TABLE `riwayat_wahana`
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
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `gate`
--
ALTER TABLE `gate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_wahana`
--
ALTER TABLE `riwayat_wahana`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selected_transaction`
--
ALTER TABLE `selected_transaction`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wahana`
--
ALTER TABLE `wahana`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
