-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2024 at 04:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milson_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `quantity` int NOT NULL,
  `sub_total` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` int DEFAULT NULL,
  `disc` int DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `menu_id`, `disc`, `start_date`, `end_date`, `created_at`) VALUES
(13, 17, 25, '2024-01-18', '2024-01-21', '2024-01-20 05:10:45'),
(14, 3, 30, '2024-01-13', '2024-01-21', '2024-01-20 09:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int NOT NULL,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `title`, `price`, `image`, `kategori`) VALUES
(2, 'Cappucino Coffee', '18.500', '1696901709-wenhao-ryan-tPHZoqLkVw8-unsplash.jpg', 'minuman'),
(3, 'Nasi Goreng Spesial', '31.000', '1696901661-annie-spratt-oT7_v-I0hHg-unsplash.jpg', 'makanan'),
(13, 'Ramen Chicken Curry', '26.000', '1696902386-chicken-curry.jpg', 'makanan'),
(17, 'Kentang Goreng', '16.000', '1704390517-louis-hansel-vi0kZuoe0-8-unsplash.jpg', 'makanan');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_number` int NOT NULL,
  `grand_total` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Sedang diproses','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `table_number`, `grand_total`, `order_time`, `status`) VALUES
('OD-26KHRD', 'Ardika Ramadana', 82, '33.700', '2024-01-21 11:14:02', 'Sedang diproses'),
('OD-2PPSK6', 'Aulia Salsabila', 12, '33.700', '2024-01-21 11:18:21', 'Sedang diproses'),
('OD-3C6NF2', 'Anjay', 24, '50.000', '2024-01-04 15:34:07', 'Sedang diproses'),
('OD-3WARA1', 'Roshit', 20, '80.500', '2024-01-19 18:06:01', 'Selesai'),
('OD-4VQD5A', 'Keyshara', 16, '58.100', '2024-01-15 01:07:26', 'Selesai'),
('OD-9QL89S', 'Fix Diskon', 5, '47.000', '2024-01-14 12:11:41', 'Selesai'),
('OD-DCUWW2', 'Caroline Sheila', 15, '18.500', '2024-01-21 11:20:19', 'Sedang diproses'),
('OD-K14Z3F', 'Apa', 40, '56.500', '2024-01-20 17:25:10', 'Selesai'),
('OD-LKWUNB', 'Intan', 69, '49.500', '2024-01-04 17:45:19', 'Sedang diproses'),
('OD-LMM6UU', 'Halo', 5, '37.000', '2024-01-20 17:24:50', 'Selesai'),
('OD-LQJOVF', 'Tes Diskon', 200, '93.000', '2024-01-13 20:38:22', 'Sedang diproses'),
('OD-M93S2I', 'John Doe', 50, '38.000', '2024-01-20 17:25:40', 'Selesai'),
('OD-N1N0PP', 'ya', 3, '44.500', '2024-01-20 17:25:24', 'Selesai'),
('OD-OBMM50', 'Cuy', 28, '12.000', '2024-01-21 10:32:13', 'Sedang diproses'),
('OD-QRICV7', 'Cuy', 28, '12.000', '2024-01-21 10:32:13', 'Sedang diproses'),
('OD-RBOGIJ', 'Siapa Ya', 29, '59.700', '2024-01-20 17:06:53', 'Selesai'),
('OD-RSJQO9', 'miqdad', 2, '26.000', '2023-10-15 13:38:48', 'Selesai'),
('OD-WKCVJ6', 'miqdad', 3, '44.000', '2024-01-16 01:28:20', 'Selesai'),
('OD-WRJ97L', 'Arawrsaurus', 14, '33.700', '2024-01-21 11:16:52', 'Sedang diproses'),
('OD-Y39A1X', '1', 20, '26.000', '2024-01-20 17:24:38', 'Selesai'),
('OD-Z2QZFN', 'Faesal', 6, '26.000', '2024-01-16 00:53:02', 'Selesai'),
('OD-ZCJTTV', 'Roshit', 13, '76.000', '2023-10-14 11:16:50', 'Selesai'),
('OD-ZTQ1QE', 'Tes SweetAlert', 9, '57.000', '2023-10-13 19:25:52', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `item_id` int NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `sub_total` decimal(10,3) DEFAULT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`item_id`, `order_id`, `menu_id`, `quantity`, `sub_total`, `order_time`) VALUES
(55, 'OD-ZTQ1QE', 3, 1, '31.000', '2023-10-15 14:31:50'),
(56, 'OD-ZTQ1QE', 13, 1, '26.000', '2023-10-15 14:31:50'),
(60, 'OD-ZCJTTV', 3, 1, '31.000', '2023-10-15 14:31:50'),
(61, 'OD-ZCJTTV', 13, 1, '26.000', '2023-10-15 14:31:50'),
(67, 'OD-RSJQO9', 13, 1, '26.000', '2023-10-15 14:31:50'),
(70, 'OD-3C6NF2', 2, 2, '37.000', '2024-01-04 15:34:07'),
(74, 'OD-LKWUNB', 2, 1, '18.500', '2024-01-04 17:45:19'),
(75, 'OD-LKWUNB', 3, 1, '31.000', '2024-01-04 17:45:19'),
(77, 'OD-LQJOVF', 3, 3, '46.500', '2024-01-13 20:38:22'),
(81, 'OD-9QL89S', 2, 1, '18.500', '2024-01-14 12:11:41'),
(82, 'OD-9QL89S', 3, 1, '15.500', '2024-01-14 12:11:41'),
(83, 'OD-9QL89S', 13, 1, '13.000', '2024-01-14 12:11:41'),
(84, 'OD-4VQD5A', 17, 1, '13.600', '2024-01-15 01:07:26'),
(85, 'OD-4VQD5A', 13, 2, '26.000', '2024-01-15 01:07:26'),
(86, 'OD-4VQD5A', 2, 1, '18.500', '2024-01-15 01:07:26'),
(87, 'OD-Z2QZFN', 13, 2, '26.000', '2024-01-16 00:53:02'),
(88, 'OD-WKCVJ6', 3, 1, '31.000', '2024-01-16 01:28:20'),
(89, 'OD-WKCVJ6', 13, 1, '13.000', '2024-01-16 01:28:20'),
(90, 'OD-3WARA1', 3, 2, '62.000', '2024-01-19 18:06:01'),
(91, 'OD-3WARA1', 2, 1, '18.500', '2024-01-19 18:06:01'),
(92, 'OD-RBOGIJ', 3, 1, '21.700', '2024-01-20 17:06:53'),
(93, 'OD-RBOGIJ', 17, 1, '12.000', '2024-01-20 17:06:53'),
(94, 'OD-RBOGIJ', 13, 1, '26.000', '2024-01-20 17:06:53'),
(95, 'OD-Y39A1X', 13, 1, '26.000', '2024-01-20 17:24:38'),
(96, 'OD-LMM6UU', 2, 2, '37.000', '2024-01-20 17:24:50'),
(97, 'OD-K14Z3F', 13, 1, '26.000', '2024-01-20 17:25:10'),
(98, 'OD-K14Z3F', 17, 1, '12.000', '2024-01-20 17:25:10'),
(99, 'OD-K14Z3F', 2, 1, '18.500', '2024-01-20 17:25:10'),
(100, 'OD-N1N0PP', 2, 1, '18.500', '2024-01-20 17:25:24'),
(101, 'OD-N1N0PP', 13, 1, '26.000', '2024-01-20 17:25:24'),
(102, 'OD-M93S2I', 13, 1, '26.000', '2024-01-20 17:25:40'),
(103, 'OD-M93S2I', 17, 1, '12.000', '2024-01-20 17:25:40'),
(104, 'OD-OBMM50', 17, 1, '12.000', '2024-01-21 10:32:13'),
(105, 'OD-QRICV7', 17, 1, '12.000', '2024-01-21 10:32:13'),
(106, 'OD-26KHRD', 3, 1, '21.700', '2024-01-21 11:14:02'),
(107, 'OD-26KHRD', 17, 1, '12.000', '2024-01-21 11:14:02'),
(108, 'OD-WRJ97L', 17, 1, '12.000', '2024-01-21 11:16:52'),
(109, 'OD-WRJ97L', 3, 1, '21.700', '2024-01-21 11:16:52'),
(110, 'OD-2PPSK6', 3, 1, '21.700', '2024-01-21 11:18:21'),
(111, 'OD-2PPSK6', 17, 1, '12.000', '2024-01-21 11:18:21'),
(112, 'OD-DCUWW2', 2, 1, '18.500', '2024-01-21 11:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `date`, `type`, `amount`, `description`) VALUES
(1, '2024-01-21 10:05:56', 'Bayar tagihan', '900.000', 'Bayar tagihan listrik PLN'),
(3, '2024-01-20 14:26:07', 'Beli bahan baku', '56.000', 'Beli susu diamond 2 liter'),
(4, '2024-01-19 10:26:22', 'Bayar jasa', '200.000', 'Jasa perbaiki AC');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `review` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `rating`, `review`, `created_at`) VALUES
(1, 5, 'Nice, keep it up', '2024-01-20 12:28:23'),
(2, 4, 'Ok, keep the good work', '2024-01-20 14:28:23'),
(3, 2, 'Very bad services!', '2024-01-21 12:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int NOT NULL,
  `cashier_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_sal` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `cashier_name`, `monthly_sal`, `present`, `salary`, `created_at`) VALUES
(1, 'Roshit Cashier Edit', '2000000', '27', '1800000', '2024-01-01 15:53:31'),
(3, 'Maruyasa', '5000000', '25', '4166667', '2024-01-14 12:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,3) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cashier_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `order_id`, `payment_method`, `total_amount`, `transaction_date`, `cashier_name`) VALUES
('TRN-7P32YB1', 'OD-RBOGIJ', 'kredit/debit', '59.700', '2024-01-20 17:08:01', 'Roshit Admin'),
('TRN-M7Q5LVO', 'OD-N1N0PP', 'QRIS', '44.500', '2024-01-20 17:26:32', 'Roshit Admin'),
('TRN-NIQ5YLB', 'OD-LMM6UU', 'cash', '37.000', '2024-01-20 17:26:11', 'Roshit Admin'),
('TRN-QUICYP9', 'OD-K14Z3F', 'transfer bank', '56.500', '2024-01-20 17:26:19', 'Roshit Admin'),
('TRN-V7Z6J1S', 'OD-M93S2I', 'transfer bank', '38.000', '2024-01-20 17:26:44', 'Roshit Admin'),
('TRN-Y3VEZUA', 'OD-Y39A1X', 'cash', '26.000', '2024-01-19 17:26:02', 'Roshit Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `role`) VALUES
(15, 'Roshit Admin', 'roshit', '$2y$10$XkeTxiIs2jbBXOrbGKJIxeOB3oAK6g3Bzg.pYt3vc.TtA7BbR1CFi', 'auliarasyidalzahrawi@gmail.com', 'admin'),
(17, 'Roshit Cashier Edit', 'cashier', '$2y$10$6fUYVQrAI4Nh1BalgA1lWOT6xNW3DsHxV505pRmgYukvJijD8ez5i', 'auliarasyidalzahrawi@gmail.com', 'cashier'),
(20, 'Administrator', 'admin', '$2y$10$vcI4nyBq2TNbbpZBbpLRzuHUYj/N2CpgctGuhkwafVQs/16iPDfSa', 'admin@gmail.com', 'admin'),
(21, 'Maruyasa', 'maru', '$2y$10$64LoiybVVaUhCZAbewcQ5.J/EuLRpDiNdYnsZ4SFQOjjEBT6HKQG.', 'maru@gmail.com', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `orders_item_ibfk_1` (`order_id`),
  ADD KEY `orders_item_ibfk_2` (`menu_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`);

--
-- Constraints for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD CONSTRAINT `orders_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_item_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
