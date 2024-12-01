-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 07:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupon_histories`
--

CREATE TABLE `coupon_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_histories`
--

INSERT INTO `coupon_histories` (`id`, `provider_id`, `user_id`, `coupon_code`, `coupon_id`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'newyear23', 2, '20', '2023-03-09 06:01:18', NULL),
(2, 0, 1, 'blackfriday', 3, '20', '2023-03-09 06:01:18', NULL),
(3, 2, 1, 'newyear23', 2, '6.3', '2023-03-09 09:06:50', '2023-03-09 09:06:50'),
(4, 2, 1, 'newyear23', 2, '5.1', '2023-03-09 09:13:28', '2023-03-09 09:13:28'),
(5, 0, 1, 'blackfriday', 3, '8.5', '2023-03-09 09:19:31', '2023-03-09 09:19:31'),
(6, 0, 1, 'startsunday', 4, '7.4', '2023-03-09 09:24:22', '2023-03-09 09:24:22'),
(7, 2, 1, 'newyear23', 2, '1.5', '2023-03-09 09:27:37', '2023-03-09 09:27:37'),
(8, 2, 1, 'newyear23', 2, '5.1', '2023-03-09 09:31:14', '2023-03-09 09:31:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
