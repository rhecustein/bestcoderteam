-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2024 at 06:47 AM
-- Server version: 10.6.18-MariaDB-cll-lve-log
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `risukubn_aabceser_check`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(255) NOT NULL,
  `header_description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `about_us_title` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `foreground_image` varchar(255) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `small_image_one` varchar(255) DEFAULT NULL,
  `small_image_two` varchar(255) DEFAULT NULL,
  `small_image_three` varchar(255) DEFAULT NULL,
  `total_rating` varchar(255) DEFAULT NULL,
  `why_choose_us_title` varchar(255) DEFAULT NULL,
  `why_choose_desciption` text DEFAULT NULL,
  `why_choose_background` varchar(255) DEFAULT NULL,
  `why_choose_foreground` varchar(255) DEFAULT NULL,
  `title_one` varchar(255) DEFAULT NULL,
  `title_two` varchar(255) DEFAULT NULL,
  `title_three` varchar(255) DEFAULT NULL,
  `description_one` text DEFAULT NULL,
  `description_two` text DEFAULT NULL,
  `description_three` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `header`, `header_description`, `status`, `about_us_title`, `about_us`, `foreground_image`, `background_image`, `small_image_one`, `small_image_two`, `small_image_three`, `total_rating`, `why_choose_us_title`, `why_choose_desciption`, `why_choose_background`, `why_choose_foreground`, `title_one`, `title_two`, `title_three`, `description_one`, `description_two`, `description_three`, `created_at`, `updated_at`) VALUES
(1, 'How It Works', 'There are many variations of passages of Lorem Ipsum available but the majority', NULL, 'Know About Us', '<p style=\"font-size: 16px; font-family: Roboto, sans-serif;\">What sets Websolutionus apart, we believe in our commitment to providing actual value to our consumers. In the business, our dedication and quality are unrivaled. We\'re more than a technology service provider. We care as much about our customer&rsquo;s achievements as we do about our own, therefore we share business risks with them so they may take chances with technological innovations. We provide the following services.</p>\r\n<ul>\r\n<li>Laravel Website Development</li>\r\n<li>Mobile Application Development</li>\r\n<li>WordPress Theme Development</li>\r\n<li>Search Engine Optimization (SEO)</li>\r\n</ul>', 'uploads/website-images/about-us-foreground-2022-08-28-01-05-24-9243.jpg', 'uploads/website-images/about-us-bg-2022-08-28-01-05-24-2606.jpg', 'uploads/website-images/about-us-client-one-2022-08-28-01-13-54-7019.png', 'uploads/website-images/about-us-client-one-2022-08-28-01-14-58-9497.png', 'uploads/website-images/about-us-client-one-2022-08-28-01-14-58-4843.png', '25k+', 'There Some Reasons to Hire The Proeasy', '<p>We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc. We believe on just in time. We provide all web solutions accordingly and ensure the best service. We rely on new creation and the best management policy. We usually monitor the market and policies.</p>', 'uploads/website-images/about-us-bg-2022-08-28-01-40-24-9733.jpg', 'uploads/website-images/about-us-foreground-2022-08-28-01-40-33-7719.jpg', 'Top-Rated Company', 'Superior Quality', 'Friendly Provide Services', 'We offer low-cost services and cutting-edge technologies to help you improve your application and bring more value to your consumers', 'We assist enterprises to decrease the risk of security events across the SDLC and launch internet solutions with protection.', 'We assist our customers to determine the right way for them and provide business eLearning solutions.', '2022-01-30 12:30:23', '2023-01-18 08:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

CREATE TABLE `additional_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_services`
--

INSERT INTO `additional_services` (`id`, `service_id`, `service_name`, `image`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 'Home Move', 'uploads/custom-images/service-add-2022-10-03-03-12-56-9482.jpg', 1, 10, '2022-10-03 09:12:56', '2022-10-03 09:12:56'),
(2, 2, 'Pc Repair', 'uploads/custom-images/service-add-2022-10-03-03-12-56-9074.jpg', 1, 5, '2022-10-03 09:12:56', '2022-10-03 09:12:56'),
(3, 3, 'Service One', 'uploads/custom-images/service-add-2022-10-03-03-17-30-6778.jpg', 1, 10, '2022-10-03 09:17:30', '2022-10-03 09:17:30'),
(4, 3, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-03-17-30-2641.jpg', 1, 8, '2022-10-03 09:17:30', '2022-10-03 09:17:30'),
(5, 3, 'Service Three', 'uploads/custom-images/service-add-2022-10-03-03-17-30-1451.jpg', 1, 15, '2022-10-03 09:17:30', '2022-10-03 09:17:30'),
(6, 3, 'Service Four', 'uploads/custom-images/service-add-2022-10-03-03-17-30-5205.jpg', 1, 4, '2022-10-03 09:17:30', '2022-10-03 09:17:30'),
(7, 5, 'Extra Service One', 'uploads/custom-images/service-add-2022-10-03-03-28-39-1242.jpg', 1, 3, '2022-10-03 09:28:39', '2022-10-03 09:28:39'),
(8, 5, 'Extra Service Two', 'uploads/custom-images/service-add-2022-10-03-03-28-39-5634.jpg', 1, 5, '2022-10-03 09:28:39', '2022-10-03 09:28:39'),
(9, 5, 'Extra Service Three', 'uploads/custom-images/service-add-2022-10-03-03-28-39-3764.jpg', 1, 4, '2022-10-03 09:28:39', '2022-10-03 09:28:39'),
(10, 6, 'Extra service one', 'uploads/custom-images/service-add-2022-10-03-03-34-32-5974.png', 1, 7, '2022-10-03 09:34:33', '2022-10-03 09:34:33'),
(11, 6, 'Extra service two', 'uploads/custom-images/service-add-2022-10-03-03-34-33-8795.png', 1, 5, '2022-10-03 09:34:33', '2022-10-03 09:34:33'),
(12, 6, 'Extra service three', 'uploads/custom-images/service-add-2022-10-03-03-34-33-2395.png', 1, 6, '2022-10-03 09:34:33', '2022-10-03 09:34:33'),
(13, 7, 'Service One', 'uploads/custom-images/service-add-2022-10-03-03-43-20-1580.png', 1, 12, '2022-10-03 09:43:20', '2022-10-03 09:43:20'),
(14, 7, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-03-43-20-3644.png', 1, 20, '2022-10-03 09:43:20', '2022-10-03 09:43:20'),
(15, 7, 'Service Three', 'uploads/custom-images/service-add-2022-10-03-03-43-20-4494.png', 1, 13, '2022-10-03 09:43:20', '2022-10-03 09:43:20'),
(16, 9, 'Service One', 'uploads/custom-images/service-add-2022-10-03-03-54-30-9396.png', 1, 20, '2022-10-03 09:54:31', '2022-10-03 09:54:31'),
(17, 9, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-03-54-31-4918.png', 1, 13, '2022-10-03 09:54:31', '2022-10-03 09:54:31'),
(18, 9, 'Service Three', 'uploads/custom-images/service-add-2022-10-03-03-54-31-7614.png', 1, 8, '2022-10-03 09:54:31', '2022-10-03 09:54:31'),
(19, 10, 'Service One', 'uploads/custom-images/service-add-2022-10-03-04-03-43-1630.png', 1, 5, '2022-10-03 10:03:43', '2022-10-03 10:03:43'),
(20, 10, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-04-03-43-9623.png', 1, 6, '2022-10-03 10:03:44', '2022-10-03 10:03:44'),
(21, 11, 'Service One', 'uploads/custom-images/service-add-2022-10-03-04-08-32-9378.png', 1, 10, '2022-10-03 10:08:32', '2022-10-03 10:08:32'),
(22, 11, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-04-08-32-1195.png', 1, 12, '2022-10-03 10:08:33', '2022-10-03 10:08:33'),
(23, 12, 'Service one', 'uploads/custom-images/service-add-2022-10-03-04-11-58-9305.png', 1, 12, '2022-10-03 10:11:58', '2022-10-03 10:11:58'),
(24, 12, 'Service two', 'uploads/custom-images/service-add-2022-10-03-04-11-58-3485.png', 1, 16, '2022-10-03 10:11:58', '2022-10-03 10:11:58'),
(25, 12, 'Service three', 'uploads/custom-images/service-add-2022-10-03-04-11-58-2352.png', 1, 8, '2022-10-03 10:11:58', '2022-10-03 10:11:58'),
(26, 13, 'Service One', 'uploads/custom-images/service-add-2023-05-24-11-34-43-8746.png', 1, 12, '2022-10-03 10:17:45', '2023-05-24 15:34:43'),
(27, 13, 'Service Two', 'uploads/custom-images/service-add-2023-05-24-11-34-43-9833.png', 1, 9, '2022-10-03 10:17:46', '2023-05-24 15:34:43'),
(28, 13, 'Service Three', 'uploads/custom-images/service-add-2023-05-24-11-34-43-7445.png', 1, 3, '2022-10-03 10:17:46', '2023-05-24 15:34:43'),
(29, 21, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-35-47-1935.jpeg', 1, 5, '2023-01-14 04:35:47', '2023-01-14 04:35:47'),
(30, 21, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-35-47-2424.jpeg', 1, 7, '2023-01-14 04:35:48', '2023-01-14 04:35:48'),
(31, 20, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-38-21-7962.jpeg', 1, 10, '2023-01-14 04:38:21', '2023-01-14 04:38:21'),
(32, 20, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-38-22-1651.jpeg', 1, 8, '2023-01-14 04:38:22', '2023-01-14 04:38:22'),
(33, 20, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-38-22-2896.jpeg', 1, 14, '2023-01-14 04:38:23', '2023-01-14 04:38:23'),
(34, 19, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-40-07-6132.jpeg', 1, 12, '2023-01-14 04:40:07', '2023-01-14 04:40:07'),
(35, 19, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-40-07-6399.jpeg', 1, 14, '2023-01-14 04:40:08', '2023-01-14 04:40:08'),
(36, 19, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-40-08-8105.jpeg', 1, 5, '2023-01-14 04:40:08', '2023-01-14 04:40:08'),
(37, 18, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-41-22-2543.jpeg', 1, 3, '2023-01-14 04:41:22', '2023-01-14 04:41:22'),
(38, 18, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-41-22-8164.jpeg', 1, 2, '2023-01-14 04:41:23', '2023-01-14 04:41:23'),
(39, 18, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-41-23-2513.jpeg', 1, 5, '2023-01-14 04:41:23', '2023-01-14 04:41:23'),
(40, 17, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-42-45-2192.jpeg', 1, 10, '2023-01-14 04:42:45', '2023-01-14 04:42:45'),
(41, 17, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-42-45-7669.jpeg', 1, 5, '2023-01-14 04:42:46', '2023-01-14 04:42:46'),
(42, 17, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-42-46-4320.jpeg', 1, 6, '2023-01-14 04:42:46', '2023-01-14 04:42:46'),
(43, 16, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-43-40-3193.jpeg', 1, 2, '2023-01-14 04:43:41', '2023-01-14 04:43:41'),
(44, 16, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-43-41-8190.jpeg', 1, 3, '2023-01-14 04:43:41', '2023-01-14 04:43:41'),
(45, 16, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-43-41-7647.jpeg', 1, 8, '2023-01-14 04:43:42', '2023-01-14 04:43:42'),
(46, 15, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-44-31-5768.jpeg', 1, 10, '2023-01-14 04:44:31', '2023-01-14 04:44:31'),
(47, 15, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-44-31-2276.jpeg', 1, 5, '2023-01-14 04:44:31', '2023-01-14 04:44:31'),
(48, 15, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-44-31-3957.jpeg', 1, 6, '2023-01-14 04:44:32', '2023-01-14 04:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_type` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `forget_password_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_type`, `name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `status`, `forget_password_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Doe', 'admin@gmail.com', 'uploads/website-images/john-doe-2022-12-25-04-13-32-5577.jpg', NULL, '$2y$10$E9vUQogef2us1sas54MD6e3Z5yBoTSerndPBBtC7438PIy2M3dhoO', NULL, 1, NULL, NULL, '2023-01-14 10:44:02'),
(13, 0, 'David Richard', 'admin1@gmail.com', 'uploads/website-images/david-richard-2022-12-25-04-27-24-8827.jpg', NULL, '$2y$10$ugyPYFYfSSvoBDMlMA4AM.xzLRmtdFlzg6H74Z6ZzZCIfOM4dNQuu', NULL, 1, NULL, '2022-12-25 10:23:18', '2023-07-15 02:26:00'),
(14, 0, 'Daniel Paul', 'admin2@gmail.com', NULL, NULL, '$2y$10$YLbQclElSRHXqvlTCgG95uy.lQeaqSESueQNO9YqSXfdbNBGozHJi', NULL, 1, NULL, '2022-12-25 10:23:29', '2022-12-25 10:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_schedules`
--

CREATE TABLE `appointment_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_schedules`
--

INSERT INTO `appointment_schedules` (`id`, `user_id`, `day`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sunday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(2, 2, 'Sunday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(3, 2, 'Sunday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(5, 2, 'Sunday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(6, 2, 'Sunday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(7, 2, 'Sunday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(8, 2, 'Sunday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(9, 2, 'Sunday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(10, 2, 'Sunday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(11, 2, 'Sunday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(12, 2, 'Sunday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(13, 2, 'Sunday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(14, 2, 'Sunday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(15, 2, 'Sunday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(16, 2, 'Sunday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(17, 2, 'Sunday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(18, 2, 'Sunday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(19, 2, 'Monday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(20, 2, 'Monday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(21, 2, 'Monday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(22, 2, 'Monday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(23, 2, 'Monday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(24, 2, 'Monday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(25, 2, 'Monday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(26, 2, 'Monday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(27, 2, 'Monday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(28, 2, 'Monday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(29, 2, 'Monday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(30, 2, 'Monday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(31, 2, 'Monday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(32, 2, 'Monday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(33, 2, 'Monday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(34, 2, 'Monday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(35, 2, 'Monday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(36, 2, 'Tuesday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(37, 2, 'Tuesday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(38, 2, 'Tuesday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(39, 2, 'Tuesday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(40, 2, 'Tuesday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(41, 2, 'Tuesday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(42, 2, 'Tuesday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(43, 2, 'Tuesday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(44, 2, 'Tuesday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(45, 2, 'Tuesday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(46, 2, 'Tuesday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(47, 2, 'Tuesday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(48, 2, 'Tuesday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(49, 2, 'Tuesday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(50, 2, 'Tuesday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(51, 2, 'Tuesday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(52, 2, 'Tuesday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(53, 2, 'Wednesday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(54, 2, 'Wednesday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(55, 2, 'Wednesday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(56, 2, 'Wednesday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(57, 2, 'Wednesday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(58, 2, 'Wednesday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(59, 2, 'Wednesday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(60, 2, 'Wednesday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(61, 2, 'Wednesday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(62, 2, 'Wednesday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(63, 2, 'Wednesday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(64, 2, 'Wednesday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(65, 2, 'Wednesday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(66, 2, 'Wednesday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(67, 2, 'Wednesday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(68, 2, 'Wednesday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(69, 2, 'Wednesday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(70, 2, 'Thursday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(71, 2, 'Thursday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(72, 2, 'Thursday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(73, 2, 'Thursday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(74, 2, 'Thursday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(75, 2, 'Thursday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(76, 2, 'Thursday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(77, 2, 'Thursday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(78, 2, 'Thursday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(79, 2, 'Thursday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(80, 2, 'Thursday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(81, 2, 'Thursday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(82, 2, 'Thursday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(83, 2, 'Thursday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(84, 2, 'Thursday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(85, 2, 'Thursday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(86, 2, 'Thursday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(87, 4, 'Sunday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(88, 4, 'Sunday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(89, 4, 'Sunday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(90, 4, 'Sunday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(91, 4, 'Sunday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(92, 4, 'Sunday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(93, 4, 'Sunday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(94, 4, 'Sunday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(95, 4, 'Sunday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(96, 4, 'Sunday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(97, 4, 'Sunday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(98, 4, 'Sunday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(99, 4, 'Sunday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(100, 4, 'Sunday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(101, 4, 'Sunday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(102, 4, 'Sunday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(103, 4, 'Sunday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(104, 4, 'Monday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(105, 4, 'Monday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(106, 4, 'Monday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(107, 4, 'Monday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(108, 4, 'Monday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(109, 4, 'Monday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(110, 4, 'Monday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(111, 4, 'Monday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(112, 4, 'Monday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(113, 4, 'Monday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(114, 4, 'Monday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(115, 4, 'Monday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(116, 4, 'Monday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(117, 4, 'Monday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(118, 4, 'Monday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(119, 4, 'Monday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(120, 4, 'Monday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(121, 4, 'Tuesday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(122, 4, 'Tuesday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(123, 4, 'Tuesday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(124, 4, 'Tuesday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(125, 4, 'Tuesday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(126, 4, 'Tuesday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(127, 4, 'Tuesday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(128, 4, 'Tuesday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(129, 4, 'Tuesday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(130, 4, 'Tuesday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(131, 4, 'Tuesday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(132, 4, 'Tuesday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(133, 4, 'Tuesday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(134, 4, 'Tuesday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(135, 4, 'Tuesday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(136, 4, 'Tuesday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(137, 4, 'Tuesday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(138, 4, 'Wednesday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(139, 4, 'Wednesday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(140, 4, 'Wednesday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(141, 4, 'Wednesday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(142, 4, 'Wednesday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(143, 4, 'Wednesday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(144, 4, 'Wednesday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(145, 4, 'Wednesday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(146, 4, 'Wednesday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(147, 4, 'Wednesday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(148, 4, 'Wednesday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(149, 4, 'Wednesday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(150, 4, 'Wednesday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(151, 4, 'Wednesday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(152, 4, 'Wednesday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(153, 4, 'Wednesday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(154, 4, 'Wednesday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(155, 4, 'Thursday', '08:00', '08:20', 1, '2023-01-09 04:57:25', '2023-01-09 04:57:25'),
(156, 4, 'Thursday', '08:20', '08:40', 1, '2023-01-09 04:57:42', '2023-01-09 04:57:42'),
(157, 4, 'Thursday', '08:40', '09:00', 1, '2023-01-09 05:15:41', '2023-01-09 05:15:41'),
(158, 4, 'Thursday', '09:00', '09:20', 1, '2023-01-09 05:49:13', '2023-01-09 05:49:13'),
(159, 4, 'Thursday', '09:20', '09:40', 1, '2023-01-09 05:49:24', '2023-01-09 05:49:24'),
(160, 4, 'Thursday', '09:40', '10:00', 1, '2023-01-09 05:49:40', '2023-01-09 05:49:40'),
(161, 4, 'Thursday', '10:00', '10:20', 1, '2023-01-09 05:55:16', '2023-01-09 05:55:16'),
(162, 4, 'Thursday', '10:20', '10:40', 1, '2023-01-09 05:55:56', '2023-01-09 05:55:56'),
(163, 4, 'Thursday', '10:40', '11:00', 1, '2023-01-09 05:57:47', '2023-01-09 05:57:47'),
(164, 4, 'Thursday', '11:00', '11:20', 1, '2023-01-09 05:57:54', '2023-01-09 05:57:54'),
(165, 4, 'Thursday', '11:20', '11:40', 1, '2023-01-09 05:58:09', '2023-01-09 05:58:09'),
(166, 4, 'Thursday', '11:40', '12:00', 1, '2023-01-09 05:58:19', '2023-01-09 05:58:19'),
(167, 4, 'Thursday', '12:00', '12:20', 1, '2023-01-09 05:59:35', '2023-01-09 05:59:35'),
(168, 4, 'Thursday', '12:20', '12:40', 1, '2023-01-09 06:00:06', '2023-01-09 06:00:06'),
(169, 4, 'Thursday', '12:40', '13:00', 1, '2023-01-09 06:00:54', '2023-01-09 06:01:18'),
(170, 4, 'Thursday', '13:00', '13:30', 1, '2023-01-09 06:01:42', '2023-01-09 06:01:42'),
(171, 4, 'Thursday', '13:30', '14:00', 1, '2023-01-09 06:01:54', '2023-01-09 06:01:54'),
(172, 26, 'Friday', '4:30 PM', '5:30 PM', 1, '2023-05-21 20:33:48', '2023-05-21 20:34:57'),
(173, 26, 'Saturday', '1:35 PM', '1:50 PM', 1, '2023-05-21 20:35:49', '2023-05-21 20:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `bank_payments`
--

CREATE TABLE `bank_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_info` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `handcash_image` varchar(255) DEFAULT 'handcash_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_payments`
--

INSERT INTO `bank_payments` (`id`, `status`, `account_info`, `image`, `created_at`, `updated_at`, `handcash_image`) VALUES
(1, 1, 'Bank Name: Your bank name\r\nAccount Number:  Your bank account number\r\nRouting Number: Your bank routing number\r\nBranch: Your bank branch name', 'uploads/website-images/bank-2022-09-25-10-06-03-8346.jpg', NULL, '2023-06-21 16:11:45', 'uploads/website-images/handcash_image-2023-06-21-10-11-45-2799.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

CREATE TABLE `banner_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `banner_location` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `header` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `title`, `description`, `link`, `image`, `button_text`, `banner_location`, `status`, `header`, `created_at`, `updated_at`) VALUES
(1, 'Up To - 35% Off', 'Hot Deals', 'product', 'uploads/website-images/Mega-menu-2022-02-13-07-53-14-1062.png', 'Shop Now', 'Mega Menu Banner', 1, NULL, NULL, '2022-02-13 13:53:14'),
(2, 'Up To -20% Off', 'Hot Deals', 'product', 'uploads/website-images/banner--2022-02-10-10-24-47-2663.jpg', 'Shop Now', 'Home Page One Column Banner', 1, NULL, NULL, '2022-02-13 13:45:52'),
(3, 'Up To -35% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-03-42-16-1335.png', 'Shop Now', 'Home Page First Two Column Banner One', 1, NULL, NULL, '2022-02-13 13:46:01'),
(4, 'Up To -40% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-03-42-16-1434.png', 'Shop Now', 'Home Page First Two Column Banner Two', 1, NULL, NULL, '2022-02-13 13:46:01'),
(5, 'Up To -28% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-04-18-01-2862.jpg', 'Shop Now', 'Home Page Second Two Column Banner one', 1, NULL, NULL, '2022-02-13 13:46:15'),
(6, 'Up To -22% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-04-18-01-6995.jpg', 'Shop Now', 'Home Page Second Two Column Banner two', 1, NULL, NULL, '2022-02-13 13:46:15'),
(7, 'Up To -35% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-13-04-57-46-4114.jpg', 'Shop Now', 'Home Page Third Two Column Banner one', 1, NULL, NULL, '2022-02-13 13:46:27'),
(8, 'Up To -15% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-13-04-58-43-7437.jpg', 'Shop Now', 'Home Page Third Two Column Banner Two', 1, NULL, NULL, '2022-02-13 13:46:27'),
(9, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-24-44-6895.jpg', 'dd', 'Shopping cart bottom', 1, '', NULL, '2022-02-13 13:47:23'),
(10, 'This is Title', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-25-59-9719.jpg', NULL, 'Shopping cart bottom', 0, NULL, NULL, '2022-02-13 13:47:23'),
(11, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-26-46-8505.jpg', 'dd', 'Campaign page', 1, '', NULL, '2022-02-13 13:47:31'),
(12, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-01-30-06-21-06-4562.png', 'dd', 'Campaign page', 0, '', NULL, '2022-02-13 13:47:31'),
(13, 'This is Tittle', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Shop Now', 'uploads/website-images/banner-2022-02-07-10-48-37-9226.jpg', 'dd', 'Login page', 0, 'Our Achievement', NULL, '2022-02-07 04:48:39'),
(14, 'Black Friday Sale', 'Up To -70% Off', 'product', 'uploads/website-images/banner-2022-02-06-04-24-02-9777.jpg', NULL, 'Product Detail', 1, NULL, NULL, '2022-02-13 13:46:54'),
(15, 'Default Profile Image', NULL, NULL, 'uploads/website-images/default-avatar-2022-02-07-10-10-46-1477.jpg', NULL, 'Default Profile Image', 0, NULL, NULL, '2022-02-07 04:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `show_homepage` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `admin_id`, `title`, `slug`, `blog_category_id`, `image`, `description`, `views`, `seo_title`, `seo_description`, `status`, `show_homepage`, `created_at`, `updated_at`) VALUES
(1, 1, 'Logistics of container smart cargo ship and cargo plane', 'logistics-of-container-cargo-ship-and-cargo-plane', 1, 'uploads/custom-images/blog--2022-09-29-11-23-39-3061.jpg', '<p>Lorem ipsum dolor sit amet, nibh saperet te pri, at nam diceret disputationi. Quo an consul impedit, usu possim evertitur dissentiet ei, ridens minimum nominavi et vix. An per mutat adipisci. Ut pericula dissentias sed, est ea modus gloriatur. Aliquip persius has cu, oportere adversarium mei an, justo fabulas in vix.</p><p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p><p>Te soleat legendos molestiae cum. Tale sanctus invidunt cu per, quo at modo recteque elaboraret. Ex mazim homero per. Eu nec exerci doctus, cu mei oblique copiosae. Consul diceret usu ne.</p><p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p><p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.<br></p>', 0, 'Logistics of container cargo ship and cargo plane', 'Logistics of container cargo ship and cargo plane', 1, 1, '2022-09-29 05:23:40', '2022-11-06 08:51:04'),
(2, 1, 'Service maintenance repair engine and washing in transport', 'service-maintenance-repair-engine-and-washing-in-transport', 4, 'uploads/custom-images/blog--2022-09-29-11-27-10-7404.jpg', '<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p><p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p><p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p><p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.<br></p><p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p><p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.<br></p>', 0, 'Service maintenance repair engine in transport', 'Service maintenance repair engine in transport', 1, 1, '2022-09-29 05:27:10', '2022-11-06 08:50:30'),
(3, 1, 'Rubber glove cleaning table disinfectant alcohol spray', 'rubber-glove-cleaning-table-disinfectant-alcohol-spray', 3, 'uploads/custom-images/blog--2022-09-29-11-31-38-4858.jpg', '<p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.</p><p>Nec in rebum primis causae. Affert iisque ex pri, vis utinam vivendo definitionem ad, nostrum omnesque per et. Omnium antiopam cotidieque cu sit. Id pri placerat voluptatum, vero dicunt dissentiunt eum et, adhuc iisque vis no. Eu suavitate contentiones definitionem mel, ex vide insolens ocurreret eam. Et dico blandit mea. Sea tollit vidisse mandamus te, qui movet efficiendi ex.</p><p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p><p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p><p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.<br></p>', 0, 'Rubber glove cleaning table disinfectant alcohol spray', 'Rubber glove cleaning table disinfectant alcohol spray', 1, 1, '2022-09-29 05:31:39', '2022-09-29 05:31:39'),
(4, 1, 'Man cutting beard at a shop barber our smart salon', 'man-cutting-beard-at-a-shop-barber-our-smart-salon', 3, 'uploads/custom-images/blog--2022-09-29-11-33-28-5301.jpg', '<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p><p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p><p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p><p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p><p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.<br></p>', 0, 'Man cutting beard at a shop barber salon', 'Man cutting beard at a shop barber salon', 1, 1, '2022-09-29 05:33:28', '2022-11-06 08:49:53'),
(5, 1, 'Spry and disinfection of office and home to prevent', 'spry-and-disinfection-of-office-and-home-to-prevent-', 1, 'uploads/custom-images/blog--2022-09-29-11-35-00-7694.jpg', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p><p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p><p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p><p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p><p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p><p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.<br></p>', 0, 'Spry and disinfection of office to prevent', 'Spry and disinfection of office to prevent', 1, 1, '2022-09-29 05:35:00', '2022-11-06 08:47:24'),
(6, 1, 'Switchboard an a electrical connecting cable.', 'switchboard-an-a-electrical-connecting-cable', 6, 'uploads/custom-images/blog--2022-09-29-11-36-42-4939.jpg', '<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p><p>Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus. Vis natum vivendo sententiae in, ea aperiam apeirian pri, in partem eleifend quo. Pro ex nobis utinam, nam et vidit numquam fastidii, ne per munere adolescens.</p><p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p><p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p><p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque,</p><p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.&nbsp;Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer.</p>', 0, 'Switchboard an a electrical connecting cable.', 'Switchboard an a electrical connecting cable.', 1, 1, '2022-09-29 05:36:42', '2022-09-29 05:37:48'),
(7, 1, 'Home Move Service From One City to Another City', 'home-move-service-from-one-city-to-another-city', 8, 'uploads/custom-images/blog--2022-09-29-11-47-01-1630.jpg', '<p><p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.</p><p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p><p>Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus. Vis natum vivendo sententiae in, ea aperiam apeirian pri, in partem eleifend quo. Pro ex nobis utinam, nam et vidit numquam fastidii, ne per munere adolescens.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p><p>Te soleat legendos molestiae cum. Tale sanctus invidunt cu per, quo at modo recteque elaboraret. Ex mazim homero per. Eu nec exerci doctus, cu mei oblique copiosae. Consul diceret usu ne.<br></p>', 0, 'Home Move Service From One City to Another City', 'Home Move Service From One City to Another City', 1, 0, '2022-09-29 05:47:01', '2022-09-29 05:51:17'),
(8, 1, 'Now Get Massage Service with our lovely team', 'now-get-massage-service-from-mr-joe', 5, 'uploads/custom-images/blog--2022-09-29-11-48-32-6544.jpg', '<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>Te soleat legendos molestiae cum. Tale sanctus invidunt cu per, quo at modo recteque elaboraret. Ex mazim homero per. Eu nec exerci doctus, cu mei oblique copiosae. Consul diceret usu ne.</p>\r\n<p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>', 0, 'Now Get Massage Service From Mr Joe', 'Now Get Massage Service From Mr Joe', 1, 0, '2022-09-29 05:48:32', '2023-01-18 08:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Cleaning', 'home-cleaning', 1, '2022-09-29 05:18:01', '2022-09-29 05:18:01'),
(2, 'Painting & Renovation', 'painting-renovation', 1, '2022-09-29 05:20:11', '2022-09-29 05:20:11'),
(3, 'Cleaning & Pest Control', 'cleaning-pest-control', 1, '2022-09-29 05:20:23', '2022-09-29 05:20:23'),
(4, 'Emergency Services', 'emergency-services', 1, '2022-09-29 05:20:34', '2022-09-29 05:20:34'),
(5, 'Car Care Services', 'car-care-services', 1, '2022-09-29 05:20:44', '2022-09-29 05:20:44'),
(6, 'Electric & Plumbing', 'electric-plumbing', 1, '2022-09-29 05:20:52', '2022-09-29 05:20:52'),
(8, 'Home Move', 'home-move', 1, '2022-09-29 05:21:18', '2022-09-29 05:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(2, 7, 'David Richard', 'user@gmail.com', 'Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur', 1, '2022-09-29 05:53:04', '2022-09-29 05:53:13'),
(3, 7, 'John Doe', 'john@gmail.com', 'Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus. Vis natum vivendo', 1, '2022-09-29 05:53:41', '2022-09-29 05:53:53'),
(4, 8, 'David Richard', 'david@gmail.com', 'Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus vis natum vivendo.', 1, '2022-09-29 05:54:38', '2022-09-29 05:56:19'),
(5, 8, 'David Simmons', 'simmons@gmail.com', 'Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt', 1, '2022-09-29 05:55:08', '2022-09-29 05:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `breadcrumb_images`
--

CREATE TABLE `breadcrumb_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image_type` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breadcrumb_images`
--

INSERT INTO `breadcrumb_images` (`id`, `location`, `image_type`, `image`, `created_at`, `updated_at`) VALUES
(1, 'About Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-22-51-8693.jpg', NULL, '2022-11-06 10:22:51'),
(2, 'Contact Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-23-12-8618.jpg', NULL, '2022-11-06 10:23:12'),
(3, 'Blog Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-23-56-1117.jpg', NULL, '2022-11-06 10:23:56'),
(4, 'FAQ Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-24-30-8075.jpg', NULL, '2022-11-06 10:24:30'),
(5, 'Terms & Conditions Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-24-43-4592.jpg', NULL, '2022-11-06 10:24:43'),
(6, 'Privacy Policy Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-25-00-9412.jpg', NULL, '2022-11-06 10:25:00'),
(7, 'Custom Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-25-22-7776.jpg', NULL, '2022-11-06 10:25:22'),
(8, 'Service, Booking Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-26-02-1017.jpg', NULL, '2022-11-06 10:26:02'),
(9, 'Provider Page', 1, 'uploads/website-images/banner-us-2022-09-15-01-43-35-3681.jpg', NULL, '2022-09-15 07:43:35'),
(10, 'Dashboard', 1, 'uploads/website-images/banner-us-2022-11-06-04-27-04-9821.jpg', NULL, '2022-11-06 10:27:04'),
(11, 'Login, Register', 1, 'uploads/website-images/banner-us-2022-11-06-04-29-26-8727.jpg', NULL, '2022-11-06 10:29:26'),
(12, 'Join as a provider', 1, 'uploads/website-images/banner-us-2022-11-06-04-29-54-1086.jpg', NULL, '2022-11-06 10:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Painting', 'painting', 'uploads/custom-images/category-2022-12-04-05-48-57-1083.png', 'uploads/custom-images/category-2022-09-29-01-25-32-7758.jpg', 1, '2022-09-29 07:25:32', '2022-12-04 11:48:58'),
(2, 'Cleaning', 'cleaning', 'uploads/custom-images/category-2022-12-04-05-49-19-9484.png', 'uploads/custom-images/category-2022-11-06-01-29-18-4240.jpg', 1, '2022-09-29 07:26:46', '2022-12-04 11:49:19'),
(3, 'Pest Control', 'pest-control', 'uploads/custom-images/category-2022-12-04-05-54-52-6882.png', 'uploads/custom-images/category-2022-09-29-01-27-41-4934.jpg', 1, '2022-09-29 07:27:41', '2022-12-04 11:54:52'),
(4, 'AC Repair', 'ac-repair', 'uploads/custom-images/category-2022-12-04-05-49-40-7608.png', 'uploads/custom-images/category-2022-09-29-01-28-59-3308.jpg', 1, '2022-09-29 07:28:59', '2022-12-04 11:49:40'),
(5, 'Car Services', 'car-services', 'uploads/custom-images/category-2022-12-04-05-49-57-3871.png', 'uploads/custom-images/category-2022-09-29-01-29-56-4318.jpg', 1, '2022-09-29 07:29:56', '2022-12-04 11:49:57'),
(6, 'Plumbing', 'plumbing', 'uploads/custom-images/category-2022-12-04-05-59-25-1109.png', 'uploads/custom-images/category-2022-09-29-01-31-49-2090.jpg', 1, '2022-09-29 07:31:49', '2022-12-04 11:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_state_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Florida City', 'florida-city', 1, '2022-01-30 09:29:19', '2022-02-06 04:18:33'),
(2, 1, 'Los Angeles', 'los-angeles', 1, '2022-01-30 09:29:29', '2022-02-06 04:20:30'),
(4, 2, 'Tallahassee', 'tallahassee', 1, '2022-02-06 04:18:49', '2022-02-06 04:18:49'),
(5, 2, 'Weston', 'weston', 1, '2022-02-06 04:19:56', '2022-02-06 04:19:56'),
(6, 1, 'San Jose', 'san-jose', 1, '2022-02-06 04:21:08', '2022-02-06 04:21:08'),
(7, 1, 'San Diego', 'san-diego', 1, '2022-02-06 04:21:26', '2022-02-06 04:21:26'),
(8, 4, 'Gandhinagar', 'gandhinagar', 1, '2022-02-06 04:22:21', '2022-02-06 04:22:21'),
(9, 5, 'Chandigarh', 'chandigarh', 1, '2022-02-06 04:22:44', '2022-02-06 04:22:44'),
(10, 7, 'London', 'london', 1, '2022-02-06 04:23:12', '2022-02-06 04:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `complete_requests`
--

CREATE TABLE `complete_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `resone` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complete_requests`
--

INSERT INTO `complete_requests` (`id`, `provider_id`, `order_id`, `resone`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'this is test resone', '2022-11-10 05:38:11', '2022-11-10 05:38:11'),
(2, 2, 9, 'this is test resone', '2022-11-10 05:44:49', '2022-11-10 05:44:49'),
(3, 2, 10, 'Please complete the booking.', '2022-12-21 03:48:10', '2022-12-21 03:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Feel Free to Get in Touch', '2022-12-21 03:20:18', '2022-12-21 03:20:18'),
(3, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Feel Free to Get in Touch', '2022-12-21 03:24:38', '2022-12-21 03:24:38'),
(4, 'John Doe', 'agent@gmail.com', '123-343-4444', 'Subscribe Verification', 'Fill the form now & Request an Estimate', '2022-12-21 03:25:12', '2022-12-21 03:25:12'),
(6, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Do you have any question ?\r\nFill the form now &amp; Request an Estimate', '2023-01-15 05:24:20', '2023-01-15 05:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_pages`
--

CREATE TABLE `contact_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supporter_image` varchar(255) DEFAULT NULL,
  `support_time` varchar(255) DEFAULT NULL,
  `off_day` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `map` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_pages`
--

INSERT INTO `contact_pages` (`id`, `supporter_image`, `support_time`, `off_day`, `email`, `address`, `phone`, `map`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/supporter--2022-08-28-02-04-43-1575.jpg', '10.00AM to 07.00PM', 'Friday Off', 'websolutionus1@gmail.com\r\nwebsolutionus@gmail.com', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', '+1347-430-9510\r\n+4247-100-9510', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.681138843672!2d-73.89482218459395!3d40.747041279328165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25f01328248b3%3A0x62300784dd275f96!2s7232%20Broadway%20%23%20308%2C%20Flushing%2C%20NY%2011372%2C%20USA!5e0!3m2!1sen!2sbd!4v1652467683397!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2022-01-30 12:31:58', '2022-09-29 06:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_consents`
--

CREATE TABLE `cookie_consents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `border` varchar(255) DEFAULT NULL,
  `corners` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `border_color` varchar(255) DEFAULT NULL,
  `btn_bg_color` varchar(255) DEFAULT NULL,
  `btn_text_color` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `btn_text` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookie_consents`
--

INSERT INTO `cookie_consents` (`id`, `status`, `border`, `corners`, `background_color`, `text_color`, `border_color`, `btn_bg_color`, `btn_text_color`, `message`, `link_text`, `btn_text`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'thin', 'normal', '#184dec', '#fafafa', '#0a58d6', '#fffceb', '#222758', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an unknown printer took.', 'More Info', 'Yes', NULL, NULL, '2022-02-13 08:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `title`, `icon`, `number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Total Orders', 'uploads/custom-images/counter--2022-09-29-12-40-42-5094.png', '2547', 1, '2022-09-29 06:40:42', '2022-09-29 06:40:42'),
(2, 'Active Clients', 'uploads/custom-images/counter--2022-09-29-12-41-15-9354.png', '1532', 1, '2022-09-29 06:41:15', '2022-09-29 06:41:15'),
(3, 'Team Members', 'uploads/custom-images/counter--2022-09-29-12-41-37-4353.png', '2103', 1, '2022-09-29 06:41:37', '2022-09-29 06:41:37'),
(4, 'Years of Experience', 'uploads/custom-images/counter--2022-09-29-12-42-06-6458.png', '25', 1, '2022-09-29 06:42:06', '2022-09-29 06:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'United State', 'united-state', 1, '2022-01-30 09:28:28', '2022-02-06 04:11:42'),
(2, 'India', 'india', 1, '2022-01-30 09:28:39', '2022-08-30 06:18:46'),
(4, 'United Kindom', 'united-kindom', 1, '2022-02-06 04:11:51', '2022-02-06 04:11:51'),
(5, 'Australia', 'australia', 1, '2022-02-06 04:12:36', '2022-02-06 04:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `country_states`
--

CREATE TABLE `country_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_states`
--

INSERT INTO `country_states` (`id`, `country_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'California', 'california', 1, '2022-01-30 09:29:00', '2022-02-06 04:14:28'),
(2, 1, 'Florida', 'florida', 1, '2022-01-30 09:29:07', '2022-02-06 04:14:42'),
(3, 1, 'Alaska', 'alaska', 1, '2022-02-05 07:49:14', '2022-02-06 04:15:09'),
(4, 2, 'Gujarat', 'gujarat', 1, '2022-02-06 04:16:27', '2022-02-06 04:16:27'),
(5, 2, 'Punjab', 'punjab', 1, '2022-02-06 04:16:39', '2022-02-06 04:16:39'),
(6, 2, 'Rajasthan', 'rajasthan', 1, '2022-02-06 04:16:48', '2022-02-06 04:16:48'),
(7, 4, 'England', 'england', 1, '2022-02-06 04:17:35', '2022-02-06 04:17:35'),
(8, 4, 'Scotland', 'scotland', 1, '2022-02-06 04:17:44', '2022-02-06 04:17:44'),
(9, 4, 'Wales', 'wales', 1, '2022-02-06 04:17:53', '2022-02-06 04:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) NOT NULL,
  `offer_percentage` varchar(255) NOT NULL,
  `expired_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `provider_id`, `coupon_code`, `offer_percentage`, `expired_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'newyear23', '15', '2023-03-29', 1, '2023-03-09 05:40:26', '2023-03-09 05:50:28'),
(3, 0, 'blackfriday', '25', '2023-03-31', 1, '2023-03-09 06:24:24', '2023-03-09 06:24:24'),
(4, 0, 'startsunday', '20', '2023-03-28', 1, '2023-03-09 06:24:38', '2023-03-09 06:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_histories`
--

CREATE TABLE `coupon_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `discount_amount` varchar(255) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AFA', 'Afghan Afghani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ALL', 'Albanian Lek', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'DZD', 'Algerian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AOA', 'Angolan Kwanza', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ARS', 'Argentine Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'AMD', 'Armenian Dram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'AWG', 'Aruban Florin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'AUD', 'Australian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'AZN', 'Azerbaijani Manat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'BSD', 'Bahamian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'BHD', 'Bahraini Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'BDT', 'Bangladeshi Taka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'BBD', 'Barbadian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'BYR', 'Belarusian Ruble', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'BEF', 'Belgian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'BZD', 'Belize Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BMD', 'Bermudan Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BTN', 'Bhutanese Ngultrum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BTC', 'Bitcoin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BOB', 'Bolivian Boliviano', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BAM', 'Bosnia-Herzegovina Convertible Mark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BWP', 'Botswanan Pula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BRL', 'Brazilian Real', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'GBP', 'British Pound Sterling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BND', 'Brunei Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BGN', 'Bulgarian Lev', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BIF', 'Burundian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'KHR', 'Cambodian Riel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'CAD', 'Canadian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'CVE', 'Cape Verdean Escudo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'KYD', 'Cayman Islands Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'XOF', 'CFA Franc BCEAO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'XAF', 'CFA Franc BEAC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'XPF', 'CFP Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'CLP', 'Chilean Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'CNY', 'Chinese Yuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'COP', 'Colombian Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'KMF', 'Comorian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CDF', 'Congolese Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'CRC', 'Costa Rican ColÃ³n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'HRK', 'Croatian Kuna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'CUC', 'Cuban Convertible Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CZK', 'Czech Republic Koruna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'DKK', 'Danish Krone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'DJF', 'Djiboutian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'DOP', 'Dominican Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'XCD', 'East Caribbean Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'EGP', 'Egyptian Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'ERN', 'Eritrean Nakfa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'EEK', 'Estonian Kroon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'ETB', 'Ethiopian Birr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'EUR', 'Euro', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'FKP', 'Falkland Islands Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'FJD', 'Fijian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'GMD', 'Gambian Dalasi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'GEL', 'Georgian Lari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'DEM', 'German Mark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'GHS', 'Ghanaian Cedi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'GIP', 'Gibraltar Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'GRD', 'Greek Drachma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'GTQ', 'Guatemalan Quetzal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'GNF', 'Guinean Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'GYD', 'Guyanaese Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'HTG', 'Haitian Gourde', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'HNL', 'Honduran Lempira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'HKD', 'Hong Kong Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'HUF', 'Hungarian Forint', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ISK', 'Icelandic KrÃ³na', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'INR', 'Indian Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'IDR', 'Indonesian Rupiah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'IRR', 'Iranian Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'IQD', 'Iraqi Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'ILS', 'Israeli New Sheqel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'ITL', 'Italian Lira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'JMD', 'Jamaican Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'JPY', 'Japanese Yen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'JOD', 'Jordanian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'KZT', 'Kazakhstani Tenge', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'KES', 'Kenyan Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'KWD', 'Kuwaiti Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'KGS', 'Kyrgystani Som', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'LAK', 'Laotian Kip', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'LVL', 'Latvian Lats', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'LBP', 'Lebanese Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'LSL', 'Lesotho Loti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'LRD', 'Liberian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'LYD', 'Libyan Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'LTL', 'Lithuanian Litas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'MOP', 'Macanese Pataca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'MKD', 'Macedonian Denar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'MGA', 'Malagasy Ariary', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'MWK', 'Malawian Kwacha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'MYR', 'Malaysian Ringgit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'MVR', 'Maldivian Rufiyaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'MRO', 'Mauritanian Ouguiya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'MUR', 'Mauritian Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'MXN', 'Mexican Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'MDL', 'Moldovan Leu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'MNT', 'Mongolian Tugrik', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'MAD', 'Moroccan Dirham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'MZM', 'Mozambican Metical', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'MMK', 'Myanmar Kyat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'NAD', 'Namibian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'NPR', 'Nepalese Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'ANG', 'Netherlands Antillean Guilder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'TWD', 'New Taiwan Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'NZD', 'New Zealand Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'NIO', 'Nicaraguan CÃ³rdoba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'NGN', 'Nigerian Naira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'KPW', 'North Korean Won', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'NOK', 'Norwegian Krone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'OMR', 'Omani Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'PKR', 'Pakistani Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'PAB', 'Panamanian Balboa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'PGK', 'Papua New Guinean Kina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'PYG', 'Paraguayan Guarani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'PEN', 'Peruvian Nuevo Sol', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'PHP', 'Philippine Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'PLN', 'Polish Zloty', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'QAR', 'Qatari Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'RON', 'Romanian Leu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'RUB', 'Russian Ruble', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'RWF', 'Rwandan Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'SVC', 'Salvadoran ColÃ³n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'WST', 'Samoan Tala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'SAR', 'Saudi Riyal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'RSD', 'Serbian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'SCR', 'Seychellois Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'SLL', 'Sierra Leonean Leone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'SGD', 'Singapore Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'SKK', 'Slovak Koruna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'SBD', 'Solomon Islands Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'SOS', 'Somali Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'ZAR', 'South African Rand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'KRW', 'South Korean Won', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'XDR', 'Special Drawing Rights', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'LKR', 'Sri Lankan Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'SHP', 'St. Helena Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'SDG', 'Sudanese Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'SRD', 'Surinamese Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'SZL', 'Swazi Lilangeni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'SEK', 'Swedish Krona', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'CHF', 'Swiss Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'SYP', 'Syrian Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'STD', 'São Tomé and Príncipe Dobra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'TJS', 'Tajikistani Somoni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'TZS', 'Tanzanian Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'THB', 'Thai Baht', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'TOP', 'Tongan pa\'anga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'TTD', 'Trinidad & Tobago Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'TND', 'Tunisian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'TRY', 'Turkish Lira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'TMT', 'Turkmenistani Manat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'UGX', 'Ugandan Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'UAH', 'Ukrainian Hryvnia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'AED', 'United Arab Emirates Dirham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'UYU', 'Uruguayan Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'USD', 'US Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'UZS', 'Uzbekistan Som', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'VUV', 'Vanuatu Vatu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'VEF', 'Venezuelan BolÃ­var', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'VND', 'Vietnamese Dong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'YER', 'Yemeni Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'ZMK', 'Zambian Kwacha', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `currency_countries`
--

CREATE TABLE `currency_countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `currency_countries`
--

INSERT INTO `currency_countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Andorra', 'AD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Afghanistan', 'AF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Åland Islands', 'AX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Albania', 'AL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Algeria', 'DZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'American Samoa', 'AS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Angola', 'AO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Anguilla', 'AI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antarctica', 'AQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Antigua and Barbuda', 'AG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Argentina', 'AR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Armenia', 'AM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Aruba', 'AW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Australia', 'AU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Austria', 'AT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Azerbaijan', 'AZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahamas', 'BS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bahrain', 'BH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Bangladesh', 'BD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Barbados', 'BB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belarus', 'BY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belgium', 'BE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Belize', 'BZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Benin', 'BJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bermuda', 'BM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bhutan', 'BT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bolivia (Plurinational State of)', 'BO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bosnia and Herzegovina', 'BA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Botswana', 'BW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Bouvet Island', 'BV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brazil', 'BR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'British Indian Ocean Territory', 'IO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Brunei Darussalam', 'BN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Bulgaria', 'BG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Burkina Faso', 'BF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Burundi', 'BI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Cabo Verde', 'CV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cambodia', 'KH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cameroon', 'CM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Canada', 'CA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Cayman Islands', 'KY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Central African Republic', 'CF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Chad', 'TD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Chile', 'CL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'China', 'CN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Christmas Island', 'CX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Cocos (Keeling) Islands', 'CC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Colombia', 'CO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Comoros', 'KM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Congo', 'CG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Congo (Democratic Republic of the)', 'CD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cook Islands', 'CK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Costa Rica', 'CR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Côte d\'Ivoire', 'CI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Croatia', 'HR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Cuba', 'CU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Curaçao', 'CW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Cyprus', 'CY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Czech Republic', 'CZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Denmark', 'DK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Djibouti', 'DJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Dominica', 'DM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Dominican Republic', 'DO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Ecuador', 'EC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Egypt', 'EG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'El Salvador', 'SV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Equatorial Guinea', 'GQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Eritrea', 'ER', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Estonia', 'EE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Ethiopia', 'ET', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Falkland Islands (Malvinas)', 'FK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Faroe Islands', 'FO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Fiji', 'FJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Finland', 'FI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'France', 'FR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'French Guiana', 'GF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'French Polynesia', 'PF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'French Southern Territories', 'TF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Gabon', 'GA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Gambia', 'GM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Georgia', 'GE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Germany', 'DE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Ghana', 'GH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Gibraltar', 'GI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Greece', 'GR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Greenland', 'GL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Grenada', 'GD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guadeloupe', 'GP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guam', 'GU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guatemala', 'GT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Guernsey', 'GG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Guinea', 'GN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Guinea-Bissau', 'GW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Guyana', 'GY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Haiti', 'HT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Heard Island and McDonald Islands', 'HM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Holy See', 'VA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Honduras', 'HN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Hong Kong', 'HK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Hungary', 'HU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Iceland', 'IS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'India', 'IN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Indonesia', 'ID', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Iran (Islamic Republic of)', 'IR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Iraq', 'IQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Ireland', 'IE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Isle of Man', 'IM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Israel', 'IL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Italy', 'IT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Jamaica', 'JM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Japan', 'JP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Jersey', 'JE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Jordan', 'JO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Kazakhstan', 'KZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Kenya', 'KE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Kiribati', 'KI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Korea (Democratic People\'s Republic of)', 'KP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Korea (Republic of)', 'KR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Kuwait', 'KW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Kyrgyzstan', 'KG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Lao People\'s Democratic Republic', 'LA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Latvia', 'LV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Lebanon', 'LB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Lesotho', 'LS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Liberia', 'LR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Libya', 'LY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Liechtenstein', 'LI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Lithuania', 'LT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Luxembourg', 'LU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Macao', 'MO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Macedonia (the former Yugoslav Republic of)', 'MK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Madagascar', 'MG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Malawi', 'MW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Malaysia', 'MY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Maldives', 'MV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Mali', 'ML', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Malta', 'MT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Marshall Islands', 'MH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Martinique', 'MQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Mauritania', 'MR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Mauritius', 'MU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Mayotte', 'YT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Mexico', 'MX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Micronesia (Federated States of)', 'FM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Moldova (Republic of)', 'MD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Monaco', 'MC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Mongolia', 'MN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Montenegro', 'ME', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Montserrat', 'MS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Morocco', 'MA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Mozambique', 'MZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Myanmar', 'MM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Namibia', 'NA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Nauru', 'NR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Nepal', 'NP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Netherlands', 'NL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'New Caledonia', 'NC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'New Zealand', 'NZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Nicaragua', 'NI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Niger', 'NE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Nigeria', 'NG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Niue', 'NU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Norfolk Island', 'NF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Northern Mariana Islands', 'MP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Norway', 'NO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Oman', 'OM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Pakistan', 'PK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Palau', 'PW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Palestine, State of', 'PS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Panama', 'PA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Papua New Guinea', 'PG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Paraguay', 'PY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Peru', 'PE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Philippines', 'PH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Pitcairn', 'PN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Poland', 'PL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Portugal', 'PT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Puerto Rico', 'PR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Qatar', 'QA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Réunion', 'RE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Romania', 'RO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Russian Federation', 'RU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Rwanda', 'RW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Saint Barthélemy', 'BL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Saint Kitts and Nevis', 'KN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Saint Lucia', 'LC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Saint Martin (French part)', 'MF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Saint Pierre and Miquelon', 'PM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Saint Vincent and the Grenadines', 'VC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Samoa', 'WS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'San Marino', 'SM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Sao Tome and Principe', 'ST', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Saudi Arabia', 'SA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Senegal', 'SN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Serbia', 'RS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Seychelles', 'SC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Sierra Leone', 'SL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Singapore', 'SG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Sint Maarten (Dutch part)', 'SX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Slovakia', 'SK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Slovenia', 'SI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Solomon Islands', 'SB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Somalia', 'SO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'South Africa', 'ZA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'South Georgia and the South Sandwich Islands', 'GS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'South Sudan', 'SS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Spain', 'ES', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Sri Lanka', 'LK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Sudan', 'SD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Suriname', 'SR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Svalbard and Jan Mayen', 'SJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Swaziland', 'SZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Sweden', 'SE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Switzerland', 'CH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Syrian Arab Republic', 'SY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Taiwan, Province of China', 'TW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Tajikistan', 'TJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Tanzania, United Republic of', 'TZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Thailand', 'TH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Timor-Leste', 'TL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Togo', 'TG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'Tokelau', 'TK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'Tonga', 'TO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'Trinidad and Tobago', 'TT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'Tunisia', 'TN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Turkey', 'TR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Turkmenistan', 'TM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Turks and Caicos Islands', 'TC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Tuvalu', 'TV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Uganda', 'UG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Ukraine', 'UA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'United Arab Emirates', 'AE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'United Kingdom of Great Britain and Northern Ireland', 'GB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'United States Minor Outlying Islands', 'UM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'United States of America', 'US', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Uruguay', 'UY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Uzbekistan', 'UZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'Vanuatu', 'VU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'Venezuela (Bolivarian Republic of)', 'VE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'Viet Nam', 'VN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'Virgin Islands (British)', 'VG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'Virgin Islands (U.S.)', 'VI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'Wallis and Futuna', 'WF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'Western Sahara', 'EH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 'Yemen', 'YE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 'Zambia', 'ZM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 'Zimbabwe', 'ZW', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` longtext NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_pages`
--

INSERT INTO `custom_pages` (`id`, `page_name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Custom Page One', 'custom-page-one', '<p><strong>1. What is custom page?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. How does work custom page</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', 1, '2022-09-29 04:30:53', '2023-01-18 09:16:13'),
(2, 'Custom Page Two', 'custom-page-two', '<p><strong>1. What is custom page?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. How does work custom page</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', 1, '2022-09-29 06:17:38', '2023-01-18 09:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `custom_paginations`
--

CREATE TABLE `custom_paginations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_paginations`
--

INSERT INTO `custom_paginations` (`id`, `page_name`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Blog Page', 6, NULL, '2022-02-07 08:39:56'),
(2, 'Service Page', 9, NULL, '2022-10-03 10:18:39'),
(3, 'Provider Page', 8, NULL, '2022-02-07 02:14:01'),
(4, 'Blog Comment', 4, NULL, '2022-09-15 03:06:58'),
(5, 'Provider Review', 2, NULL, '2022-09-15 05:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `email_configurations`
--

CREATE TABLE `email_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_type` tinyint(4) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_password` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_configurations`
--

INSERT INTO `email_configurations` (`id`, `mail_type`, `mail_host`, `mail_port`, `email`, `email_password`, `smtp_username`, `smtp_password`, `mail_encryption`, `created_at`, `updated_at`) VALUES
(1, 2, 'mail.mamunuiux.com', '587', 'ecoshop@mamunuiux.com', 'mary+pass@', 'ecoshop@mamunuiux.com', ',NvBWT77)+8l', 'tls', NULL, '2023-05-07 21:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Password Reset', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', NULL, '2021-12-09 10:06:57'),
(2, 'Contact Email', 'Contact Email', '<p>Name: <b>{{name}}</b></p><p>\r\n\r\nEmail: <b>{{email}}</b></p><p>\r\n\r\nPhone: <b>{{phone}}</b></p><p><span style=\"background-color: transparent;\">Subject: <b>{{subject}}</b></span></p><p>\r\n\r\nMessage: <b>{{message}}</b></p>', NULL, '2021-12-10 23:44:34'),
(3, 'Subscribe Notification', 'Subscribe Notification', '<h2><b>Hi there</b>,</h2><p>\r\nCongratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you won\'t approve this link, after 24hourse your subscription will be denay</p>', NULL, '2021-12-10 23:44:53'),
(4, 'User Verification', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Click the following link and Active your Account.</p>', NULL, '2021-12-10 23:45:25'),
(5, 'Provider Withdraw', 'Provider Withdraw Approval', '<p>Hi <b>{{provider_name}}</b>,</p><p>Your withdraw Request Approval successfully. Please check your account.</p><p>Withdraw Details:</p><p>Withdraw method : <b>{{withdraw_method}}</b>,</p><p>Total Amount :<b> {{total_amount}}</b>,</p><p>Withdraw charge : <b>{{withdraw_charge}}</b>,</p><p>Withdraw&nbsp; Amount : <b>{{withdraw_amount}}</b>,</p><p>Approval Date :<b> {{approval_date}}</b></p>', NULL, '2022-08-30 03:24:53'),
(6, 'Order Successfully', 'Order Successfully', '<p>Hi {{user_name}},</p><p> \r\nThanks for your new order. Your order id has been submited .</p><p>Total Amount : {{total_amount}},</p><p>Payment Method : {{payment_method}},</p><p>Payment Status : {{payment_status}},</p><p>Order Status : {{order_status}},</p><p>Order Date: {{order_date}},</p><p>Order Detail: {{order_detail}}</p>', NULL, '2022-01-10 21:37:03'),
(8, 'New Order Mail to Client', 'New Order Mail to Client', '<p>Hi&nbsp;{{name}}, Thanks for your new order. Your order has been placed.</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p><p>Schedule Date : {{schedule_date}}</p>', NULL, '2022-09-24 10:15:23'),
(9, 'New Order Mail to Provider', 'New Order Mail to Provider', '<p>Hi&nbsp;{{name}}, A new order has been placed to you .</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p><p>Schedule Date : {{schedule_date}}</p>', NULL, '2022-09-24 10:16:22'),
(10, 'User Verification For OTP', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Copy the code and verify your account</p>', NULL, '2021-12-10 23:45:25'),
(11, 'Password Reset For OTP', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please copy and past the code</p>', NULL, '2021-12-09 10:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `error_pages`
--

CREATE TABLE `error_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_number` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_pages`
--

INSERT INTO `error_pages` (`id`, `page_name`, `page_number`, `header`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, '404 Error', '404', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-13 04:25:14'),
(2, '500 Error', '500', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-06 09:46:52'),
(3, '505 Error', '505', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-06 09:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_comments`
--

CREATE TABLE `facebook_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `comment_type` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facebook_comments`
--

INSERT INTO `facebook_comments` (`id`, `app_id`, `comment_type`, `created_at`, `updated_at`) VALUES
(1, '882238482112522', 1, NULL, '2022-10-08 07:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_pixels`
--

CREATE TABLE `facebook_pixels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `app_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facebook_pixels`
--

INSERT INTO `facebook_pixels` (`id`, `status`, `app_id`, `created_at`, `updated_at`) VALUES
(1, 1, '972911606915059', NULL, '2021-12-13 22:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What does WebSolutionUs do?', '<p>WebSolutionUs provides the best web solutions (web design, web development, search engine optimization, etc.) for international clients.</p>', 1, '2022-09-29 06:04:11', '2022-09-29 06:04:11'),
(2, 'Do you have an affiliate program?', '<p>We are currently working on our affiliate program setup. Soon it will be released to the public.&nbsp;<br></p>', 1, '2022-09-29 06:05:19', '2022-09-29 06:05:19'),
(3, 'Will I get the complete source code?', '<p>Yes, our source codes are open. If you purchase our product, you will get the complete source code.&nbsp;<br></p>', 1, '2022-09-29 06:05:41', '2022-09-29 06:05:41'),
(4, 'Do you provide customization service?', '<p>Yes, we provide the customization service for a small amount of fee. But it depends. If we become busy with projects, we do not take any custom orders.&nbsp;<br></p>', 1, '2022-09-29 06:06:01', '2022-09-29 06:06:01'),
(5, 'Can I test your product before purchase?', '<p>We currently do not offer this service, but soon we will start this service.<br></p>', 1, '2022-09-29 06:06:23', '2022-09-29 06:06:23'),
(6, 'What do we assist?', '<p>WebSolutionUS is a group of talented application developers that create products for marketplaces like Codecanyon and Themeforest. WebSolutionUS also creates customized websites, software, and applications for a variety of clients and businesses all around the world. WebSolutionUS offers exceptional assistance to ensure a successful business platform. We are envato marketplace approved and provide direct sales also.<br></p>', 1, '2022-09-29 06:06:53', '2022-09-29 06:06:53'),
(7, 'Can I avail the maintenance support for my clients?', '<p>Yes, you may design websites for your clients using our services, including scripting and themes. We like providing attractive and practical design ideas for clients.<br></p>', 1, '2022-09-29 06:07:15', '2022-09-29 06:07:15'),
(8, 'What is the refund policy detail?', '<p>Because you are using the best digital product and service, most of the time &nbsp; refunds will not be necessary, and because no returns will be given for digital items unless the product you bought is probably unnecessary, and you submitted a support request but had no response within one business day, and the product\'s primary statement was completely false. For additional information, please see our Refund Policy.<br></p>', 1, '2022-09-29 06:08:08', '2022-09-29 06:08:08'),
(9, 'How long will I get the service support?', '<p>At the end of the service session, are you puzzled? Okay, you may pay a little amount to renew support at any moment. In the vast majority of circumstances, it is not necessary. We like assisting our customers.<br></p>', 1, '2022-09-29 06:09:10', '2022-09-29 06:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `flutterwaves`
--

CREATE TABLE `flutterwaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `public_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flutterwaves`
--

INSERT INTO `flutterwaves` (`id`, `public_key`, `secret_key`, `currency_rate`, `country_code`, `currency_code`, `title`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FLWPUBK_TEST-5760e3ff9888aa1ab5e5cd1ec3f99cb1-X', 'FLWSECK_TEST-81cb5da016d0a51f7329d4a8057e766d-X', 460.49, 'NG', 'NGN', 'Ecommerce', 'uploads/website-images/flutterwave-2022-09-25-09-48-17-9566.jpg', 1, NULL, '2023-03-09 08:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `first_column` varchar(255) DEFAULT NULL,
  `second_column` varchar(255) DEFAULT NULL,
  `third_column` varchar(255) DEFAULT NULL,
  `copyright` varchar(191) DEFAULT NULL,
  `payment_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `phone`, `email`, `address`, `about_us`, `first_column`, `second_column`, `third_column`, `copyright`, `payment_image`, `created_at`, `updated_at`) VALUES
(1, '+1347-430-9510', 'websolutionus1@gmail.com', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'Important Link', 'Quick Link', 'Our Service', 'Copyright 2022, Websolutionus. All Rights Reserved.', 'uploads/website-images/payment-card-2022-08-28-04-29-12-1387.png', NULL, '2022-12-03 10:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `footer_links`
--

CREATE TABLE `footer_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `column` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_links`
--

INSERT INTO `footer_links` (`id`, `column`, `link`, `title`, `created_at`, `updated_at`) VALUES
(1, '1', 'contact-us', 'Contact Us', '2022-09-29 07:16:42', '2022-09-29 07:16:42'),
(2, '1', 'blogs', 'Our Blog', '2022-09-29 07:17:20', '2022-09-29 07:17:20'),
(3, '1', 'faq', 'FAQ', '2022-09-29 07:18:28', '2022-09-29 07:18:28'),
(4, '1', 'terms-and-conditions', 'Terms and Conditions', '2022-09-29 07:18:45', '2022-09-29 07:18:45'),
(5, '1', 'privacy-policy', 'Privacy Policy', '2022-09-29 07:19:13', '2022-09-29 07:19:13'),
(6, '2', 'services', 'Our Services', '2022-09-29 07:20:17', '2022-09-29 07:20:17'),
(7, '2', 'about-us', 'Why Choose Us', '2022-09-29 07:20:35', '2022-09-29 07:20:35'),
(8, '2', 'dashboard', 'My Profile', '2022-09-29 07:21:12', '2022-09-29 07:21:12'),
(9, '2', 'about-us', 'About Us', '2022-09-29 07:21:39', '2022-09-29 07:21:39'),
(10, '2', 'join-as-a-provider', 'Join as a Provider', '2022-09-29 07:22:37', '2022-09-29 07:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `footer_social_links`
--

CREATE TABLE `footer_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_social_links`
--

INSERT INTO `footer_social_links` (`id`, `link`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'fa fa-facebook', '2022-09-29 07:14:50', '2023-01-15 09:22:49'),
(2, 'https://www.twitter.com/', 'fab fa-twitter', '2022-09-29 07:15:06', '2022-09-29 07:15:06'),
(3, 'https://www.instagram.com/', 'fab fa-instagram', '2022-09-29 07:15:27', '2022-09-29 07:15:27'),
(4, 'https://www.linkedin.com/', 'fa fa-linkedin', '2022-09-29 07:15:44', '2023-01-15 09:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `google_analytics`
--

CREATE TABLE `google_analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analytic_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_analytics`
--

INSERT INTO `google_analytics` (`id`, `analytic_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UA-84213520-6', 1, NULL, '2021-12-10 22:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `google_recaptchas`
--

CREATE TABLE `google_recaptchas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_recaptchas`
--

INSERT INTO `google_recaptchas` (`id`, `site_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, '6LcVO6cbAAAAAOzIEwPlU66nL1rxD4VAS38tjpBX', '6LcVO6cbAAAAALVNrpZfNRfd0Gy_9a_fJRLiMVUI', 0, NULL, '2023-03-13 04:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `how_it_works`
--

CREATE TABLE `how_it_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_it_works`
--

INSERT INTO `how_it_works` (`id`, `image`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/how-it-work-2022-09-29-12-20-12-1071.png', 'Online Booking', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2022-09-29 06:20:12', '2022-09-29 06:20:12'),
(2, 'uploads/custom-images/how-it-work-2022-09-29-12-20-54-8399.png', 'Get Expert Cleaner', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2022-09-29 06:20:55', '2022-09-29 06:20:55'),
(3, 'uploads/custom-images/how-it-work-2022-09-29-12-21-46-2428.png', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2022-09-29 06:21:46', '2022-09-29 06:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `instamojo_payments`
--

CREATE TABLE `instamojo_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` text NOT NULL,
  `auth_token` text NOT NULL,
  `currency_rate` varchar(255) NOT NULL DEFAULT '1',
  `account_mode` varchar(255) NOT NULL DEFAULT 'Sandbox',
  `status` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instamojo_payments`
--

INSERT INTO `instamojo_payments` (`id`, `api_key`, `auth_token`, `currency_rate`, `account_mode`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'test_5f4a2c9a58ef216f8a1a688910f', 'test_994252ada69ce7b3d282b9941c2', '81.98', 'Sandbox', 1, 'uploads/website-images/instamojo-2022-09-25-10-05-31-7719.png', NULL, '2023-03-09 09:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `job_type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `address` text DEFAULT NULL,
  `total_view` bigint(20) NOT NULL DEFAULT 0,
  `regular_price` decimal(8,2) NOT NULL,
  `is_urgent` varchar(255) NOT NULL DEFAULT 'disable',
  `status` varchar(255) NOT NULL DEFAULT 'disable',
  `approved_by_admin` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `user_id`, `category_id`, `city_id`, `thumb_image`, `slug`, `job_type`, `title`, `description`, `address`, `total_view`, `regular_price`, `is_urgent`, `status`, `approved_by_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 19:11:19', '2024-07-07 19:28:56'),
(2, 1, 3, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 19:11:19', '2024-07-07 19:28:56'),
(3, 1, 1, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 19:11:19', '2024-07-07 19:28:56'),
(4, 1, 2, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 19:11:19', '2024-07-07 19:28:56'),
(6, 1, 3, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 19:11:19', '2024-07-07 19:28:56'),
(7, 1, 1, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 19:11:19', '2024-07-07 19:28:56'),
(10, 1, 1, 2, 'uploads/custom-images/jobpost-2024-07-09-11-43-19-9569.webp', 'software-engineer-for-android-development-user1', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You&rsquo;ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user&rsquo;s journey. Effectively pitch wireframes to and solutions to stakeholders. You&rsquo;ll be the greatest advocate forour work, but you&rsquo;ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users&rsquo;needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and &ldquo;can-do&rdquo; demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', '403/B(2nd Floor), Shahid Baki Road, Malibag Chowdhury Para, Dhaka : 1219, Bangladesh.', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-09 17:43:19', '2024-07-09 19:39:59'),
(11, 1, 2, 2, 'uploads/custom-images/jobpost-2024-07-10-01-43-03-8286.webp', 'Neque dolor Nam qui', 'Hourly', 'Et ea molestiae qui', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You&rsquo;ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user&rsquo;s journey. Effectively pitch wireframes to and solutions to stakeholders. You&rsquo;ll be the greatest advocate forour work, but you&rsquo;ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users&rsquo;needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and &ldquo;can-do&rdquo; demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Libero impedit labo', 0, 759.00, 'disable', 'enable', 'approved', '2024-07-09 19:43:03', '2024-07-09 19:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_translations`
--

CREATE TABLE `job_post_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_post_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_post_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `resume` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `job_post_id`, `seller_id`, `user_id`, `description`, `status`, `resume`, `created_at`, `updated_at`) VALUES
(1, 1, 28, 1, 'kjjkljljk', 'approved', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 20:49:26', '2024-07-07 23:33:23'),
(2, 1, 28, 1, 'kjjkljljk', 'rejected', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 20:49:26', '2024-07-07 23:33:23'),
(3, 1, 28, 1, 'kjjkljljk', 'rejected', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 20:49:26', '2024-07-07 23:33:23'),
(4, 1, 28, 1, 'kjjkljljk', 'rejected', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 20:49:26', '2024-07-07 23:33:23'),
(5, 11, 1, 28, 'pls hired me', 'approved', 'uploads/resume/pdf_668e4a13aef5f.pdf', '2024-07-09 19:45:07', '2024-07-09 19:46:28'),
(6, 12, 2, 1, 'applied', 'approved', 'uploads/resume/pdf_669608cfba009.pdf', '2024-07-15 16:44:47', '2024-07-15 17:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_information`
--

CREATE TABLE `kyc_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kyc_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_information`
--

INSERT INTO `kyc_information` (`id`, `kyc_id`, `user_id`, `file`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'uploads/custom-images/document-2024-06-26-02-48-52-2757.jpg', 'Pls Approve My KYC Verifaction', 1, '2024-06-25 20:48:52', '2024-06-25 20:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_types`
--

CREATE TABLE `kyc_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_types`
--

INSERT INTO `kyc_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Passport', 1, '2024-06-25 20:46:10', '2024-06-25 20:46:10'),
(2, 'Driving Licience', 1, '2024-06-25 20:47:39', '2024-06-25 20:47:39'),
(3, 'Nid', 1, '2024-06-25 20:47:47', '2024-06-25 20:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `maintainance_texts`
--

CREATE TABLE `maintainance_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintainance_texts`
--

INSERT INTO `maintainance_texts` (`id`, `status`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'uploads/website-images/maintainance-mode-2022-08-31-09-12-11-5142.png', 'We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank you.', NULL, '2023-01-14 06:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `menu_visibilities`
--

CREATE TABLE `menu_visibilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `custom_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_visibilities`
--

INSERT INTO `menu_visibilities` (`id`, `menu_name`, `custom_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home', 1, NULL, '2022-10-10 02:10:38'),
(2, 'About Us', 'About Us', 1, NULL, '2022-10-10 02:10:38'),
(3, 'Service', 'Service', 1, NULL, '2022-10-10 02:10:38'),
(4, 'Pages', 'Pages', 1, NULL, '2022-10-10 02:10:38'),
(5, 'FAQ', 'FAQ', 1, NULL, '2022-10-10 02:10:38'),
(6, 'Terms and Conditions', 'Terms and Conditions', 1, NULL, '2022-10-10 02:10:38'),
(7, 'Privacy Policy', 'Privacy Policy', 1, NULL, '2022-10-10 02:10:38'),
(8, 'Custom Page', 'Custom Page', 1, NULL, '2022-10-08 10:38:09'),
(9, 'Blog', 'Blog', 1, NULL, '2022-10-10 02:10:38'),
(10, 'Contact Us', 'Contact Us', 1, NULL, '2022-10-10 02:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `buyer_read_msg` int(11) NOT NULL DEFAULT 0,
  `provider_read_msg` int(11) NOT NULL DEFAULT 0,
  `send_by` varchar(20) NOT NULL,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `buyer_id`, `provider_id`, `message`, `buyer_read_msg`, `provider_read_msg`, `send_by`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, 1, 0, 'buyer', 19, '2024-07-28 19:30:43', '2024-07-28 20:39:08'),
(2, 1, 4, 'AZxZXZX', 1, 0, 'buyer', 0, '2024-07-28 20:39:11', '2024-07-28 20:39:11'),
(3, 1, 4, 'XzxZX', 1, 0, 'buyer', 0, '2024-07-28 20:39:15', '2024-07-28 20:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `message_documents`
--

CREATE TABLE `message_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_message_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_documents`
--

INSERT INTO `message_documents` (`id`, `ticket_message_id`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 6, 'support-file-1664946649.png', '2022-10-05 05:10:49', '2022-10-05 05:10:49'),
(2, 6, 'support-file-1664946649.png', '2022-10-05 05:10:49', '2022-10-05 05:10:49'),
(3, 6, 'support-file-1664946649.png', '2022-10-05 05:10:49', '2022-10-05 05:10:49'),
(4, 26, 'support-file-1664949635.png', '2022-10-05 06:00:35', '2022-10-05 06:00:35'),
(5, 26, 'support-file-1664949635.png', '2022-10-05 06:00:35', '2022-10-05 06:00:35'),
(6, 30, 'support-file-1664949755.png', '2022-10-05 06:02:35', '2022-10-05 06:02:35'),
(7, 30, 'support-file-1664949755.png', '2022-10-05 06:02:35', '2022-10-05 06:02:35'),
(8, 38, 'support-file-1668053670.jpg', '2022-11-10 04:14:30', '2022-11-10 04:14:30'),
(9, 39, 'support-file-1668053722.jpg', '2022-11-10 04:15:22', '2022-11-10 04:15:22'),
(10, 66, 'support-file-1711430965.png', '2024-03-25 16:29:25', '2024-03-25 16:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_30_035230_create_admins_table', 2),
(6, '2021_11_30_065435_create_email_configurations_table', 3),
(7, '2021_11_30_065508_create_email_templates_table', 3),
(8, '2021_12_01_035206_create_categories_table', 4),
(19, '2021_12_06_054423_create_about_us_table', 10),
(20, '2021_12_06_055028_create_custom_pages_table', 10),
(21, '2021_12_07_030532_create_terms_and_conditions_table', 11),
(22, '2021_12_07_035810_create_blog_categories_table', 12),
(23, '2021_12_07_035822_create_blogs_table', 12),
(24, '2021_12_07_040749_create_popular_posts_table', 12),
(25, '2021_12_07_061613_create_blog_comments_table', 13),
(30, '2021_12_09_095158_create_contact_messages_table', 16),
(31, '2021_12_09_095220_create_subscribers_table', 16),
(32, '2021_12_09_124226_create_settings_table', 17),
(33, '2021_12_11_022207_create_cookie_consents_table', 18),
(34, '2021_12_11_025358_create_google_recaptchas_table', 19),
(35, '2021_12_11_025449_create_facebook_comments_table', 19),
(36, '2021_12_11_025556_create_tawk_chats_table', 19),
(37, '2021_12_11_025618_create_google_analytics_table', 19),
(38, '2021_12_11_025712_create_custom_paginations_table', 19),
(39, '2021_12_11_083503_create_faqs_table', 20),
(40, '2021_12_11_094707_create_currencies_table', 21),
(43, '2021_12_13_101056_create_error_pages_table', 23),
(44, '2021_12_13_102725_create_maintainance_texts_table', 24),
(45, '2021_12_13_110144_create_subscribe_modals_table', 25),
(47, '2021_12_13_132626_create_countries_table', 27),
(48, '2021_12_13_132909_create_country_states_table', 27),
(49, '2021_12_13_132935_create_cities_table', 27),
(50, '2021_12_14_032937_create_social_login_information_table', 28),
(51, '2021_12_14_042928_create_facebook_pixels_table', 29),
(52, '2021_12_14_054908_create_paypal_payments_table', 30),
(53, '2021_12_14_054922_create_stripe_payments_table', 30),
(54, '2021_12_14_054939_create_razorpay_payments_table', 30),
(55, '2021_12_14_055252_create_bank_payments_table', 30),
(62, '2021_12_22_034106_create_banner_images_table', 35),
(63, '2021_12_22_044839_create_sliders_table', 36),
(67, '2021_12_23_065722_create_paystack_and_mollies_table', 40),
(68, '2021_12_23_085225_create_withdraw_methods_table', 41),
(71, '2021_12_25_172918_create_seller_withdraws_table', 42),
(81, '2021_12_26_054841_create_orders_table', 45),
(88, '2021_12_28_192057_create_contact_pages_table', 47),
(89, '2021_12_28_200846_create_breadcrumb_images_table', 48),
(90, '2021_12_30_032959_create_flutterwaves_table', 49),
(91, '2021_12_30_034716_create_footers_table', 50),
(92, '2021_12_30_035201_create_footer_links_table', 50),
(93, '2021_12_30_035247_create_footer_social_links_table', 50),
(99, '2022_01_12_080218_create_seo_settings_table', 54),
(100, '2022_01_17_012111_create_menu_visibilities_table', 55),
(101, '2022_01_17_122016_create_instamojo_payments_table', 56),
(102, '2022_01_29_055523_create_messages_table', 57),
(103, '2022_01_29_122621_create_pusher_credentails_table', 58),
(104, '2022_08_28_070755_create_how_it_works_table', 59),
(105, '2022_08_29_072358_create_testimonials_table', 60),
(106, '2022_08_31_083601_create_services_table', 61),
(108, '2022_08_31_093322_create_additional_services_table', 62),
(112, '2022_09_01_103923_create_schedules_table', 63),
(113, '2022_09_05_111413_create_refund_requests_table', 64),
(114, '2022_09_06_054021_create_complete_requests_table', 65),
(115, '2022_09_06_064506_create_provider_client_reports_table', 66),
(116, '2022_09_06_072831_create_tickets_table', 67),
(117, '2022_09_06_073338_create_ticket_messages_table', 67),
(118, '2022_09_06_101227_create_message_documents_table', 68),
(119, '2022_09_26_070233_create_section_contents_table', 69),
(120, '2022_09_26_083106_create_section_controls_table', 70),
(121, '2022_09_29_044208_create_provider_client_reports_table', 71),
(122, '2023_01_09_043222_create_appointment_schedules_table', 72),
(123, '2023_02_02_062116_create_mobile_sliders_table', 73),
(124, '2023_03_09_045111_create_coupons_table', 74),
(125, '2023_03_09_055745_create_coupon_histories_table', 75),
(126, '2023_04_02_104756_create_service_areas_table', 76),
(127, '2023_04_26_041806_create_subscription_histories_table', 77),
(128, '2023_06_17_034741_add_currency_position_to_settings', 78),
(129, '2023_04_29_032738_create_subscription_plans_table', 79),
(130, '2023_04_29_054610_create_purchase_histories_table', 79),
(131, '2023_04_30_232442_create_provider_stripes_table', 79),
(132, '2023_04_30_232831_create_provider_paypals_table', 79),
(133, '2023_04_30_232901_create_provider_razorpays_table', 79),
(134, '2023_04_30_232928_create_provider_flutterwaves_table', 79),
(135, '2023_04_30_232948_create_provider_paystacks_table', 79),
(136, '2023_04_30_233017_create_provider_mollies_table', 79),
(137, '2023_04_30_233052_create_provider_instamojos_table', 79),
(138, '2023_06_19_054429_add_commission_type_to_settings', 80),
(139, '2023_04_30_233147_create_provider_bank_handcashes_table', 81),
(140, '2023_06_22_050401_add_handcash_image_to_bank_payments', 82),
(141, '2023_08_16_085234_add_live_chat_to_settings', 83),
(142, '2023_08_16_110444_add_app_version_to_settings', 84),
(143, '2024_05_01_050338_create_kyc_types_table', 85),
(144, '2024_05_01_082702_create_kyc_information_table', 85),
(146, '2024_05_02_171413_create_job_posts_table', 86),
(147, '2024_05_02_171618_create_job_post_translations_table', 86),
(148, '2024_03_20_060641_create_job_requests_table', 87),
(149, '2024_07_16_063745_add_kyc_status_to_users_table', 88),
(150, '2024_08_27_182402_add_kyc_status_to_users_table', 89);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_sliders`
--

CREATE TABLE `mobile_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_one` text NOT NULL,
  `title_two` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_sliders`
--

INSERT INTO `mobile_sliders` (`id`, `title_one`, `title_two`, `image`, `status`, `serial`, `created_at`, `updated_at`) VALUES
(1, 'Title One', 'Service', 'uploads/custom-images/mb-slider-2023-02-02-01-17-30-2566.jpg', 1, 2, '2023-02-02 06:55:00', '2023-02-02 07:17:30'),
(3, 'Digital marketing', 'Title Two', 'uploads/custom-images/mb-slider-2023-02-02-01-17-19-2477.jpg', 1, 1, '2023-02-02 07:17:19', '2023-02-02 07:18:26'),
(4, 'Wemen\'s Jeans Collection', '35% Offer', 'uploads/custom-images/mb-slider-2023-02-02-01-18-15-4748.jpg', 1, 10, '2023-02-02 07:18:16', '2023-02-02 07:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `package_amount` double NOT NULL DEFAULT 0,
  `total_amount` double NOT NULL DEFAULT 0,
  `booking_date` varchar(255) NOT NULL,
  `appointment_schedule_id` int(11) NOT NULL DEFAULT 0,
  `schedule_time_slot` varchar(250) DEFAULT NULL,
  `additional_amount` double NOT NULL DEFAULT 0,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `refound_status` int(11) NOT NULL DEFAULT 0,
  `payment_refound_date` varchar(255) DEFAULT NULL,
  `transection_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_approval_date` varchar(255) DEFAULT NULL,
  `order_completed_date` varchar(255) DEFAULT NULL,
  `order_declined_date` varchar(255) DEFAULT NULL,
  `package_features` text DEFAULT NULL,
  `additional_services` text DEFAULT NULL,
  `client_address` text DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `complete_by_admin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_discount` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `client_id`, `provider_id`, `service_id`, `package_amount`, `total_amount`, `booking_date`, `appointment_schedule_id`, `schedule_time_slot`, `additional_amount`, `payment_method`, `payment_status`, `refound_status`, `payment_refound_date`, `transection_id`, `order_status`, `order_approval_date`, `order_completed_date`, `order_declined_date`, `package_features`, `additional_services`, `client_address`, `order_note`, `complete_by_admin`, `created_at`, `updated_at`, `coupon_discount`) VALUES
(1, '1188362958', 1, 2, 12, 12, 96, '28-12-2022', 0, NULL, 84, 'Stripe', 'success', 0, NULL, 'txn_3Lom1sF56Pb8BOOX1vpXFAOh', 'complete', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\"]', '[{\"service_name\":\"Service one\",\"qty\":\"3\",\"price\":36},{\"service_name\":\"Service two\",\"qty\":\"3\",\"price\":48}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"California, USA\",\"post_code\":\"5230\",\"order_note\":\"This is order note.\"}', 'This is order note.', NULL, '2022-10-03 10:37:38', '2022-10-03 11:01:44', 0),
(2, '1062958524', 1, 2, 13, 10, 46, '28-12-2022', 0, NULL, 36, 'Paypal', 'success', 0, NULL, 'PAYID-MM5MBPY18S50981KS668364Y', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\"]', '[{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service One\",\"qty\":\"2\",\"price\":24},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"California, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2022-10-03 11:00:32', '2022-10-03 11:01:20', 0),
(3, '897914578', 1, 2, 13, 10, 46, '28-12-2022', 0, NULL, 36, 'Mollie', 'success', 0, NULL, 'tr_EKRDK5WDwQ', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\"]', '[{\"service_name\":\"Service One\",\"qty\":\"2\",\"price\":24},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"David Richard\",\"email\":\"user@gmail.com\",\"phone\":\"236-598-7458\",\"address\":\"California, USA\",\"post_code\":\"9562\",\"order_note\":null}', NULL, NULL, '2022-10-03 11:09:55', '2022-10-03 11:21:26', 0),
(4, '1529598605', 1, 2, 12, 12, 100, '28-12-2022', 0, NULL, 88, 'Paystack', 'success', 0, NULL, '2153628256', 'order_decliened_by_client', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\"]', '[{\"service_name\":\"Service one\",\"qty\":\"2\",\"price\":24},{\"service_name\":\"Service three\",\"qty\":\"2\",\"price\":16},{\"service_name\":\"Service two\",\"qty\":\"3\",\"price\":48}]', '{\"name\":\"David Richard\",\"email\":\"agent@gmail.com\",\"phone\":\"236-598-7458\",\"address\":\"Gandhinagar, Gujarat, India\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2022-10-04 07:04:01', '2022-10-04 09:38:33', 0),
(5, '147495322', 1, 2, 12, 12, 40, '28-12-2022', 0, NULL, 28, 'Stripe', 'success', 0, NULL, 'txn_3Lp88fF56Pb8BOOX0DQ7FftM', 'complete', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\"]', '[{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16},{\"service_name\":\"Service one\",\"qty\":\"1\",\"price\":12}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"236-598-7458\",\"address\":\"California, USA\",\"post_code\":\"2380\",\"order_note\":\"this is test note\"}', 'this is test note', NULL, '2022-10-04 10:14:06', '2022-11-10 05:52:56', 0),
(6, '793958379', 1, 2, 13, 10, 10, '17-10-2022', 0, NULL, 0, 'Mollie', 'success', 0, NULL, 'tr_Z6ubwzLjYN', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"agent@gmail.com\",\"phone\":\"236-598-7458\",\"address\":\"California, USA\",\"post_code\":\"5620\",\"order_note\":\"This is my order note.\"}', 'This is my order note.', NULL, '2022-10-05 10:37:14', '2022-11-10 05:39:44', 0),
(7, '1259845181', 1, 2, 13, 10, 10, '19-10-2022', 0, NULL, 0, 'Stripe', 'success', 0, NULL, 'txn_3LpqfKF56Pb8BOOX0YamzpEZ', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"California, USA\",\"post_code\":\"5230\",\"order_note\":\"this is test note\"}', 'this is test note', NULL, '2022-10-06 09:46:58', '2022-10-06 09:46:58', 0),
(8, '139977078', 1, 2, 13, 10, 10, '12-10-2022', 0, NULL, 0, 'Razorpay', 'success', 0, NULL, 'pay_KQRtVd1ziydiZ1', 'approved_by_provider', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\"]', '[]', '{\"name\":\"David Richard\",\"email\":\"agent@gmail.com\",\"phone\":\"236-598-7458\",\"address\":\"Gandhinagar, Gujarat, India\",\"post_code\":\"8965\",\"order_note\":null}', NULL, NULL, '2022-10-06 10:13:45', '2022-12-25 11:43:01', 0),
(9, '1272887794', 1, 2, 4, 60, 60, '18-10-2022', 0, NULL, 0, 'Flutterwave', 'success', 0, NULL, '3793389', 'complete', NULL, NULL, NULL, '[\"Car Cleaning\",\"Car Washing\",\"Quality Service\",\"Timely Work\"]', '[]', '{\"name\":\"David Richard\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Gandhinagar, Gujarat, India\",\"post_code\":\"2354\",\"order_note\":\"this is test note\"}', 'this is test note', NULL, '2022-10-06 10:42:31', '2022-11-10 05:45:28', 0),
(10, '1059141908', 1, 2, 13, 10, 34, '29-12-2022', 0, NULL, 24, 'Stripe', 'success', 0, NULL, 'txn_3MHJBmF56Pb8BOOX12zTpOJG', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"California, USA\",\"post_code\":\"6520\",\"order_note\":null}', NULL, 'Yes', '2022-12-21 03:41:58', '2022-12-21 03:56:35', 0),
(11, '581889298', 1, 2, 13, 10, 31, '27-12-2023', 0, NULL, 21, 'Bank Payment', 'pending', 0, NULL, 'Bank Name: Your bank name\r\nAccount Number: Your bank account number', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"0170000000\",\"address\":\"Barguna\",\"post_code\":\"6985\",\"order_note\":null}', NULL, NULL, '2022-12-25 12:10:03', '2022-12-25 12:10:03', 0),
(12, '822787440', 1, 2, 13, 10, 22, '28-12-2022', 0, NULL, 12, 'Stripe', 'success', 0, NULL, 'txn_3MIt4HF56Pb8BOOX1BFkBPHI', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning 15 sf\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"0170000000\",\"address\":\"Barguna\",\"post_code\":\"6985\",\"order_note\":null}', NULL, NULL, '2022-12-25 12:12:45', '2022-12-25 12:12:45', 0),
(13, '1554460241', 1, 2, 11, 15, 37, '29-12-2022', 0, NULL, 22, 'Paypal', 'success', 0, NULL, 'PAYID-MOUSMJQ2XY20509KT1254847', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"One Ton AC\",\"Two Ton AC\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\",\"Washroom Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10}]', '{\"name\":\"David Richard\",\"email\":\"client@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"California, USA\",\"post_code\":\"9652\",\"order_note\":null}', NULL, NULL, '2022-12-26 04:42:40', '2022-12-26 04:42:40', 0),
(14, '866266656', 1, 2, 5, 30, 42, '29-12-2022', 0, NULL, 12, 'Razorpay', 'success', 0, NULL, 'pay_KwPYkFhwff0E95', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"AC Change\",\"Ac Repair\",\"Service Gurantee\",\"Quality Service\",\"Chair And Table Cleaning\"]', '[{\"service_name\":\"Extra Service Three\",\"qty\":\"1\",\"price\":4},{\"service_name\":\"Extra Service Two\",\"qty\":\"1\",\"price\":5},{\"service_name\":\"Extra Service One\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"David Simmons\",\"email\":\"david@gmail.com\",\"phone\":\"321-456-7896\",\"address\":\"Gandhinagar, Gujarat, India\",\"post_code\":\"6523\",\"order_note\":null}', NULL, NULL, '2022-12-26 04:44:39', '2022-12-26 04:44:39', 0),
(15, '228899888', 1, 2, 3, 32, 59, '03-01-2023', 0, NULL, 27, 'Flutterwave', 'success', 0, NULL, '4047486', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"How to Profit\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":8},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":15},{\"service_name\":\"Service Four\",\"qty\":\"1\",\"price\":4}]', '{\"name\":\"Daniel Paul\",\"email\":\"damian@blueonnix.com\",\"phone\":\"569-487-8541\",\"address\":\"Gandhinagar, Gujarat, India\",\"post_code\":\"7854\",\"order_note\":null}', NULL, NULL, '2022-12-26 04:46:56', '2022-12-26 04:46:56', 0),
(16, '1302444006', 1, 2, 10, 8, 19, '26-12-2022', 0, NULL, 11, 'Paystack', 'success', 0, NULL, '2395981452', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Hair Cutting Boys\",\"Hair Cutting Girls\",\"Washroom Cleaning\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":5},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":6}]', '{\"name\":\"David Warner\",\"email\":\"warner@gmail.com\",\"phone\":\"236-598-7458\",\"address\":\"California, USA\",\"post_code\":\"2103\",\"order_note\":null}', NULL, NULL, '2022-12-26 04:48:30', '2022-12-26 04:48:30', 0),
(17, '657284445', 1, 2, 1, 50, 50, '03-01-2023', 0, NULL, 0, 'Instamojo', 'success', 0, NULL, 'MOJO2c26305A89328674', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Floor And Carpet Cleaning\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-874-8948\",\"address\":\"California, USA\",\"post_code\":\"5623\",\"order_note\":null}', NULL, NULL, '2022-12-26 04:50:27', '2022-12-26 04:50:27', 0),
(18, '1326278623', 1, 2, 10, 8, 19, '26-12-2022', 0, NULL, 11, 'Bank Payment', 'success', 0, NULL, 'Bank Name: IBBL Dhaka\r\nAccount Number: 5214521452\r\nTnx: KFJDKFSF94934', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Hair Cutting Boys\",\"Hair Cutting Girls\",\"Washroom Cleaning\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":6},{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":5}]', '{\"name\":\"David Richard\",\"email\":\"rabbit@gmail.com\",\"phone\":\"569-487-8541\",\"address\":\"Gandhinagar, Gujarat, India\",\"post_code\":\"1254\",\"order_note\":null}', NULL, NULL, '2022-12-26 04:52:39', '2022-12-26 05:19:09', 0),
(19, '902860475', 1, 2, 12, 12, 12, '29-01-2023', 0, NULL, 0, 'Stripe', 'success', 0, NULL, 'txn_3MOHVJF56Pb8BOOX0LjwJDYP', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"2503\",\"order_note\":null}', NULL, NULL, '2023-01-09 09:18:56', '2023-01-09 09:18:56', 0),
(20, '1573202325', 1, 2, 12, 12, 48, '29-01-2023', 1, '08:00 AM - 08:20 AM', 36, 'Stripe', 'success', 0, NULL, 'txn_3MOHdTF56Pb8BOOX0SKY4K9Q', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service one\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16},{\"service_name\":\"Service three\",\"qty\":\"1\",\"price\":8}]', '{\"name\":\"David Richard\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-09 09:27:20', '2023-01-09 09:27:20', 0),
(21, '1470627845', 10, 2, 12, 12, 36, '29-01-2023', 2, '08:20 AM - 08:40 AM', 24, 'Stripe', 'success', 0, NULL, 'txn_3MOHp3F56Pb8BOOX0l8TryiK', 'order_decliened_by_provider', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service three\",\"qty\":\"1\",\"price\":8},{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16}]', '{\"name\":\"David Richard\",\"email\":\"agent@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-09 09:39:18', '2023-01-09 10:01:39', 0),
(22, '1293658035', 1, 2, 12, 12, 40, '29-01-2023', 2, '08:20 AM - 08:40 AM', 28, 'Stripe', 'success', 0, NULL, 'txn_3MOHqOF56Pb8BOOX1LZfXVy0', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16},{\"service_name\":\"Service one\",\"qty\":\"1\",\"price\":12}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"2111\",\"order_note\":null}', NULL, NULL, '2023-01-09 09:40:41', '2023-01-09 09:40:41', 0),
(23, '413068388', 10, 2, 12, 12, 36, '29-01-2023', 2, '08:20 AM - 08:40 AM', 24, 'Stripe', 'success', 0, NULL, 'txn_3MOHtWF56Pb8BOOX1YqJFD4h', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service three\",\"qty\":\"1\",\"price\":8},{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16}]', '{\"name\":\"David Richard\",\"email\":\"agent@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-09 09:43:55', '2023-01-09 09:43:55', 0),
(24, '584891307', 10, 2, 12, 12, 40, '29-01-2023', 3, '08:40 AM - 09:00 AM', 28, 'Stripe', 'success', 0, NULL, 'txn_3MOHxSF56Pb8BOOX1h592r6W', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16},{\"service_name\":\"Service one\",\"qty\":\"1\",\"price\":12}]', '{\"name\":\"David Richard\",\"email\":\"admin@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"6985\",\"order_note\":null}', NULL, NULL, '2023-01-09 09:47:59', '2023-01-09 09:47:59', 0),
(25, '669326882', 10, 2, 12, 12, 12, '05-02-2023', 1, '08:00 AM - 08:20 AM', 0, 'Razorpay', 'success', 0, NULL, 'pay_L23rpUqbCmxXVn', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[]', '{\"name\":\"David Richard\",\"email\":\"user@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"California, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-09 11:25:30', '2023-01-09 11:25:30', 0),
(26, '1660913743', 10, 2, 12, 12, 36, '05-02-2023', 2, '08:20 AM - 08:40 AM', 24, 'Razorpay', 'success', 0, NULL, 'pay_L2477SEV4Kjf1W', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16},{\"service_name\":\"Service three\",\"qty\":\"1\",\"price\":8}]', '{\"name\":\"David Richard\",\"email\":\"admin@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2023-01-09 11:39:59', '2023-01-09 11:39:59', 0),
(27, '1608221293', 10, 2, 12, 12, 12, '30-01-2023', 19, '08:00 AM - 08:20 AM', 0, 'Flutterwave', 'success', 0, NULL, '4078952', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"agent@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"California, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2023-01-09 12:09:01', '2023-01-09 12:09:01', 0),
(28, '894505662', 10, 2, 12, 12, 36, '23-01-2023', 19, '08:00 AM - 08:20 AM', 24, 'Mollie', 'success', 0, NULL, 'tr_AzGCDfpUAS', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service three\",\"qty\":\"1\",\"price\":8},{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16}]', '{\"name\":\"David Richard\",\"email\":\"admin@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"530\",\"order_note\":null}', NULL, NULL, '2023-01-09 12:15:48', '2023-01-09 12:15:48', 0),
(29, '109649924', 10, 2, 12, 12, 12, '15-01-2023', 1, '08:00 AM - 08:20 AM', 0, 'Mollie', 'success', 0, NULL, 'tr_umtx4zWDU9', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"agent@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"530\",\"order_note\":null}', NULL, NULL, '2023-01-09 12:19:47', '2023-01-09 12:19:47', 0),
(30, '752936925', 10, 2, 12, 12, 12, '23-01-2023', 20, '08:20 AM - 08:40 AM', 0, 'Paystack', 'success', 0, NULL, '2434929964', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"530\",\"order_note\":null}', NULL, NULL, '2023-01-09 12:28:22', '2023-01-09 12:28:22', 0),
(31, '873402421', 10, 2, 12, 12, 40, '22-01-2023', 1, '08:00 AM - 08:20 AM', 28, 'Bank Payment', 'pending', 0, NULL, 'Bank Name: Your bank name\r\nAccount Number: Your bank account number', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Service one\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service two\",\"qty\":\"1\",\"price\":16}]', '{\"name\":\"David Richard\",\"email\":\"agent@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"California, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-09 12:37:38', '2023-01-09 12:37:38', 0),
(32, '926436224', 1, 4, 21, 20, 20, '30-01-2023', 104, '08:00 AM - 08:20 AM', 0, 'Stripe', 'success', 0, NULL, 'txn_3MQ1QfF56Pb8BOOX0ljaOwPo', 'approved_by_provider', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-14 04:33:21', '2023-01-14 04:34:19', 0),
(33, '277045031', 1, 4, 21, 20, 51, '22-01-2023', 0, NULL, 31, 'Paypal', 'success', 0, NULL, 'PAYID-MPBDHMY6NL96448NF719862F', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"2\",\"price\":10},{\"service_name\":\"Service Two\",\"qty\":\"3\",\"price\":21}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-14 04:47:10', '2023-01-14 04:47:10', 0),
(34, '592450922', 1, 4, 20, 15, 37, '22-01-2023', 87, '08:00 AM - 08:20 AM', 22, 'Razorpay', 'success', 0, NULL, 'pay_L3vmOM3Ln7KYJ0', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":8},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":14}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-874-6548\",\"address\":\"California, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2023-01-14 04:48:48', '2023-01-14 04:48:48', 0),
(35, '19327764', 1, 4, 15, 28, 76, '22-01-2023', 88, '08:20 AM - 08:40 AM', 48, 'Flutterwave', 'success', 0, NULL, '4089619', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"2\",\"price\":20},{\"service_name\":\"Service Two\",\"qty\":\"2\",\"price\":10},{\"service_name\":\"Service Three\",\"qty\":\"3\",\"price\":18}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-01-14 04:53:07', '2023-01-14 04:54:52', 0),
(36, '1635423196', 1, 4, 15, 28, 43, '22-01-2023', 89, '08:40 AM - 09:00 AM', 15, 'Mollie', 'success', 0, NULL, 'tr_tj3dQydieP', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":5},{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2023-01-14 05:01:14', '2023-01-14 05:01:14', 0),
(37, '1498873381', 1, 4, 15, 28, 43, '22-01-2023', 90, '09:00 AM - 09:20 AM', 15, 'Paystack', 'success', 0, NULL, '2446714943', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":5}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, 'Yes', '2023-01-14 05:02:39', '2023-01-15 05:33:44', 0),
(38, '1082922312', 1, 4, 15, 28, 49, '29-01-2023', 87, '08:00 AM - 08:20 AM', 21, 'Bank Payment', 'success', 0, NULL, 'Bank Name: Your bank name\r\nAccount Number: Your bank account number', 'complete', NULL, NULL, NULL, '[\"Room Cleaning 15\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":5},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":6}]', '{\"name\":\"David Richard\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, 'Yes', '2023-01-14 05:06:00', '2023-01-14 05:06:57', 0),
(47, '1461149978', 1, 2, 13, 10, 31, '30-01-2023', 0, NULL, 21, 'Bank Payment', 'pending', 0, NULL, 'IBBL Dhaka Branch, TNX_334DFDSFSFSAD', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 09:39:21', '2023-01-19 09:39:21', 0),
(48, '513276728', 1, 2, 13, 10, 31, '30-01-2023', 24, NULL, 21, 'Bank Payment', 'pending', 0, NULL, 'IBBL Dhaka Branch, TNX_334DFDSFSFSAD', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 09:40:27', '2023-01-19 09:40:27', 0),
(49, '265119637', 1, 2, 13, 10, 31, '30-01-2023', 25, NULL, 21, 'Bank Payment', 'pending', 0, NULL, 'IBBL Dhaka Branch, TNX_334DFDSFSFSAD', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 09:41:44', '2023-01-19 09:41:44', 0),
(50, '499639955', 1, 2, 13, 10, 31, '30-01-2023', 26, NULL, 21, 'Bank Payment', 'pending', 0, NULL, 'IBBL Dhaka Branch, TNX_334DFDSFSFSAD', 'approved_by_provider', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 09:49:52', '2023-01-19 10:11:38', 0),
(51, '1370117881', 1, 2, 13, 10, 31, '23-01-2023', 26, '10:20 AM - 10:40 AM', 21, 'Bank Payment', 'success', 0, NULL, 'IBBL Dhaka Branch, TNX_334DFDSFSFSAD', 'complete', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 10:08:16', '2023-01-19 10:15:23', 0),
(52, '1539022327', 1, 2, 13, 10, 31, '23-01-2023', 27, '10:40 AM - 11:00 AM', 21, 'Stripe', 'success', 0, NULL, 'txn_3MRw2yF56Pb8BOOX1JOOADgE', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 11:12:44', '2023-01-19 11:12:44', 0),
(53, '209665425', 1, 2, 13, 10, 31, '23-01-2023', 28, '11:00 AM - 11:20 AM', 21, 'Stripe', 'success', 0, NULL, 'txn_3MRw3iF56Pb8BOOX1HdthbI6', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 11:13:30', '2023-01-19 11:13:30', 0),
(54, '1493090776', 1, 2, 13, 10, 31, '23-01-2023', 29, '11:20 AM - 11:40 AM', 21, 'Stripe', 'success', 0, NULL, 'txn_3MRw4TF56Pb8BOOX0FYXvBf3', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-01-19 11:14:17', '2023-01-19 11:14:17', 0),
(55, '1468896043', 1, 2, 13, 10, 31, '23-02-2023', 26, '10:20 AM - 10:40 AM', 21, 'Razorpay', 'success', 0, NULL, 'pay_LCdIMkhE1D18Wk', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 04:36:25', '2023-02-05 04:36:25', 0),
(56, '8586071', 1, 2, 13, 10, 31, '23-02-2023', 25, '10:00 AM - 10:20 AM', 21, 'Razorpay', 'success', 0, NULL, '4134496', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 05:25:34', '2023-02-05 05:25:34', 0),
(57, '1530819917', 1, 2, 13, 10, 31, '23-02-2023', 24, '09:40 AM - 10:00 AM', 21, 'Razorpay', 'success', 0, NULL, '4134498', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 05:29:08', '2023-02-05 05:29:08', 0),
(58, '1627045197', 1, 2, 13, 10, 31, '23-02-2023', 23, '09:20 AM - 09:40 AM', 21, 'Mollie', 'success', 0, NULL, 'tr_jpDc7VURoE', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 06:08:35', '2023-02-05 06:08:35', 0),
(59, '462975095', 1, 2, 13, 10, 31, '24-02-2023', 23, '09:20 AM - 09:40 AM', 21, 'Paystack', 'success', 0, NULL, '2506084356', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 06:36:29', '2023-02-05 06:36:29', 0),
(60, '34548123', 1, 2, 13, 10, 31, '24-02-2023', 24, '09:40 AM - 10:00 AM', 21, 'Paystack', 'success', 0, NULL, '2506092614', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 06:39:44', '2023-02-05 06:39:44', 0),
(61, '1130956679', 1, 2, 13, 10, 31, '24-02-2023', 25, '10:00 AM - 10:20 AM', 21, 'Instamojo', 'success', 0, NULL, 'MOJO3205605A57813071', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 07:02:25', '2023-02-05 07:02:25', 0),
(62, '122285046', 1, 2, 13, 10, 31, '24-02-2023', 0, NULL, 21, 'Paypal', 'success', 0, NULL, 'PAYID-MPPWWVQ0R6753500N970162J', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-987-6547\",\"address\":\"USA, California\",\"post_code\":\"5230\",\"order_note\":\"this is order note\"}', 'this is order note', NULL, '2023-02-05 08:41:33', '2023-02-05 08:41:33', 0),
(63, '608680163', 1, 2, 13, 10, 32.3, '21-03-2023', 50, '12:40 PM - 01:00 PM', 24, 'Stripe', 'success', 0, NULL, 'txn_3Mje3yF56Pb8BOOX1FAi5oe2', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"David Richard\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-03-09 07:38:58', '2023-03-09 07:38:58', 1.7),
(64, '493185260', 1, 2, 11, 15, 31.45, '28-03-2023', 51, '01:00 PM - 01:30 PM', 22, 'Razorpay', 'success', 0, NULL, 'pay_LPMkeMSV2Bne5r', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"One Ton AC\",\"Two Ton AC\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\",\"Washroom Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-03-09 08:51:00', '2023-03-09 08:51:00', 5.55),
(65, '255625372', 1, 2, 5, 30, 35.7, '26-03-2023', 14, '12:00 PM - 12:20 PM', 12, 'Flutterwave', 'success', 0, NULL, '4192307', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"AC Change\",\"Ac Repair\",\"Service Gurantee\",\"Quality Service\",\"Chair And Table Cleaning\"]', '[{\"service_name\":\"Extra Service Two\",\"qty\":\"1\",\"price\":5},{\"service_name\":\"Extra Service One\",\"qty\":\"1\",\"price\":3},{\"service_name\":\"Extra Service Three\",\"qty\":\"1\",\"price\":4}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-03-09 09:06:50', '2023-03-09 09:06:50', 6.3),
(66, '1010759840', 1, 2, 13, 10, 28.9, '21-03-2023', 51, '01:00 PM - 01:30 PM', 24, 'Mollie', 'success', 0, NULL, 'tr_faucUmsFD5', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-03-09 09:13:28', '2023-03-09 09:13:28', 5.1),
(67, '1538958169', 1, 2, 13, 10, 25.5, '04-04-2023', 51, '01:00 PM - 01:30 PM', 24, 'Paystack', 'success', 0, NULL, '2608214240', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-03-09 09:19:31', '2023-03-09 09:19:31', 8.5),
(68, '27615131', 1, 2, 11, 15, 29.6, '03-04-2023', 34, '01:00 PM - 01:30 PM', 22, 'Instamojo', 'success', 0, NULL, 'MOJO3309T05A25405055', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"One Ton AC\",\"Two Ton AC\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\",\"Washroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":12}]', '{\"name\":\"John Doe\",\"email\":\"agent@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-03-09 09:24:22', '2023-03-09 09:24:22', 7.4),
(69, '704544966', 1, 2, 14, 10, 8.5, '02-04-2023', 17, '01:00 PM - 01:30 PM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3309Q05A25405056', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"TV Wall Mount Installation\",\"LCD\\/LED TV Repair Services\",\"TV Full Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2023-03-09 09:27:37', '2023-03-09 09:27:37', 1.5),
(70, '644899810', 1, 2, 13, 10, 28.9, '04-04-2023', 52, '01:30 PM - 02:00 PM', 24, 'Bank Payment', 'pending', 0, NULL, 'TNX_3343KJDFDFR334', 'order_decliened_by_provider', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":12},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":9},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":3}]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"125-985-4587\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5841\",\"order_note\":null}', NULL, NULL, '2023-03-09 09:31:14', '2023-05-09 14:01:12', 5.1),
(71, '1621406777', 1, 2, 9, 24, 24, '10-05-2023', 60, '10:20 AM - 10:40 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'Gwww', 'approved_by_provider', NULL, NULL, NULL, '[\"Car Wash\",\"Car inner Dry Wash\",\"Adance Data analysis operation\",\"Washroom Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"AAA\",\"email\":\"ssss\",\"phone\":\"1222\",\"address\":\"gffg\",\"post_code\":\"2323\",\"order_note\":\"ggg\"}', 'ggg', NULL, '2023-05-07 14:40:02', '2023-05-09 14:01:05', 0),
(72, '829761235', 1, 2, 11, 15, 15, '10-05-2023', 61, '10:40 AM - 11:00 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'gfgfgfgfg', 'approved_by_provider', NULL, NULL, NULL, '[\"One Ton AC\",\"Two Ton AC\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\",\"Washroom Cleaning\"]', '[]', '{\"name\":\"gg\",\"email\":\"rrr\",\"phone\":\"333\",\"address\":\"gfg\",\"post_code\":\"12\",\"order_note\":\"ffff\"}', 'ffff', NULL, '2023-05-08 14:43:47', '2023-05-09 14:00:54', 0),
(73, '424793616', 1, 4, 20, 15, 15, '10-05-2023', 146, '10:40 AM - 11:00 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'Helll', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"aaa\",\"email\":\"sss\",\"phone\":\"333\",\"address\":\"ddd\",\"post_code\":\"222\",\"order_note\":\"fdfdf\"}', 'fdfdf', NULL, '2023-05-08 15:20:27', '2023-05-08 15:20:27', 0),
(74, '1634536198', 1, 4, 15, 28, 43, '18-05-2023', 161, '10:00 AM - 10:20 AM', 15, 'Paystack', 'success', 0, NULL, '2810442959', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10},{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":5}]', '{\"name\":\"John\",\"email\":\"user@gmail.com\",\"phone\":\"01624188877\",\"address\":\"Dhaka,bangladesh\",\"post_code\":\"1229\",\"order_note\":\"this is note\"}', 'this is note', NULL, '2023-05-17 21:25:57', '2023-05-17 21:25:57', 0),
(75, '1357701447', 1, 4, 15, 28, 28, '22-05-2023', 111, '10:20 AM - 10:40 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'ggg', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"AA\",\"email\":\"aaa\",\"phone\":\"222\",\"address\":\"fsdf\",\"post_code\":\"233\",\"order_note\":\"ffdf\"}', 'ffdf', NULL, '2023-05-21 15:04:37', '2023-05-21 15:04:37', 0),
(76, '329133942', 1, 2, 4, 60, 60, '22-05-2023', 26, '10:20 AM - 10:40 AM', 0, 'Paystack', 'success', 0, NULL, '2819412217', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Car Cleaning\",\"Car Washing\",\"Quality Service\",\"Timely Work\",\"Sofa And Divain Cleaning\"]', '[]', '{\"name\":\"AAA\",\"email\":\"AAA\",\"phone\":\"234\",\"address\":\"God\",\"post_code\":\"12\",\"order_note\":\"God\"}', 'God', NULL, '2023-05-21 15:31:20', '2023-05-21 15:31:20', 0),
(77, '598640991', 1, 2, 4, 60, 60, '23-05-2023', 45, '11:00 AM - 11:20 AM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3521K05A41658452', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Car Cleaning\",\"Car Washing\",\"Quality Service\",\"Timely Work\",\"Sofa And Divain Cleaning\"]', '[]', '{\"name\":\"Khan\",\"email\":\"khan@gmail.com\",\"phone\":\"1234567890\",\"address\":\"Dhaka\",\"post_code\":\"1229\",\"order_note\":\"Hello\"}', 'Hello', NULL, '2023-05-21 15:41:25', '2023-05-21 15:41:25', 0),
(78, '1131384133', 1, 4, 15, 28, 28, '22-05-2023', 116, '12:00 PM - 12:20 PM', 0, 'Razorpay', 'success', 0, NULL, '4340844', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"Khan\",\"email\":\"khan@gmail.com\",\"phone\":\"1234567890\",\"address\":\"Dhaka\",\"post_code\":\"1229\",\"order_note\":\"Hello\"}', 'Hello', NULL, '2023-05-21 15:56:59', '2023-05-21 15:56:59', 0),
(79, '121377997', 25, 4, 17, 50, 71, '22-05-2023', 115, '11:40 AM - 12:00 PM', 21, 'Paystack', 'success', 0, NULL, '2819485185', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":5},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":6},{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10}]', '{\"name\":\"AA\",\"email\":\"AA\",\"phone\":\"2222\",\"address\":\"dfdf\",\"post_code\":\"333\",\"order_note\":\"dfdfd\"}', 'dfdfd', NULL, '2023-05-21 16:08:48', '2023-05-21 16:08:48', 0),
(80, '304108489', 1, 2, 7, 12, 12, '22-05-2023', 25, '10:00 AM - 10:20 AM', 0, 'Stripe', 'success', 0, NULL, 'txn_3NA6VQF56Pb8BOOX0zY6Y0Ok', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Wall Painting 12x12\",\"Timely Work\",\"Quality Service\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"AA\",\"email\":\"AA\",\"phone\":\"1223\",\"address\":\"Dgaaa\",\"post_code\":\"1234\",\"order_note\":\"ssss\"}', 'ssss', NULL, '2023-05-21 17:16:41', '2023-05-21 17:16:41', 0),
(81, '1463836652', 26, 2, 8, 12, 12, '22-05-2023', 24, '09:40 AM - 10:00 AM', 0, 'Stripe', 'success', 0, NULL, 'txn_3NA8SSF56Pb8BOOX0YJpfCRH', 'complete', NULL, NULL, NULL, '[\"Fridge\",\"TV\",\"Single Bed\",\"Double Bed\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"AAAa\",\"email\":\"eeee\",\"phone\":\"3444\",\"address\":\"DHS\",\"post_code\":\"1222\",\"order_note\":\"ffdfdff\"}', 'ffdfdff', 'Yes', '2023-05-21 19:21:45', '2023-05-21 19:44:27', 0),
(82, '1603071386', 26, 4, 15, 28, 28, '22-05-2023', 117, '12:20 PM - 12:40 PM', 0, 'Razorpay', 'success', 0, NULL, '4341120', 'approved_by_provider', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"AAAa\",\"email\":\"eeee\",\"phone\":\"3444\",\"address\":\"DHS\",\"post_code\":\"1222\",\"order_note\":\"ffdfdff\"}', 'ffdfdff', NULL, '2023-05-21 19:24:47', '2023-05-21 19:45:23', 0),
(84, '1342003220', 26, 2, 1, 50, 50, '22-05-2023', 32, '12:20 PM - 12:40 PM', 0, 'Paystack', 'success', 0, NULL, '2820023498', 'order_decliened_by_provider', NULL, NULL, NULL, '[\"Floor And Carpet Cleaning\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"name\",\"email\":\"user@gmail.com\",\"phone\":\"01421546789\",\"address\":\"Dhaka\",\"post_code\":\"1234\",\"order_note\":\"Hello\"}', 'Hello', NULL, '2023-05-21 19:35:07', '2023-05-21 19:44:11', 0),
(85, '1197349967', 26, 2, 7, 12, 12, '23-05-2023', 46, '11:20 AM - 11:40 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'Dhaka Bangladesh', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Wall Painting 12x12\",\"Timely Work\",\"Quality Service\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"name\",\"email\":\"user@gmail.com\",\"phone\":\"01421546789\",\"address\":\"Dhaka\",\"post_code\":\"1234\",\"order_note\":\"Hello\"}', 'Hello', NULL, '2023-05-21 19:36:05', '2023-05-21 19:36:05', 0),
(86, '7966618', 26, 2, 4, 60, 93, '25-05-2023', 78, '10:40 AM - 11:00 AM', 33, 'Mollie', 'success', 0, NULL, 'tr_CMfM77dA84', 'approved_by_provider', NULL, NULL, NULL, '[\"Car Cleaning\",\"Car Washing\",\"Quality Service\",\"Timely Work\",\"Sofa And Divain Cleaning\"]', '[{\"service_name\":\"Service Two\",\"qty\":\"1\",\"price\":20},{\"service_name\":\"Service Three\",\"qty\":\"1\",\"price\":13}]', '{\"name\":\"name\",\"email\":\"user@gmail.com\",\"phone\":\"01421546789\",\"address\":\"Dhaka\",\"post_code\":\"1234\",\"order_note\":\"Hello\"}', 'Hello', NULL, '2023-05-21 19:41:05', '2023-05-21 19:44:04', 0),
(87, '1565221691', 26, 2, 6, 45, 57, '23-05-2023', 49, '12:20 PM - 12:40 PM', 12, 'Paystack', 'success', 0, NULL, '2820103717', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Weeding soft layer makeup\",\"Hair Bonding\",\"Company Profile Build\",\"Adance Data analysis operation.\",\"Floor And Carpet Cleaning\"]', '[{\"service_name\":\"Extra service one\",\"qty\":\"1\",\"price\":7},{\"service_name\":\"Extra service two\",\"qty\":\"1\",\"price\":5}]', '{\"name\":\"AA\",\"email\":\"aaa\",\"phone\":\"123\",\"address\":\"user@gmail.com\",\"post_code\":\"334\",\"order_note\":\"gg\"}', 'gg', NULL, '2023-05-21 20:01:46', '2023-05-21 20:01:46', 0),
(88, '1624269203', 1, 4, 15, 28, 28, '23-05-2023', 0, NULL, 0, 'Paypal', 'success', 0, NULL, 'PAYID-MRVP6UY70X311051H014931B', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"ff\",\"email\":\"ff\",\"phone\":\"777\",\"address\":\"jj\",\"post_code\":\"6\",\"order_note\":\"jj\"}', 'jj', NULL, '2023-05-22 15:37:27', '2023-05-22 15:37:27', 0),
(89, '1083776777', 1, 4, 20, 15, 15, '23-05-2023', 128, '10:20 AM - 10:40 AM', 0, 'Paystack', 'success', 0, NULL, '2822394137', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"gg\",\"email\":\"ggg\",\"phone\":\"gg\",\"address\":\"ggg\",\"post_code\":\"gg\",\"order_note\":\"ggg\"}', 'ggg', NULL, '2023-05-22 16:57:59', '2023-05-22 16:57:59', 0);
INSERT INTO `orders` (`id`, `order_id`, `client_id`, `provider_id`, `service_id`, `package_amount`, `total_amount`, `booking_date`, `appointment_schedule_id`, `schedule_time_slot`, `additional_amount`, `payment_method`, `payment_status`, `refound_status`, `payment_refound_date`, `transection_id`, `order_status`, `order_approval_date`, `order_completed_date`, `order_declined_date`, `package_features`, `additional_services`, `client_address`, `order_note`, `complete_by_admin`, `created_at`, `updated_at`, `coupon_discount`) VALUES
(90, '926673958', 1, 4, 15, 28, 28, '23-05-2023', 132, '11:40 AM - 12:00 PM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3522Q05A10544955', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"ss\",\"email\":\"ss\",\"phone\":\"11\",\"address\":\"ddd\",\"post_code\":\"222\",\"order_note\":\"ddd\"}', 'ddd', NULL, '2023-05-22 17:34:55', '2023-05-22 17:34:55', 0),
(91, '1323062727', 16, 4, 15, 28, 28, '23-05-2023', 131, '11:20 AM - 11:40 AM', 0, 'Paystack', 'success', 0, NULL, '2822600280', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John\",\"email\":\"mapajiy811@jobbrett.com\",\"phone\":\"01512367589\",\"address\":\"dhaka\",\"post_code\":\"1229\",\"order_note\":\"good\"}', 'good', NULL, '2023-05-22 18:18:34', '2023-05-22 18:18:34', 0),
(92, '221807380', 16, 2, 8, 12, 12, '23-05-2023', 48, '12:00 PM - 12:20 PM', 0, 'Bank Payment', 'pending', 0, NULL, 'dhaka', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Fridge\",\"TV\",\"Single Bed\",\"Double Bed\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"hh\",\"email\":\"hh\",\"phone\":\"hh\",\"address\":\"hh\",\"post_code\":\"hh\",\"order_note\":\"hhh\"}', 'hhh', NULL, '2023-05-22 18:36:14', '2023-05-22 18:36:14', 0),
(93, '1151128522', 1, 4, 17, 50, 50, '23-05-2023', 130, '11:00 AM - 11:20 AM', 0, 'Razorpay', 'success', 0, NULL, 'pay_LshB0ayn7AfAOt', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"Nayeem\",\"email\":\"nayeem@gmail.com\",\"phone\":\"01712312312\",\"address\":\"Sylhet\",\"post_code\":\"1234\",\"order_note\":\"this is order\"}', 'this is order', NULL, '2023-05-22 21:40:49', '2023-05-22 21:40:49', 0),
(94, '540340395', 1, 4, 17, 50, 50, '24-05-2023', 143, '09:40 AM - 10:00 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'Dhaka bank', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Duo\",\"email\":\"email@email.com\",\"phone\":\"01512387690\",\"address\":\"Dhaka\",\"post_code\":\"1229\",\"order_note\":\"good\"}', 'good', NULL, '2023-05-23 14:50:20', '2023-05-23 14:50:20', 0),
(95, '827190188', 27, 4, 17, 50, 50, '23-05-2023', 126, '09:40 AM - 10:00 AM', 0, 'Bank Payment', 'pending', 0, NULL, 'Dhaka bank', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Duo\",\"email\":\"email@email.com\",\"phone\":\"01512387690\",\"address\":\"Dhaka\",\"post_code\":\"1229\",\"order_note\":\"good\"}', 'good', NULL, '2023-05-23 14:58:52', '2023-05-23 14:58:52', 0),
(96, '454335279', 27, 4, 15, 28, 28, '23-05-2023', 127, '10:00 AM - 10:20 AM', 0, 'Paystack', 'success', 0, NULL, '2824331081', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John\",\"email\":\"email@email.com\",\"phone\":\"01312345678\",\"address\":\"Dhaka\",\"post_code\":\"1228\",\"order_note\":\"better\"}', 'better', NULL, '2023-05-23 15:01:53', '2023-05-23 15:01:53', 0),
(97, '1450740049', 27, 4, 20, 15, 15, '23-05-2023', 129, '10:40 AM - 11:00 AM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3523Q05A35123286', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"herry\",\"email\":\"kadise2954@mevori.com\",\"phone\":\"0151236789\",\"address\":\"dhaka\",\"post_code\":\"1226\",\"order_note\":\"good\"}', 'good', NULL, '2023-05-23 15:26:40', '2023-05-23 15:26:40', 0),
(98, '1522262747', 27, 2, 8, 12, 12, '23-05-2023', 43, '10:20 AM - 10:40 AM', 0, 'Razorpay', 'success', 0, NULL, 'pay_LszSVzmN3r3bpE', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Fridge\",\"TV\",\"Single Bed\",\"Double Bed\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"harry\",\"email\":\"kadise2954@mevori.com\",\"phone\":\"01612356789\",\"address\":\"dhaka\",\"post_code\":\"1223\",\"order_note\":\"better\"}', 'better', NULL, '2023-05-23 15:33:52', '2023-05-23 15:33:52', 0),
(99, '939129536', 27, 4, 15, 28, 28, '23-05-2023', 125, '09:20 AM - 09:40 AM', 0, 'Razorpay', 'success', 0, NULL, '4344233', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"hh\",\"email\":\"ggg\",\"phone\":\"777\",\"address\":\"ddd\",\"post_code\":\"888\",\"order_note\":\"aaa\"}', 'aaa', NULL, '2023-05-23 15:43:37', '2023-05-23 15:43:37', 0),
(100, '186096026', 27, 4, 15, 28, 28, '24-05-2023', 141, '09:00 AM - 09:20 AM', 0, 'Mollie', 'success', 0, NULL, 'tr_zNqoKumBBZ', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"hh\",\"email\":\"ggg\",\"phone\":\"777\",\"address\":\"ddd\",\"post_code\":\"888\",\"order_note\":\"aaa\"}', 'aaa', NULL, '2023-05-23 15:47:23', '2023-05-23 15:47:23', 0),
(101, '40521668', 27, 4, 20, 15, 15, '23-05-2023', 123, '08:40 AM - 09:00 AM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3523605A35123307', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"hh\",\"email\":\"ggg\",\"phone\":\"777\",\"address\":\"ddd\",\"post_code\":\"888\",\"order_note\":\"aaa\"}', 'aaa', NULL, '2023-05-23 15:48:59', '2023-05-23 15:48:59', 0),
(102, '1181014833', 27, 4, 17, 50, 50, '23-05-2023', 121, '08:00 AM - 08:20 AM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3523L05A35123321', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"Harry\",\"email\":\"kadise2954@mevori.com\",\"phone\":\"01710345678\",\"address\":\"dhaka\",\"post_code\":\"1222\",\"order_note\":\"better\"}', 'better', NULL, '2023-05-23 16:04:04', '2023-05-23 16:04:04', 0),
(103, '1559393812', 27, 4, 17, 50, 50, '23-05-2023', 122, '08:20 AM - 08:40 AM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3523L05A35123341', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"ddd\",\"email\":\"dd\",\"phone\":\"dd\",\"address\":\"dd\",\"post_code\":\"dd\",\"order_note\":\"ddd\"}', 'ddd', NULL, '2023-05-23 16:19:22', '2023-05-23 16:19:22', 0),
(104, '233451666', 27, 4, 17, 50, 50, '24-05-2023', 138, '08:00 AM - 08:20 AM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3523005A35123345', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"ddd\",\"email\":\"dd\",\"phone\":\"dd\",\"address\":\"dd\",\"post_code\":\"dd\",\"order_note\":\"ddd\"}', 'ddd', NULL, '2023-05-23 16:21:59', '2023-05-23 16:21:59', 0),
(105, '1646366294', 27, 4, 17, 50, 50, '24-05-2023', 154, '01:30 PM - 02:00 PM', 0, 'Paystack', 'success', 0, NULL, '2824479463', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"ff\",\"email\":\"fff343\",\"phone\":\"2323\",\"address\":\"gfg\",\"post_code\":\"323\",\"order_note\":\"gfgfgfg\"}', 'gfgfgfg', NULL, '2023-05-23 16:25:02', '2023-05-23 16:25:02', 0),
(106, '1041552153', 1, 2, 13, 10, 10, '22-06-2023', 0, NULL, 0, 'Paypal', 'success', 0, NULL, 'PAYID-MSJHXUI5RL10692B6656872B', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":\"5230\",\"order_note\":null}', NULL, NULL, '2023-06-20 15:26:22', '2023-06-20 15:26:22', 0),
(107, '1222980366', 1, 2, 13, 10, 10, '29-06-2023', 70, '08:00 AM - 08:20 AM', 0, 'Stripe', 'success', 0, NULL, 'txn_3NLPhcF56Pb8BOOX1wQSEiTk', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"Ibrahim Khalil\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-20 23:00:03', '2023-06-20 23:00:03', 0),
(108, '403927017', 1, 2, 13, 10, 10, '27-06-2023', 52, '01:30 PM - 02:00 PM', 0, 'Razorpay', 'success', 0, NULL, 'pay_M4pnjkY7U90lAu', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 14:55:04', '2023-06-21 14:55:04', 0),
(109, '1682321429', 1, 2, 13, 10, 10, '22-06-2023', 86, '01:30 PM - 02:00 PM', 0, 'Razorpay', 'success', 0, NULL, 'pay_M4psmO2wh4GMYq', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 14:59:51', '2023-06-21 14:59:51', 0),
(110, '1345938586', 1, 2, 13, 10, 10, '22-06-2023', 84, '12:40 PM - 01:00 PM', 0, 'Flutterwave', 'success', 0, NULL, '4412099', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 15:09:48', '2023-06-21 15:09:48', 0),
(111, '1650410155', 1, 2, 13, 10, 10, '22-06-2023', 78, '10:40 AM - 11:00 AM', 0, 'Mollie', 'success', 0, NULL, 'tr_5fnDk3CmwJ', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 15:24:55', '2023-06-21 15:24:55', 0),
(112, '868235883', 1, 2, 13, 10, 10, '06-07-2023', 70, '08:00 AM - 08:20 AM', 0, 'Paystack', 'success', 0, NULL, '2898481901', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 15:33:52', '2023-06-21 15:33:52', 0),
(113, '1032842173', 1, 2, 13, 10, 10, '28-06-2023', 69, '01:30 PM - 02:00 PM', 0, 'Instamojo', 'success', 0, NULL, 'MOJO3622605A97922358', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"California, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 15:45:05', '2023-06-21 15:45:05', 0),
(114, '1311387719', 1, 2, 14, 10, 10, '05-07-2023', 68, '01:00 PM - 01:30 PM', 0, 'Bank Payment', 'pending', 0, NULL, 'Branch: Your bank branch name', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"TV Wall Mount Installation\",\"LCD\\/LED TV Repair Services\",\"TV Full Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 15:54:10', '2023-06-21 15:54:10', 0),
(115, '773747918', 1, 2, 14, 10, 10, '22-06-2023', 71, '08:20 AM - 08:40 AM', 0, 'Handcash', 'success', 0, NULL, 'handcash_payment', 'approved_by_provider', NULL, NULL, NULL, '[\"TV Wall Mount Installation\",\"LCD\\/LED TV Repair Services\",\"TV Full Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":null,\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 16:16:46', '2023-06-21 22:31:01', 0),
(116, '109688293', 1, 2, 14, 10, 10, '22-06-2023', 0, NULL, 0, 'Paypal', 'success', 0, NULL, 'PAYID-MSJ6ZSA6DH09573KM020080U', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"TV Wall Mount Installation\",\"LCD\\/LED TV Repair Services\",\"TV Full Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\"]', '[]', '{\"name\":\"John Doe\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 17:40:49', '2023-06-21 17:40:49', 0),
(117, '572853571', 1, 2, 13, 10, 10, '22-06-2023', 83, '12:20 PM - 12:40 PM', 0, 'Stripe', 'success', 0, NULL, 'txn_3NLlojF56Pb8BOOX1GrwBGfn', 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"123-343-4444\",\"address\":\"Los Angeles, CA, USA\",\"post_code\":null,\"order_note\":null}', NULL, NULL, '2023-06-21 22:36:49', '2023-06-21 22:36:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `link`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://websolutionus.com/', 'uploads/custom-images/our-partner-2022-09-29-12-53-34-4755.jpg', 1, '2022-09-29 06:53:35', '2022-09-29 06:53:35'),
(2, 'https://websolutionus.com/service', 'uploads/custom-images/our-partner-2022-09-29-12-54-08-8857.jpg', 1, '2022-09-29 06:54:08', '2022-09-29 06:54:08'),
(3, 'https://codecanyon.net/user/websolutionus/portfolio', 'uploads/custom-images/our-partner-2022-09-29-12-54-34-2602.jpg', 1, '2022-09-29 06:54:34', '2022-09-29 06:54:34'),
(4, 'https://www.google.com/', 'uploads/custom-images/-2023-01-15-03-30-10-1839.png', 1, '2022-09-29 06:54:54', '2023-01-15 09:30:10'),
(5, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-08-6101.jpg', 1, '2022-09-29 06:55:08', '2022-09-29 06:55:08'),
(6, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-25-2540.jpg', 1, '2022-09-29 06:55:25', '2022-09-29 06:55:25'),
(7, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-42-2263.jpg', 1, '2022-09-29 06:55:42', '2022-09-29 06:55:42'),
(8, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-55-5814.jpg', 1, '2022-09-29 06:55:55', '2022-09-29 06:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_payments`
--

CREATE TABLE `paypal_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_mode` varchar(255) DEFAULT NULL,
  `client_id` text DEFAULT NULL,
  `secret_id` text DEFAULT NULL,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `currency_rate` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_payments`
--

INSERT INTO `paypal_payments` (`id`, `status`, `account_mode`, `client_id`, `secret_id`, `country_code`, `currency_code`, `currency_rate`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'sandbox', 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy', 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn', 'US', 'USD', 1, 'uploads/website-images/paypal-2022-09-25-10-04-36-1837.png', NULL, '2022-09-25 04:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `paystack_and_mollies`
--

CREATE TABLE `paystack_and_mollies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mollie_key` varchar(255) DEFAULT NULL,
  `mollie_status` int(11) NOT NULL DEFAULT 0,
  `mollie_currency_rate` double NOT NULL DEFAULT 1,
  `paystack_public_key` varchar(255) DEFAULT NULL,
  `paystack_secret_key` varchar(255) DEFAULT NULL,
  `paystack_currency_rate` double NOT NULL DEFAULT 1,
  `paystack_status` int(11) NOT NULL DEFAULT 0,
  `mollie_country_code` varchar(191) NOT NULL,
  `mollie_currency_code` varchar(191) NOT NULL,
  `paystack_country_code` varchar(191) NOT NULL,
  `paystack_currency_code` varchar(191) NOT NULL,
  `mollie_image` varchar(255) DEFAULT NULL,
  `paystack_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paystack_and_mollies`
--

INSERT INTO `paystack_and_mollies` (`id`, `mollie_key`, `mollie_status`, `mollie_currency_rate`, `paystack_public_key`, `paystack_secret_key`, `paystack_currency_rate`, `paystack_status`, `mollie_country_code`, `mollie_currency_code`, `paystack_country_code`, `paystack_currency_code`, `mollie_image`, `paystack_image`, `created_at`, `updated_at`) VALUES
(1, 'test_HFc5UhscNSGD5jujawhtNFs3wM3B4n', 1, 1.38, 'pk_test_057dfe5dee14eaf9c3b4573df1e3760c02c06e38', 'sk_test_77cb93329abbdc18104466e694c9f720a7d69c97', 460.49, 1, 'CA', 'CAD', 'NG', 'NGN', 'uploads/website-images/mollie-2022-09-25-10-05-09-3231.png', 'uploads/website-images/paystact-2022-09-25-10-05-19-6818.png', NULL, '2023-03-09 09:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popular_posts`
--

CREATE TABLE `popular_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popular_posts`
--

INSERT INTO `popular_posts` (`id`, `blog_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 1, '2022-09-29 05:49:56', '2022-09-29 05:49:56'),
(3, 7, 1, '2022-09-29 05:50:02', '2022-09-29 05:50:02'),
(4, 2, 1, '2022-09-29 05:50:33', '2022-09-29 05:50:33'),
(5, 1, 1, '2022-12-25 10:48:28', '2022-12-25 10:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `provider_bank_handcashes`
--

CREATE TABLE `provider_bank_handcashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `bank_status` int(11) NOT NULL DEFAULT 0,
  `bank_instruction` text DEFAULT NULL,
  `handcash_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_bank_handcashes`
--

INSERT INTO `provider_bank_handcashes` (`id`, `provider_id`, `bank_status`, `bank_instruction`, `handcash_status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Bank Name: Your bank name\r\nAccount Number:  Your bank account number\r\nRouting Number: Your bank routing number\r\nBranch: Your bank branch name', 1, '2023-06-19 22:39:17', '2023-06-21 17:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `provider_client_reports`
--

CREATE TABLE `provider_client_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `report_from` varchar(255) NOT NULL,
  `report_to` varchar(255) NOT NULL,
  `report` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_flutterwaves`
--

CREATE TABLE `provider_flutterwaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `public_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_flutterwaves`
--

INSERT INTO `provider_flutterwaves` (`id`, `provider_id`, `public_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'FLWPUBK_TEST-5760e3ff9888aa1ab5e5cd1ec3f99cb1-X', 'FLWSECK_TEST-81cb5da016d0a51f7329d4a8057e766d-X', 1, '2023-06-19 21:31:00', '2023-06-21 17:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `provider_instamojos`
--

CREATE TABLE `provider_instamojos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `api_key` text NOT NULL,
  `auth_token` text NOT NULL,
  `account_mode` varchar(255) NOT NULL DEFAULT 'Sandbox',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_instamojos`
--

INSERT INTO `provider_instamojos` (`id`, `provider_id`, `api_key`, `auth_token`, `account_mode`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'test_5f4a2c9a58ef216f8a1a688910f', 'test_994252ada69ce7b3d282b9941c2', 'Sandbox', 1, '2023-06-19 22:14:09', '2023-06-21 17:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `provider_mollies`
--

CREATE TABLE `provider_mollies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `mollie_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_mollies`
--

INSERT INTO `provider_mollies` (`id`, `provider_id`, `mollie_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'test_HFc5UhscNSGD5jujawhtNFs3wM3B4n', 1, '2023-06-19 21:45:32', '2023-06-21 17:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `provider_paypals`
--

CREATE TABLE `provider_paypals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_mode` varchar(255) NOT NULL DEFAULT 'sandbox',
  `client_id` text DEFAULT NULL,
  `secret_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_paypals`
--

INSERT INTO `provider_paypals` (`id`, `provider_id`, `status`, `account_mode`, `client_id`, `secret_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'live', 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy', 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn', '2023-06-19 21:00:47', '2023-06-21 17:17:02'),
(2, 1, 1, 'live', '109', 'yuiyuiyui', '2024-02-20 16:01:30', '2024-02-20 16:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `provider_paystacks`
--

CREATE TABLE `provider_paystacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `public_key` varchar(255) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_paystacks`
--

INSERT INTO `provider_paystacks` (`id`, `provider_id`, `public_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'pk_test_057dfe5dee14eaf9c3b4573df1e3760c02c06e38', 'sk_test_77cb93329abbdc18104466e694c9f720a7d69c97', 1, '2023-06-19 21:38:36', '2023-06-21 17:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `provider_razorpays`
--

CREATE TABLE `provider_razorpays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `key` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_razorpays`
--

INSERT INTO `provider_razorpays` (`id`, `provider_id`, `status`, `key`, `secret_key`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'rzp_test_K7CipNQYyyMPiS', 'zSBmNMorJrirOrnDrbOd1ALO', '2023-06-19 21:23:23', '2023-06-21 17:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `provider_stripes`
--

CREATE TABLE `provider_stripes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_stripes`
--

INSERT INTO `provider_stripes` (`id`, `provider_id`, `status`, `stripe_key`, `stripe_secret`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'pk_test_51JU61aF56Pb8BOOX5ucAe5DlDwAkCZyffqlKMDUWsAwhKbdtuY71VvIzr0NgFKjq4sOVVaaeeyVXXnNWwu5dKgeq00kMzCBUm5', 'sk_test_51JU61aF56Pb8BOOXlz7jGkzJsCkozuAoRlFJskYGsgunfaHLmcvKLubYRQLCQOuyYHq0mvjoBFLzV7d8F6q8f6Hv00CGwULEEV', '2023-06-19 21:11:24', '2023-06-21 17:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `provider_withdraws`
--

CREATE TABLE `provider_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `total_amount` double NOT NULL,
  `withdraw_amount` double NOT NULL,
  `withdraw_charge` double NOT NULL,
  `account_info` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_withdraws`
--

INSERT INTO `provider_withdraws` (`id`, `user_id`, `method`, `total_amount`, `withdraw_amount`, `withdraw_charge`, `account_info`, `status`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Bank Payment', 12, 11.88, 1, 'IBBL Uttara Branch,\r\nAccount : 4545315455...45541', 1, '2022-12-25', '2022-10-08 03:26:18', '2022-12-25 11:15:38'),
(2, 2, 'Bank Payment', 15, 14.85, 1, 'Bank Name:  IBBL\r\nAccount Number:  545455.....4587555\r\nBranch: Uttara, Dhaka', 0, NULL, '2022-12-26 04:56:10', '2022-12-26 04:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_histories`
--

CREATE TABLE `purchase_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `expiration` varchar(255) NOT NULL,
  `maximum_service` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_histories`
--

INSERT INTO `purchase_histories` (`id`, `provider_id`, `plan_id`, `plan_name`, `plan_price`, `expiration_date`, `expiration`, `maximum_service`, `status`, `payment_method`, `payment_status`, `transaction`, `created_at`, `updated_at`) VALUES
(7, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Stripe', 'success', 'txn_3NKgKBF56Pb8BOOX07GUDaAE', '2023-06-18 22:32:47', '2023-06-20 15:30:26'),
(8, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Stripe', 'success', 'txn_3NKgMDF56Pb8BOOX0fq2pz0x', '2023-06-18 22:34:53', '2023-06-20 15:30:26'),
(9, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Stripe', 'success', 'txn_3NKgxwF56Pb8BOOX0VRYYBUN', '2023-06-18 23:13:52', '2023-06-20 15:30:26'),
(10, 2, 3, 'Free', '0', '2023-07-19', 'monthly', '10', 'expired', 'Free', 'success', 'free_enroll', '2023-06-18 23:16:04', '2023-06-20 15:30:26'),
(11, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Razorpay', 'success', 'pay_M42afBDdl91bCo', '2023-06-19 14:46:43', '2023-06-20 15:30:26'),
(12, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Flutterwave', 'success', '4405934', '2023-06-19 14:56:14', '2023-06-20 15:30:26'),
(13, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Flutterwave', 'success', '4405936', '2023-06-19 14:57:14', '2023-06-20 15:30:26'),
(14, 2, 4, 'Gold', '49', 'lifetime', 'lifetime', '50', 'expired', 'Mollie', 'success', 'tr_DDtaMQkZJK', '2023-06-19 15:05:26', '2023-06-20 15:30:26'),
(15, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Instamojo', 'success', 'MOJO3620505A24248677', '2023-06-19 15:13:32', '2023-06-20 15:30:26'),
(16, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Bank Payment', 'success', 'IBBL Dhaka,\r\nTnx_DDJFD8789KJJK,\r\nAccount : 3839439434', '2023-06-19 15:26:45', '2023-06-20 15:30:26'),
(17, 2, 4, 'Gold', '49', 'lifetime', 'lifetime', '50', 'expired', 'Bank Payment', 'success', 'Name: IBBl\r\nAccount : 943934\r\nRouting : Dhaka', '2023-06-19 15:31:18', '2023-06-20 15:30:26'),
(18, 2, 2, 'Premium', '29', '2024-06-18', 'yearly', '20', 'expired', 'Paystack', 'success', '2893952526', '2023-06-19 15:59:21', '2023-06-20 15:30:26'),
(19, 2, 2, 'Premium', '29', '2024-06-19', 'yearly', '20', 'active', 'Paypal', 'success', 'ZUJKUEUDELUGE', '2023-06-20 15:30:26', '2023-06-20 15:30:26'),
(20, 1, 2, 'Premium', '29', '2025-02-19', 'yearly', '20', 'expired', 'Bank Payment', 'success', 'fghfhfghfg', '2024-02-20 15:59:43', '2024-07-09 19:46:44'),
(21, 28, 2, 'Premium', '29', '2025-02-20', 'yearly', '20', 'active', 'Bank Payment', 'success', 'demo pay', '2024-02-21 16:36:10', '2024-02-21 16:39:37'),
(22, 1, 3, 'Free', '0', '2024-08-09', 'monthly', '10', 'active', 'Free', 'success', 'free_enroll', '2024-07-09 19:46:44', '2024-07-09 19:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `pusher_credentails`
--

CREATE TABLE `pusher_credentails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `app_key` varchar(255) NOT NULL,
  `app_secret` varchar(255) NOT NULL,
  `app_cluster` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pusher_credentails`
--

INSERT INTO `pusher_credentails` (`id`, `app_id`, `app_key`, `app_secret`, `app_cluster`, `created_at`, `updated_at`) VALUES
(1, '1338069', 'e013174602072a186b1d', '46de951521010c14b205', 'mt1', NULL, '2022-01-29 12:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_payments`
--

CREATE TABLE `razorpay_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `key` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `razorpay_payments`
--

INSERT INTO `razorpay_payments` (`id`, `status`, `name`, `currency_rate`, `country_code`, `currency_code`, `description`, `image`, `color`, `key`, `secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ecommerce', 74.66, 'IN', 'INR', 'This is description', 'uploads/website-images/razorpay-2022-09-25-09-45-59-6378.png', '#2d15e5', 'rzp_test_K7CipNQYyyMPiS', 'zSBmNMorJrirOrnDrbOd1ALO', NULL, '2022-09-25 03:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

CREATE TABLE `refund_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `account_information` text DEFAULT NULL,
  `resone` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'awaiting_for_admin_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refund_requests`
--

INSERT INTO `refund_requests` (`id`, `client_id`, `order_id`, `account_information`, `resone`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'IBBL AAA Branch\r\nAccount Number : 32145221112', 'this is test resone', 'awaiting_for_admin_approval', '2022-10-04 09:54:02', '2022-10-04 09:54:02'),
(2, 1, 5, 'this is my bank account number.', 'this is test resone', 'awaiting_for_admin_approval', '2022-10-04 10:17:51', '2022-10-04 10:17:51'),
(3, 1, 6, 'this is my bank information.', 'this is test resone', 'awaiting_for_admin_approval', '2022-11-09 05:49:24', '2022-11-09 05:49:24'),
(4, 1, 10, 'this is my account information\r\nIBBL USA, Account : 9485998434.....9895453', 'This is test resone', 'awaiting_for_admin_approval', '2022-12-21 03:47:22', '2022-12-21 03:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `service_id`, `user_id`, `provider_id`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 1, 2, 'Lorem ipsum dolor sit amet, nibh saperet te pri, at nam diceret disputationi. Quo an consul impedit, usu possim evertitur dissentiet ei, ridens minimum nominavi et vix.', 5, 1, '2022-10-03 11:22:13', '2022-10-03 11:22:36'),
(2, 12, 1, 2, 'There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour.', 5, 1, '2022-10-04 10:29:20', '2022-10-04 10:29:48'),
(3, 15, 1, 4, 'There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form', 5, 1, '2023-01-14 04:55:14', '2023-01-14 04:55:38'),
(4, 15, 1, 4, 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.', 5, 1, '2023-01-14 05:07:38', '2023-01-14 05:07:53'),
(8, 15, 1, 4, 'Hello', 3, 0, '2023-05-17 21:27:00', '2023-05-17 21:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `serial_of_day` int(11) NOT NULL,
  `start` varchar(255) DEFAULT NULL,
  `end` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `provider_id`, `day`, `serial_of_day`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(43, 2, 'Sunday', 0, '10:00', '18:00', 1, '2022-10-05 10:32:35', '2022-10-05 10:32:35'),
(44, 2, 'Monday', 1, '09:00', '19:00', 1, '2022-10-05 10:32:35', '2022-11-10 03:58:00'),
(45, 2, 'Tuesday', 2, '10:30', '18:00', 1, '2022-10-05 10:32:35', '2022-11-10 03:58:00'),
(46, 2, 'Wednesday', 3, '08:00', '20:00', 1, '2022-10-05 10:32:35', '2022-11-10 03:58:00'),
(47, 2, 'Thursday', 4, '09:30', '19:30', 1, '2022-10-05 10:32:35', '2022-11-10 03:58:00'),
(48, 2, 'Friday', 5, '10:00', '18:30', 0, '2022-10-05 10:32:35', '2022-11-10 03:58:00'),
(49, 2, 'Saturday', 6, '11:00', '18:00', 0, '2022-10-05 10:32:35', '2022-11-10 03:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `section_contents`
--

CREATE TABLE `section_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_contents`
--

INSERT INTO `section_contents` (`id`, `section_name`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Category', 'Our Categories', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', NULL, '2023-01-15 04:23:04'),
(2, 'Featured Service', 'Featured Services', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', NULL, '2022-11-06 07:11:42'),
(3, 'Popular Service', 'Popular Services', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', NULL, '2022-11-06 07:11:48'),
(4, 'Testimonial', 'Testimonial', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', NULL, '2022-11-06 07:11:56'),
(5, 'Latest News', 'Latest News', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', NULL, '2022-11-06 07:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `section_controls`
--

CREATE TABLE `section_controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_controls`
--

INSERT INTO `section_controls` (`id`, `page_name`, `section_name`, `status`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'home1', 'Intro(Home1, Home2, Home3)', 1, 0, NULL, '2022-09-27 07:34:04'),
(2, 'home1', 'Category (Home1, Home2, Home3)', 1, 9, NULL, '2022-09-29 07:30:29'),
(3, 'home1', 'Featured Services (Home1, Home2, Home3)', 1, 6, NULL, '2022-10-03 10:20:38'),
(4, 'home1', 'Countdown (Home1, Home2, Home3)', 1, 4, NULL, '2022-09-29 06:42:30'),
(5, 'home1', 'Popular Service (Home1, Home2, Home3)', 1, 6, NULL, '2022-10-03 10:21:35'),
(6, 'home1', 'Join as a provider (Home1, Home2, Home3)', 1, 0, NULL, '2022-09-27 08:08:01'),
(7, 'home1', 'Mobile app (Home1, Home2, Home3)', 1, 0, NULL, '2022-09-27 08:11:30'),
(8, 'home1', 'Testimonial (Home1, Home2, Home3)', 1, 6, NULL, '2022-09-29 06:47:03'),
(9, 'home1', 'Blog (Home1, Home2, Home3)', 1, 3, NULL, '2022-12-21 03:06:41'),
(10, 'home1', 'Subscribe Now (Home1, Home2, Home3)', 1, 0, NULL, NULL),
(21, 'home2', 'Contact Us(Home2)', 1, 0, NULL, '2022-09-27 09:07:40'),
(22, 'home2', 'Our Partner(Home2, Home3)', 1, 20, NULL, '2022-09-29 06:56:54'),
(33, 'home3', 'How it work (Home3)', 1, 0, NULL, NULL),
(35, 'about', 'How it work(About)', 1, 0, NULL, '2022-09-27 09:19:53'),
(36, 'about', 'About Us (About)', 1, 0, NULL, '2022-09-27 09:19:53'),
(37, 'about', 'Countdown (About)', 1, 4, NULL, '2022-09-29 06:42:30'),
(38, 'about', 'Why choose us (About)', 1, 0, NULL, '2022-09-27 09:25:25'),
(39, 'about', 'Join as provider (About)', 0, 0, NULL, '2022-09-27 09:30:26'),
(40, 'about', 'Testimonial (About)', 1, 6, NULL, '2022-09-29 06:47:04'),
(41, 'service', 'Our Partner(Service)', 1, 20, NULL, '2022-09-29 06:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'Home page - Service', 'Home Page', NULL, '2022-09-27 10:11:58'),
(2, 'About Us', 'About Us - Service', 'About Us', NULL, '2022-09-27 10:12:02'),
(3, 'Contact Us', 'Contact Us - Service', 'Contact Us', NULL, '2022-09-27 10:12:07'),
(5, 'Service', 'Our Service - Service', 'Our Service', NULL, '2022-09-27 10:19:48'),
(6, 'Blog', 'Blog - Service', 'Blog', NULL, '2022-09-27 10:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `provider_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `make_featured` tinyint(4) NOT NULL DEFAULT 0,
  `featured_expired_date` varchar(255) DEFAULT NULL,
  `make_popular` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_banned` tinyint(4) NOT NULL DEFAULT 0,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `what_you_will_provide` longtext DEFAULT NULL,
  `benifit` longtext DEFAULT NULL,
  `package_features` longtext DEFAULT NULL,
  `approve_by_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `location_id`, `provider_id`, `name`, `slug`, `price`, `image`, `details`, `make_featured`, `featured_expired_date`, `make_popular`, `status`, `is_banned`, `seo_title`, `seo_description`, `what_you_will_provide`, `benifit`, `package_features`, `approve_by_admin`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 2, 'Commercial And Home cleaning crew ladies working as our team', 'commercial-cleaning-crew-ladies-working-as-team', 50, 'uploads/custom-images/Service-2022-10-03-02-49-36-7030.jpg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Commercial cleaning crew ladies working as team', 'Commercial cleaning crew ladies working as team', '[\"Page Load (time, size, number of requests).\",\"Advance Data analysis operation.\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Timely Worked\",\"Work Guarantee\",\"Professional Work\"]', '[\"Floor And Carpet Cleaning\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 08:49:36', '2022-11-06 07:49:13'),
(2, 6, NULL, 2, 'AC conditioner technician checks the operation and best servicing', 'ac-conditioner-technician-checks-the-operation', 40, 'uploads/custom-images/Service-2022-10-03-02-55-22-8862.jpg', '<p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.<br></p>', 1, NULL, 0, 1, 0, 'AC conditioner technician checks the operation', 'AC conditioner technician checks the operation', '[\"Laravel Website Development\",\"Mobile Application Development\",\"WordPress Theme Development\",\"Software Development\",\"Custom Website Development\"]', '[\"Search Engine Marketing (SEM)\",\"Social Media Marketing (SMM)\",\"Digital Marketing\",\"Search Engine Optimization (SEO)\"]', '[\"Floor And Carpet Cleaning\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 08:55:22', '2022-11-06 07:48:43'),
(3, 4, NULL, 2, 'Your Home and Office Electrician engineer work tester measuring', 'electrician-engineer-work-tester-measuring', 32, 'uploads/custom-images/Service-2022-10-03-03-17-30-3814.jpg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Electrician engineer work tester measuring', 'Electrician engineer work tester measuring', '[\"Digital Merketing\",\"Company Profile Build\",\"Business Growing\",\"How to Profit\"]', '[\"Timely Worked\",\"Professional Work\",\"Work Gurenty\",\"Hair Cutting Girls\"]', '[\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"How to Profit\"]', 1, '2022-10-03 09:17:30', '2022-11-06 09:53:40'),
(4, 5, NULL, 2, 'Car Washing And Cleaning Service At Home or Office With Our Team', 'car-washing-and-cleaning-service-at-home-or-office', 60, 'uploads/custom-images/Service-2022-10-03-03-24-47-2750.jpg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Car Washing And Cleaning Service At Home or Office', 'Car Washing And Cleaning Service At Home or Office', '[\"Quality Service\",\"Timely Work\",\"Service Gurantee\",\"Sofa And Divain Cleaning\",\"Hair Cutting Girls\"]', '[\"Car Cleaning\",\"Car Washing\",\"Sofa And Divain Cleaning\",\"Hair Cutting Girls\"]', '[\"Car Cleaning\",\"Car Washing\",\"Quality Service\",\"Timely Work\",\"Sofa And Divain Cleaning\"]', 1, '2022-10-03 09:24:47', '2022-11-06 09:52:41'),
(5, 3, NULL, 2, 'AC And Your Fridge Repair Service By Expert AC Repair Machenic', 'ac-repair-service-by-expert-ac-repair-machenic', 30, 'uploads/custom-images/Service-2022-10-03-03-28-39-9275.jpg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'AC Repair Service By Expert AC Repair Machenic', 'AC Repair Service By Expert AC Repair Machenic', '[\"AC Change\",\"Ac Repair\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"Service Gurantee\",\"Quality Service\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"AC Change\",\"Ac Repair\",\"Service Gurantee\",\"Quality Service\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 09:28:39', '2022-11-06 09:51:32'),
(6, 4, NULL, 2, 'Women Beauty Care Service and Massage with Expert Beautisian', 'women-beauty-care-service-with-expert-beautisian', 45, 'uploads/custom-images/Service-2022-10-03-03-34-32-2940.jpg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Women Beauty Care Service with Expert Beautisian', 'Women Beauty Care Service with Expert Beautisian', '[\"Weeding soft layer makeup\",\"Hair Bonding\",\"Adance Data analysis operation.\",\"Company Profile Build\",\"Floor And Carpet Cleaning\"]', '[\"High Quality Products\",\"Quality Service\",\"Home Service Available\",\"Adance Data analysis operation.\",\"Floor And Carpet Cleaning\"]', '[\"Weeding soft layer makeup\",\"Hair Bonding\",\"Company Profile Build\",\"Adance Data analysis operation.\",\"Floor And Carpet Cleaning\"]', 1, '2022-10-03 09:34:32', '2022-11-06 09:47:43'),
(7, 1, NULL, 2, 'Our Cool Painting Service Only For You and Your Colorfull Home', 'our-cool-painting-service-only-for-you', 12, 'uploads/custom-images/Service-2022-10-03-03-43-20-7046.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Our Cool Painting Service Only For You', 'Our Cool Painting Service Only For You', '[\"Service Guaranty\",\"Quality Service\",\"Timely Work\",\"Chair And Table Cleaning\",\"Kitchenroom Cleaning\"]', '[\"Chair And Table Cleaning\",\"Kitchenroom Cleaning\",\"Page Load (time, size, number of requests).\",\"Company Profile Build\"]', '[\"Wall Painting 12x12\",\"Timely Work\",\"Quality Service\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 09:43:20', '2022-11-06 09:46:01'),
(8, 4, NULL, 2, 'Home Move Service From One City to Another City With Our Team', 'home-move-service-from-one-city-to-another-city', 12, 'uploads/custom-images/Service-2022-10-03-03-46-32-3041.jpg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.</p>', 0, NULL, 1, 1, 0, 'Home Move Service From One City to Another City', 'Home Move Service From One City to Another City', '[\"Double Bed\",\"Single Bed\",\"Washroom Cleaning\",\"Adance Data analysis operation.\",\"Kitchenroom Cleaning\"]', '[\"Timely Work\",\"Quality Service\",\"Service Guaranty\",\"Washroom Cleaning\",\"Adance Data analysis operation.\"]', '[\"Fridge\",\"TV\",\"Single Bed\",\"Double Bed\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 09:46:32', '2022-11-06 09:36:53'),
(9, 5, NULL, 2, 'Car Cleaning Service From Best Cleaner For Commercial cleaning', 'car-cleaning-service-from-best-cleaner', 24, 'uploads/custom-images/Service-2022-10-03-03-54-30-9825.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Car Cleaning Service From Best Cleaner', 'Car Cleaning Service From Best Cleaner', '[\"Adance Data analysis operation\",\"Washroom Cleaning\",\"Chair And Table Cleaning\",\"Hair Cutting Boys\"]', '[\"Service Guaranty\",\"Quality Service\",\"Timely Work\",\"Adance Data analysis operation\"]', '[\"Car Wash\",\"Car inner Dry Wash\",\"Adance Data analysis operation\",\"Washroom Cleaning\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 09:54:30', '2022-11-06 09:34:46'),
(10, 4, NULL, 2, 'Hair Cutting Service At Reasonable Price For Handsome People', 'hair-cutting-service-at-reasonable-price', 8, 'uploads/custom-images/Service-2022-10-03-04-03-43-3928.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Hair Cutting Service At Reasonable Price', 'Hair Cutting Service At Reasonable Price', '[\"Quality Service\",\"Coffee Offer\",\"Company Profile Build\",\"Possible procured her\",\"Adance Data analysis operation\"]', '[\"Adance Data analysis operation\",\"Possible procured her trifling Obtain pain\",\"Page Load (time, size, number of requests).\",\"Company Profile Build\"]', '[\"Hair Cutting Boys\",\"Hair Cutting Girls\",\"Washroom Cleaning\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\"]', 1, '2022-10-03 10:03:43', '2022-11-06 09:32:45'),
(11, 5, NULL, 2, 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', 'ac-cleaning-service-get-asap-and-take-the-best-benifits', 15, 'uploads/custom-images/Service-2022-10-03-04-08-32-9969.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', '[\"Washroom Cleaning\",\"Page Load (time, size, number of requests).\",\"Company Profile Build\",\"Adance Data analysis operation.\",\"Page Load (time, size, number of requests)\"]', '[\"Home Service\",\"Service Gurantee\",\"Quality Service\",\"Page Load (time, size, number of requests)\",\"Kitchenroom Cleaning\"]', '[\"One Ton AC\",\"Two Ton AC\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\",\"Washroom Cleaning\"]', 1, '2022-10-03 10:08:32', '2022-11-06 09:27:57'),
(12, 6, NULL, 2, 'Grow your business at low cost from us ladies working as team', 'grow-your-business-at-low-cost-from-us', 12, 'uploads/custom-images/Service-2022-10-03-04-11-58-8828.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Grow your business at low cost from us', 'Grow your business at low cost from us', '[\"AC Change\",\"Ac Repair\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"Service Gurantee\",\"Quality Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', 1, '2022-10-03 10:11:58', '2022-11-06 09:26:14'),
(13, 2, NULL, 2, 'Cleaning Your Old House From Our Expert Cleaner Team at Low Cost', 'cleaning-your-old-house-from-our-expert-cleaner-team-at-low-cost', 10, 'uploads/custom-images/Service-2023-05-24-11-33-28-9583.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.</p>', 1, NULL, 0, 1, 0, 'Cleaning Your Old House From Our Expert Cleaner Team at Low Cost', 'Cleaning Your Old House From Our Expert Cleaner Team at Low Cost', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 10:17:45', '2023-05-24 15:33:28'),
(14, 6, NULL, 2, 'Get Our TV Repair Service At Reasonable Price', 'get-our-tv-repair-service-at-reasonable-price', 10, 'uploads/custom-images/Service-2022-10-04-09-47-48-3934.png', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Get Our TV Repair Service At Reasonable Price', 'Get Our TV Repair Service At Reasonable Price', '[\"Chair And Table Cleaning\",\"Page Load (time, size, number of requests).\",\"Adance Data analysis operation.\",\"Company Profile Build\"]', '[\"Company Profile Build\",\"Adance Data analysis operation.\",\"Page Load (time, size, number of requests).\",\"Chair And Table Cleaning\"]', '[\"TV Wall Mount Installation\",\"LCD\\/LED TV Repair Services\",\"TV Full Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\"]', 1, '2022-10-04 03:47:48', '2023-01-14 03:58:10'),
(15, 2, NULL, 4, 'Winter AC Master Cleaning and  Servicing Service', 'winter-ac-master-cleaning-and-servicing-service', 28, 'uploads/custom-images/Service-2023-01-14-09-30-19-2452.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 1, 1, 0, 'Winter AC Master Cleaning and  Servicing Service', 'Winter AC Master Cleaning and  Servicing Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:30:20', '2023-01-15 08:17:00'),
(16, 4, NULL, 4, 'Inverter AC Installation & Uninstallation Service', 'inverter-ac-installation-uninstallation-service', 65, 'uploads/custom-images/Service-2023-01-14-09-44-19-6302.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Inverter AC Installation & Uninstallation Service', 'Inverter AC Installation & Uninstallation Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:44:20', '2023-01-15 08:16:53'),
(17, 2, NULL, 4, 'Home & Outdoor Deep Cleaning Service', 'home-outdoor-deep-cleaning-service', 50, 'uploads/custom-images/Service-2023-01-14-09-46-57-2700.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Home & Outdoor Deep Cleaning Service', 'Home & Outdoor Deep Cleaning Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:46:57', '2023-01-15 08:16:45'),
(18, 5, NULL, 4, 'Car Dent, Paint and Repair  Service', 'car-dent-paint-and-repair-service', 40, 'uploads/custom-images/Service-2023-01-14-09-49-18-8993.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Car Dent, Paint and Repair  Service', 'Car Dent, Paint and Repair  Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:49:18', '2023-01-15 08:16:39'),
(19, 5, NULL, 4, 'Car Repair & Decoration Renovation Service', 'car-repair-decoration-renovation-service', 65, 'uploads/custom-images/Service-2023-01-14-09-52-03-2764.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Car Repair & Decoration Renovation Service', 'Car Repair & Decoration Renovation Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:52:04', '2023-01-15 08:16:29'),
(20, 6, NULL, 4, 'Electric and Gas Oven Setting Service', 'electric-and-gas-oven-setting-service', 15, 'uploads/custom-images/Service-2023-01-14-09-54-41-1144.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Electric and Gas Oven Setting Service', 'Electric and Gas Oven Setting Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:54:41', '2023-01-15 08:16:21'),
(21, 6, NULL, 4, 'Electric Oven Repair & Fixing Service', 'electric-oven-repair-fixing-service', 20, 'uploads/custom-images/Service-2023-01-14-09-57-02-6815.jpeg', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Electric Oven Repair & Fixing Service', 'Electric Oven Repair & Fixing Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-14 03:57:03', '2023-01-15 08:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

CREATE TABLE `service_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_areas`
--

INSERT INTO `service_areas` (`id`, `provider_id`, `city_id`, `created_at`, `updated_at`) VALUES
(6, 4, 1, '2023-04-03 06:59:50', '2023-04-03 06:59:50'),
(7, 2, 2, '2023-04-03 07:04:58', '2023-04-03 07:04:58'),
(8, 2, 6, '2023-04-03 07:04:58', '2023-04-03 07:04:58'),
(9, 2, 7, '2023-04-03 07:04:58', '2023-04-03 07:04:58'),
(10, 4, 4, '2023-04-03 07:05:41', '2023-04-03 07:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_mode` int(11) NOT NULL DEFAULT 0,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `contact_email` varchar(191) DEFAULT NULL,
  `enable_subscription_notify` int(11) NOT NULL DEFAULT 1,
  `enable_save_contact_message` int(11) NOT NULL DEFAULT 1,
  `text_direction` varchar(255) NOT NULL DEFAULT 'LTR',
  `timezone` varchar(255) DEFAULT NULL,
  `sidebar_lg_header` varchar(255) DEFAULT NULL,
  `sidebar_sm_header` varchar(255) DEFAULT NULL,
  `topbar_phone` varchar(191) DEFAULT NULL,
  `topbar_email` varchar(191) NOT NULL,
  `opening_time` varchar(255) DEFAULT NULL,
  `currency_name` varchar(191) DEFAULT NULL,
  `currency_icon` varchar(191) DEFAULT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `theme_one` varchar(191) NOT NULL,
  `counter_bg_image` varchar(255) DEFAULT NULL,
  `join_as_a_provider_banner` varchar(255) DEFAULT NULL,
  `home2_join_as_provider` varchar(255) DEFAULT NULL,
  `home3_join_as_provider` varchar(255) DEFAULT NULL,
  `join_as_a_provider_title` varchar(255) DEFAULT NULL,
  `join_as_a_provider_btn` varchar(255) DEFAULT NULL,
  `app_short_title` varchar(255) DEFAULT NULL,
  `app_full_title` varchar(255) DEFAULT NULL,
  `app_description` text DEFAULT NULL,
  `google_playstore_link` varchar(255) DEFAULT NULL,
  `app_store_link` varchar(255) DEFAULT NULL,
  `app_image` varchar(255) DEFAULT NULL,
  `home2_app_image` varchar(255) DEFAULT NULL,
  `home3_app_image` varchar(255) DEFAULT NULL,
  `subscriber_image` varchar(255) DEFAULT NULL,
  `subscriber_title` varchar(255) DEFAULT NULL,
  `subscriber_description` text DEFAULT NULL,
  `subscription_bg` varchar(255) DEFAULT NULL,
  `home2_subscription_bg` varchar(255) DEFAULT NULL,
  `home3_subscription_bg` varchar(255) DEFAULT NULL,
  `blog_page_subscription_image` varchar(255) NOT NULL,
  `default_avatar` varchar(255) DEFAULT NULL,
  `home2_contact_foreground` varchar(255) DEFAULT NULL,
  `home2_contact_background` varchar(255) DEFAULT NULL,
  `home2_contact_call_as` varchar(255) DEFAULT NULL,
  `home2_contact_phone` varchar(255) DEFAULT NULL,
  `home2_contact_available` varchar(255) DEFAULT NULL,
  `home2_contact_form_title` varchar(255) DEFAULT NULL,
  `home2_contact_form_description` text DEFAULT NULL,
  `how_it_work_background` varchar(255) DEFAULT NULL,
  `how_it_work_foreground` varchar(255) DEFAULT NULL,
  `how_it_work_title` varchar(255) DEFAULT NULL,
  `how_it_work_description` text DEFAULT NULL,
  `how_it_work_items` text DEFAULT NULL,
  `selected_theme` int(11) NOT NULL DEFAULT 0,
  `theme_one_color` varchar(255) DEFAULT NULL,
  `theme_two_color` varchar(255) DEFAULT NULL,
  `theme_three_color` varchar(255) DEFAULT NULL,
  `login_image` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `show_provider_contact_info` int(11) DEFAULT 1,
  `currency_position` varchar(255) NOT NULL DEFAULT 'before_price',
  `commission_type` varchar(255) NOT NULL DEFAULT 'commission',
  `live_chat` varchar(255) NOT NULL DEFAULT 'enable',
  `app_version` varchar(255) NOT NULL DEFAULT 'Version : 2.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `maintenance_mode`, `logo`, `favicon`, `contact_email`, `enable_subscription_notify`, `enable_save_contact_message`, `text_direction`, `timezone`, `sidebar_lg_header`, `sidebar_sm_header`, `topbar_phone`, `topbar_email`, `opening_time`, `currency_name`, `currency_icon`, `currency_rate`, `theme_one`, `counter_bg_image`, `join_as_a_provider_banner`, `home2_join_as_provider`, `home3_join_as_provider`, `join_as_a_provider_title`, `join_as_a_provider_btn`, `app_short_title`, `app_full_title`, `app_description`, `google_playstore_link`, `app_store_link`, `app_image`, `home2_app_image`, `home3_app_image`, `subscriber_image`, `subscriber_title`, `subscriber_description`, `subscription_bg`, `home2_subscription_bg`, `home3_subscription_bg`, `blog_page_subscription_image`, `default_avatar`, `home2_contact_foreground`, `home2_contact_background`, `home2_contact_call_as`, `home2_contact_phone`, `home2_contact_available`, `home2_contact_form_title`, `home2_contact_form_description`, `how_it_work_background`, `how_it_work_foreground`, `how_it_work_title`, `how_it_work_description`, `how_it_work_items`, `selected_theme`, `theme_one_color`, `theme_two_color`, `theme_three_color`, `login_image`, `footer_logo`, `created_at`, `updated_at`, `show_provider_contact_info`, `currency_position`, `commission_type`, `live_chat`, `app_version`) VALUES
(1, 1, 'uploads/website-images/logo-2022-09-07-04-23-36-4331.png', 'uploads/website-images/favicon-2022-09-07-04-23-36-1566.png', 'contact@gmail.com', 1, 1, 'ltr', 'America/Los_Angeles', 'Aabcserv', 'AS', '+1347-430-9510', 'websolutionus1@gmail.com', '10.00 AM-7.00PM', 'USD', '$', 85.76, '#009bc2', 'uploads/website-images/counter-bg--2022-09-29-12-43-47-5215.jpg', 'uploads/website-images/join-provider-bg--2022-12-03-06-07-16-1842.png', 'uploads/website-images/join-provider-home2bg--2022-10-04-10-15-33-5535.jpg', 'uploads/website-images/join-provider-home2bg--2022-12-03-06-07-18-5741.png', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'https://play.google.com/store/apps/', 'https://www.apple.com/app-store/', 'uploads/website-images/mobile-app-bg--2022-08-29-01-17-54-3596.png', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-36-1745.png', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-52-2026.png', 'uploads/website-images/sub-foreground--2022-09-08-10-47-16-9543.png', 'Subscribe Now', 'Get the updates, offers, tips and enhance your page building experience', 'uploads/website-images/sub-background-2022-09-08-10-47-05-7260.jpg', 'uploads/website-images/sub-background-2022-09-22-11-42-07-6877.jpg', 'uploads/website-images/sub-background-2022-09-22-11-41-47-4054.jpg', 'uploads/website-images/blog-sub-background-2022-09-14-04-20-56-9366.jpg', 'uploads/website-images/default-avatar-2022-12-25-04-17-13-8891.jpg', 'uploads/website-images/home2-contact-foreground--2022-12-03-06-08-24-3082.png', 'uploads/website-images/home2-contact-background-2022-09-22-12-08-16-6090.jpg', 'Call as now', '+90 456 789 251', 'We are available 24/7', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'uploads/website-images/home3-hiw-background-2022-09-22-12-52-40-5965.jpg', 'uploads/website-images/home3-hiw-foreground--2022-09-29-01-06-00-1394.jpg', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{\"title\":\"Select The Service\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Pick Your Schedule\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Place Your Booking & Relax\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"}]', 0, '#378fff', '#00bf8c', '#2251f2', 'uploads/website-images/login-page-2022-11-06-04-12-11-6638.png', 'uploads/website-images/logo-2022-11-06-04-53-35-7489.png', NULL, '2024-08-18 16:12:37', 1, 'before_price', 'subscription', 'enable', 'Version : 2.1');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `header_one` text DEFAULT NULL,
  `header_two` varchar(255) DEFAULT '0',
  `total_service_sold` varchar(255) DEFAULT NULL,
  `home2_image` varchar(255) DEFAULT NULL,
  `home3_image` varchar(255) DEFAULT NULL,
  `popular_tag` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `header_one`, `header_two`, `total_service_sold`, `home2_image`, `home3_image`, `popular_tag`, `created_at`, `updated_at`) VALUES
(1, 'Premium Service 24/7', 'There are many variations of passages of Lorem Ipsum available, but or randomised words which don\'t look', 'uploads/website-images/slider-2022-10-01-11-03-17-9020.png', 'We Provide High Quality Professional', 'Services', '43434', 'uploads/website-images/slider-2023-01-15-05-42-46-4524.png', 'uploads/website-images/slider-2022-09-22-11-15-09-1295.png', '[{\"value\":\"Painting\"},{\"value\":\"Cleaner\"},{\"value\":\"Home Move\"},{\"value\":\"Electronics\"}]', '2022-01-30 10:25:59', '2023-01-15 11:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `social_login_information`
--

CREATE TABLE `social_login_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_facebook` int(11) NOT NULL DEFAULT 0,
  `facebook_client_id` text DEFAULT NULL,
  `facebook_secret_id` text DEFAULT NULL,
  `is_gmail` int(11) NOT NULL DEFAULT 0,
  `gmail_client_id` text DEFAULT NULL,
  `gmail_secret_id` text DEFAULT NULL,
  `facebook_redirect_url` text DEFAULT NULL,
  `gmail_redirect_url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_login_information`
--

INSERT INTO `social_login_information` (`id`, `is_facebook`, `facebook_client_id`, `facebook_secret_id`, `is_gmail`, `gmail_client_id`, `gmail_secret_id`, `facebook_redirect_url`, `gmail_redirect_url`, `created_at`, `updated_at`) VALUES
(1, 1, '1844188565781706', 'f32f45abcf57a4dc23ac6f2b2e8e2241', 1, '810593187924-706in12herrovuq39i2pbn483otijei8.apps.googleusercontent.com', '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', 'http://localhost/web-solution-us/ecommerce_ibrahim/callback/google', 'http://localhost/web-solution-us/ecommerce_ibrahim/callback/google', NULL, '2022-01-22 19:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payments`
--

CREATE TABLE `stripe_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(10) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_rate` double NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stripe_payments`
--

INSERT INTO `stripe_payments` (`id`, `status`, `stripe_key`, `stripe_secret`, `created_at`, `updated_at`, `country_code`, `currency_code`, `currency_rate`, `image`) VALUES
(1, 1, 'pk_test_51JU61aF56Pb8BOOX5ucAe5DlDwAkCZyffqlKMDUWsAwhKbdtuY71VvIzr0NgFKjq4sOVVaaeeyVXXnNWwu5dKgeq00kMzCBUm5', 'sk_test_51JU61aF56Pb8BOOXlz7jGkzJsCkozuAoRlFJskYGsgunfaHLmcvKLubYRQLCQOuyYHq0mvjoBFLzV7d8F6q8f6Hv00CGwULEEV', NULL, '2022-09-25 04:04:48', 'US', 'USD', 1, 'uploads/website-images/stripe-2022-09-25-10-04-48-4289.png');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `verified_token` text DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `status`, `verified_token`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'testapi@gmail.com', 0, 'ZaCyHZZFSJyYQh9Er4ptOPumu', 0, '2022-11-08 09:59:18', '2022-11-08 09:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_histories`
--

CREATE TABLE `subscription_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `subscription_id` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `maximum_service` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `plan_name`, `plan_price`, `expiration_date`, `maximum_service`, `status`, `serial`, `created_at`, `updated_at`) VALUES
(2, 'Premium', '29', 'yearly', '20', '1', '2', '2023-06-18 17:22:20', '2023-06-18 17:22:20'),
(3, 'Free', '0', 'monthly', '10', '1', '1', '2023-06-18 17:30:04', '2023-06-18 21:06:53'),
(4, 'Gold', '49', 'lifetime', '50', '1', '3', '2023-06-18 20:40:25', '2023-06-18 20:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `tawk_chats`
--

CREATE TABLE `tawk_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_link` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tawk_chats`
--

INSERT INTO `tawk_chats` (`id`, `chat_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://embed.tawk.to/5a7c31ded7591465c7077c48/default', 0, NULL, '2022-10-08 05:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terms_and_condition` text DEFAULT NULL,
  `privacy_policy` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `terms_and_condition`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, '<p><strong>1. What Are Terms and Conditions?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Does My Online Service Need Terms and Conditions?</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site.&nbsp;</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Lim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '<p><strong>1. What Are Privacy Policy?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Ecommerce Terms and Conditions Examples</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2022-01-30 12:34:53', '2023-01-18 09:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `designation`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'uploads/custom-images/john-doe-20220929124436.png', 'MBBS, FCPS, FRCS', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', 1, '2022-09-29 06:44:37', '2022-11-06 07:37:38'),
(2, 'David Richard', 'uploads/custom-images/david-richard-20220929124535.png', 'Web Developer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', 1, '2022-09-29 06:45:35', '2022-11-06 07:37:47'),
(3, 'David Simmons', 'uploads/custom-images/david-simmons-20220929124643.png', 'Graphic Designer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', 1, '2022-09-29 06:46:43', '2022-11-06 07:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `ticket_from` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `order_id`, `subject`, `ticket_id`, `ticket_from`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Subscribe Verification', '1635062237', 'Client', 'in_progress', '2022-10-05 04:25:49', '2022-10-05 04:41:04'),
(2, 1, 1, 'Client login issue', '837063363', 'Client', 'in_progress', '2022-10-05 04:44:18', '2022-10-05 04:44:49'),
(3, 1, 1, 'this is ticket subject', '429031825', 'Client', 'pending', '2022-11-09 05:55:22', '2022-11-09 05:55:22'),
(4, 2, 9, 'This is test ticket', '280534528', 'provider', 'pending', '2022-11-10 04:01:49', '2022-11-10 04:01:49'),
(5, 2, 9, 'this is subject', '685296566', 'provider', 'in_progress', '2022-11-10 04:24:43', '2024-02-18 21:35:25'),
(7, 1, 1, 'This is a subject field', '180042280', 'Client', 'pending', '2023-05-07 14:36:40', '2023-05-07 14:36:40'),
(22, 1, 117, 'Test Email', '518461685', 'Client', 'in_progress', '2024-04-24 14:05:50', '2024-04-24 14:13:03'),
(23, 2, 1, 'test support', '1026978045', 'provider', 'pending', '2024-09-03 05:47:12', '2024-09-03 05:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_from` varchar(255) NOT NULL,
  `unseen_admin` int(11) NOT NULL DEFAULT 0,
  `unseen_user` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_messages`
--

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `user_id`, `admin_id`, `message`, `message_from`, `unseen_admin`, `unseen_user`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'test message', 'client', 1, 1, '2022-10-05 04:25:49', '2023-06-15 06:44:58'),
(2, 1, 1, 1, 'Please share your problem', 'admin', 1, 1, '2022-10-05 04:41:04', '2023-06-15 06:44:58'),
(3, 1, 1, 1, 'Test message from support team', 'admin', 1, 1, '2022-10-05 04:43:36', '2023-06-15 06:44:58'),
(4, 2, 1, 0, 'I can\'t login your site, please help', 'client', 1, 1, '2022-10-05 04:44:18', '2023-01-15 03:18:08'),
(5, 2, 1, 1, 'We deactivate your account, You can\'t login.', 'admin', 1, 1, '2022-10-05 04:44:49', '2023-01-15 03:18:08'),
(6, 2, 1, 1, 'Please open file below', 'admin', 1, 1, '2022-10-05 05:10:49', '2023-01-15 03:18:08'),
(7, 2, 1, 0, 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO', 'client', 1, 1, '2022-10-05 05:45:22', '2023-01-15 03:18:08'),
(8, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-05 05:47:07', '2023-01-15 03:18:08'),
(9, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-05 05:47:24', '2023-01-15 03:18:08'),
(10, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-05 05:48:40', '2023-01-15 03:18:08'),
(11, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-05 05:48:57', '2023-01-15 03:18:08'),
(12, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-05 05:49:08', '2023-01-15 03:18:08'),
(13, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-05 05:49:15', '2023-01-15 03:18:08'),
(14, 2, 1, 0, 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO', 'client', 1, 1, '2022-10-05 05:50:05', '2023-01-15 03:18:08'),
(15, 2, 1, 0, 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO', 'client', 1, 1, '2022-10-05 05:51:33', '2023-01-15 03:18:08'),
(16, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:52:18', '2023-01-15 03:18:08'),
(17, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:54:01', '2023-01-15 03:18:08'),
(18, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:54:20', '2023-01-15 03:18:08'),
(19, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:54:38', '2023-01-15 03:18:08'),
(20, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:54:54', '2023-01-15 03:18:08'),
(21, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:55:39', '2023-01-15 03:18:08'),
(22, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:55:46', '2023-01-15 03:18:08'),
(23, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-05 05:58:59', '2023-01-15 03:18:08'),
(24, 2, 1, 0, 'features like Laravel, customized website, PHP,', 'client', 1, 1, '2022-10-05 05:59:57', '2023-01-15 03:18:08'),
(25, 2, 1, 0, 'features like Laravel, customized website, PHP,', 'client', 1, 1, '2022-10-05 06:00:13', '2023-01-15 03:18:08'),
(26, 2, 1, 0, 'features like Laravel, customized website, PHP,', 'client', 1, 1, '2022-10-05 06:00:35', '2023-01-15 03:18:08'),
(27, 2, 1, 0, 'We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'client', 1, 1, '2022-10-05 06:01:31', '2023-01-15 03:18:08'),
(28, 2, 1, 0, 'We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'client', 1, 1, '2022-10-05 06:01:35', '2023-01-15 03:18:08'),
(29, 1, 1, 0, 'We are dedicated to work with all dynamic features like Laravel,', 'client', 1, 1, '2022-10-05 06:02:21', '2023-06-15 06:44:58'),
(30, 1, 1, 0, 'We are dedicated to work with all dynamic features like Laravel,', 'client', 1, 1, '2022-10-05 06:02:35', '2023-06-15 06:44:58'),
(31, 1, 1, 1, 'wait', 'admin', 1, 1, '2022-10-05 06:03:31', '2023-06-15 06:44:58'),
(32, 1, 1, 0, 'any update ?', 'client', 1, 1, '2022-10-05 10:48:00', '2023-06-15 06:44:58'),
(33, 3, 1, 0, 'this is ticket message', 'client', 0, 1, '2022-11-09 05:55:23', '2024-03-26 16:56:44'),
(34, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-11-09 06:04:24', '2023-01-15 03:18:08'),
(35, 4, 2, 0, 'This is test message', 'provider', 1, 1, '2022-11-10 04:01:49', '2024-04-24 14:12:35'),
(36, 4, 2, 0, 'are you there ?', 'provider', 1, 1, '2022-11-10 04:06:51', '2024-04-24 14:12:35'),
(37, 4, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-10 04:14:09', '2024-04-24 14:12:35'),
(38, 4, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-10 04:14:30', '2024-04-24 14:12:35'),
(39, 4, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-10 04:15:22', '2024-04-24 14:12:35'),
(40, 5, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-10 04:24:43', '2024-09-03 05:46:28'),
(41, 2, 1, 1, 'We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'admin', 1, 1, '2022-12-25 11:20:36', '2023-01-15 03:18:08'),
(43, 7, 1, 0, 'this is a message field..', 'client', 0, 1, '2023-05-07 14:36:40', '2024-03-26 16:56:37'),
(47, 9, 17, 0, 'this is message', 'provider', 0, 1, '2023-05-16 19:28:46', '2023-05-16 19:28:46'),
(48, 10, 17, 0, 'ddddd', 'provider', 0, 1, '2023-05-16 19:50:27', '2023-05-16 20:03:46'),
(49, 11, 17, 0, 'message', 'provider', 0, 1, '2023-05-16 20:03:32', '2023-05-16 20:03:32'),
(50, 12, 17, 0, 'message', 'provider', 0, 1, '2023-05-16 20:03:49', '2023-05-16 20:03:49'),
(51, 13, 17, 0, 'mmmmmmmmmmmm', 'provider', 0, 1, '2023-05-16 20:09:21', '2023-05-16 20:09:21'),
(61, 5, 2, 1, 'tyututyuty', 'admin', 1, 1, '2024-02-18 21:35:25', '2024-09-03 05:46:28'),
(62, 5, 2, 1, 'utyutyutyu', 'admin', 1, 1, '2024-02-18 21:35:32', '2024-09-03 05:46:28'),
(63, 22, 1, 0, 'drgdgdfg', 'client', 1, 1, '2024-04-24 14:05:50', '2024-07-07 23:23:04'),
(64, 22, 1, 1, 'hlw', 'admin', 1, 1, '2024-04-24 14:13:03', '2024-07-07 23:23:04'),
(65, 22, 1, 0, 'hi', 'client', 1, 1, '2024-04-24 14:13:24', '2024-07-07 23:23:04'),
(66, 22, 1, 1, 'cvbcvbcvb', 'admin', 1, 1, '2024-03-25 16:29:25', '2024-07-07 23:23:04'),
(67, 23, 2, 0, 'this is new test message', 'provider', 0, 1, '2024-09-03 05:47:12', '2024-09-03 05:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `kyc_status` int(11) DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `forget_password_token` varchar(191) DEFAULT NULL,
  `forget_password_otp` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `provider_id` varchar(191) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `provider_avatar` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `country_id` int(11) DEFAULT 0,
  `state_id` int(11) DEFAULT 0,
  `city_id` int(11) DEFAULT 0,
  `zip_code` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `is_provider` int(11) NOT NULL DEFAULT 0,
  `verify_token` varchar(191) DEFAULT NULL,
  `otp_mail_verify_token` varchar(255) DEFAULT NULL,
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `agree_policy` int(11) DEFAULT 0,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `kyc_status`, `email_verified_at`, `password`, `remember_token`, `forget_password_token`, `forget_password_otp`, `status`, `provider_id`, `provider`, `provider_avatar`, `image`, `phone`, `country_id`, `state_id`, `city_id`, `zip_code`, `address`, `is_provider`, `verify_token`, `otp_mail_verify_token`, `email_verified`, `agree_policy`, `designation`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', NULL, 'user@gmail.com', 0, NULL, '$2y$10$nBjBnvup0nEOKcYrryPQ4O2lAnm/m8M3T7/P1MW2qxlGU5wMViPAm', 'BSNT0mHVsC2Hp3rr7864RMo11aiTRKePjydKVxm7YwSoPywpDgyb7PYqv6FP', 'OdfAwBv0qZRt26ADKL3Vl9LIatjJjb7m6Js1oSSvhch0GXklY0dwM3Gs6XEnqxyiTwWYsjQ4fpqtzimE6CagXRnKbXQKof9ZtUkz', NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/john-doe-2023-05-08-10-44-45-5121.jpg', '123-343-4444', 0, 0, 0, NULL, 'Florida City, FL, UK', 0, NULL, NULL, 1, 0, NULL, '2022-09-29 07:44:31', '2023-05-17 21:49:17'),
(2, 'David Simmons', 'david-simmons83', 'provider@gmail.com', 0, NULL, '$2y$10$Li84xiyyPQtlTfFPbQLZkeUsmwXr87YGc/mbzZ03Y8iakasaZY3yu', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/david-simmons-2023-05-07-10-44-34-5733.png', '123-343-4444', 1, 1, 2, NULL, 'Los Angeles, CA, USAAAAA', 1, NULL, NULL, 1, 0, 'Electrician', '2022-09-29 07:44:31', '2023-05-16 17:59:29'),
(4, 'David Richard', 'david_richard', 'provider1@gmail.com', 0, NULL, '$2y$10$KVMjtClALn6AGJ4ObaUqpeq/RbbawUgkkMEOSjJs1dqS/A2F9ji5C', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/david-richard-2023-01-15-03-38-17-3004.png', '123-343-4444', 1, 2, 1, NULL, 'Florida City, FL, USA', 1, NULL, NULL, 1, 0, 'Web Developer', '2022-10-04 06:24:21', '2023-01-15 09:38:17'),
(5, 'Daniel Paul', 'daniel_paul', 'provider2@gmail.com', 0, NULL, '$2y$10$SHHv2G/f/PRLQPwR.dnBIulyGdV1u2bo4fUNrpjJxcKsoEOE9JW3G', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '125-985-4587', 2, 5, 9, NULL, 'Gandhinagar, Gujarat, India', 1, NULL, NULL, 1, 0, 'Graphic Designer', '2022-10-04 06:45:34', '2022-10-04 06:55:05'),
(6, 'David Miller', 'david_miller', 'provider3@gmail.com', 0, NULL, '$2y$10$XROzn42ksW.wG3an5./30enVsC6OBBV2gUzWc7VXwj8UAZd5yrGse', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '123-343-4444', 1, 1, NULL, NULL, 'California, USA', 1, NULL, NULL, 1, 0, 'Web Developer', '2022-10-04 06:54:14', '2023-07-02 20:56:49'),
(7, 'Ken Williamson', 'testusername_14', 'ken@gmail.com', 0, NULL, '$2y$10$Os9CLodYJrxevTolDPG8TuT6Pr1URAqWx6BkLjlF2krAjiyk2TDmS', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '123-954-8745', 1, 3, 2, NULL, 'test address', 1, 'bSRkndxcC0PrO279K5WWEcE2B14uUCfPZrD3S4ffqtCdGHHzIJodPiJMIED1nXSspy7PGBZYHFLXfDPAC44oMgUUdL9s7h5vSn1H', NULL, 0, 0, 'electrician', '2022-11-08 08:46:47', '2022-11-08 08:46:47'),
(9, 'api user', NULL, 'apiuser@gmail.com', 0, NULL, '$2y$10$WE4c1puU88mGFD5jOULWEOuFMNfIo4SNiZNTNdsZlXW5ahHGiIbaS', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, '482031', 0, 0, NULL, '2022-11-09 07:24:14', '2022-11-09 07:24:14'),
(10, 'John Abraham', NULL, 'user1@gmail.com', 0, NULL, '$2y$10$u7XO20zsYqIRGAl8iJB4cu.K2Ip6BpBYKCJqvaijcQYn1vtHPV24m', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 1, 0, NULL, '2023-01-09 09:34:55', '2023-01-09 09:35:55'),
(11, 'Food &amp; Drink', NULL, 'food&amp;and@gmail.com', 0, NULL, '$2y$10$Y.EJfizRPCj3d2T8J3teEuKBxJI.VKfp43eNtrmflXWDXjc51C8KO', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 'GpOR1S9BXtLfoEEsg3DQyNlLMxorq5y1z59wPnTVLmCxFADXLnNbEtAvAwdEokYT6EAvWCwJbKgha82BI55PyuRT4K5ZF8TUQYKj', NULL, 0, 0, NULL, '2023-01-15 07:15:38', '2023-01-15 07:15:38'),
(16, 'Banglaeshi Cleaner', NULL, 'mapajiy811@jobbrett.com', 0, NULL, '$2y$10$ydWvTfYUL3CV/TwgTICgQu0L5lUItdt1.ZLpoastPy5Fe/EHxV5Pa', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/banglaeshi-cleaner-2023-05-07-05-52-31-9414.jpg', '01712365478', 2, 4, 8, NULL, 'Dhaka, Bangladesh', 0, NULL, NULL, 1, 0, 'Developer', '2023-05-07 21:14:11', '2023-05-07 21:52:31'),
(25, 'Hello Cleaner', NULL, 'sexowic230@carpetra.com', 0, NULL, '$2y$10$XSjWUvTyQKVzL/aA9AnTFOn5M3PfLuypHAcK5WBnlt1SIsmuuh6KK', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/hello-cleaner-2023-05-17-03-53-04-9256.jpg', '01512376890', 4, 7, 10, NULL, 'Dhaka, Bangladesh', 0, NULL, NULL, 1, 0, 'Electrician', '2023-05-17 18:22:39', '2023-05-21 20:11:02'),
(26, 'Person User', NULL, 'nefed97472@andorem.com', 0, NULL, '$2y$10$ohPurecc9uH32qSPJbmjyeUQmDPGZVVXogfQhW1rCxAOyglk81z52', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '01512546988', 1, 1, 2, NULL, 'Dhaka, Bangladesh', 0, NULL, NULL, 1, 0, 'Electrician', '2023-05-21 19:17:55', '2023-05-21 20:21:39'),
(27, 'Jhon Harry', NULL, 'kadise2954@mevori.com', 0, NULL, '$2y$10$xqCdhmvr4yycCjHSjxOIweFvv2CIYPAXIAVvVDgL/KB4zekc7N5VW', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '01312345678', 0, 0, 0, NULL, 'California', 0, NULL, NULL, 1, 0, NULL, '2023-05-23 14:51:56', '2023-05-23 14:54:50'),
(28, 'Rashedul Islam', NULL, 'rashed4pa@gmail.com', 0, NULL, '$2y$10$rBkq79CA6pCe5BOVt9fSBea5rOCnSpVATvhavuvwgoFiA5JTfRgcW', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 1, 'C1I5lpgo8c6djO7FHeVBMnUjFRw1HPtZORYr8taAuEap5Epo14fvGBs4tu4rp3iUYBheDZv35aExQfPKJVf8QCQeIyH3nDuSzpp9', NULL, 0, 0, NULL, '2024-02-19 15:33:05', '2024-02-19 15:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_amount` double NOT NULL DEFAULT 0,
  `max_amount` double NOT NULL DEFAULT 0,
  `withdraw_charge` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `min_amount`, `max_amount`, `withdraw_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank Payment', 10, 20, 1, '<p>Bank Name: Your bank name</p><p><span style=\"background-color: transparent;\">Account Number:&nbsp; Your bank account number</span></p><p>Routing Number: Your bank routing number</p><p>Branch: Your bank branch name</p>', 1, '2022-10-08 03:15:37', '2022-10-08 03:15:37'),
(3, 'Mobile Bank', 10, 300, 4, '<p>Mobile banking</p>\r\n<p>Bank Name</p>', 1, '2023-05-07 19:36:11', '2023-05-07 19:36:11'),
(4, 'Cash On', 20, 400, 2, '<p>Cash On Delivery</p>\r\n<p>Pay you Your Cash.</p>', 1, '2023-05-07 20:12:02', '2023-05-07 20:12:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_services`
--
ALTER TABLE `additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appointment_schedules`
--
ALTER TABLE `appointment_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_payments`
--
ALTER TABLE `bank_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breadcrumb_images`
--
ALTER TABLE `breadcrumb_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complete_requests`
--
ALTER TABLE `complete_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_pages`
--
ALTER TABLE `contact_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_consents`
--
ALTER TABLE `cookie_consents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_states`
--
ALTER TABLE `country_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_countries`
--
ALTER TABLE `currency_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_configurations`
--
ALTER TABLE `email_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_pages`
--
ALTER TABLE `error_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_comments`
--
ALTER TABLE `facebook_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_pixels`
--
ALTER TABLE `facebook_pixels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flutterwaves`
--
ALTER TABLE `flutterwaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_links`
--
ALTER TABLE `footer_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_social_links`
--
ALTER TABLE `footer_social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_analytics`
--
ALTER TABLE `google_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_recaptchas`
--
ALTER TABLE `google_recaptchas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_it_works`
--
ALTER TABLE `how_it_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instamojo_payments`
--
ALTER TABLE `instamojo_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_post_translations`
--
ALTER TABLE `job_post_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_information`
--
ALTER TABLE `kyc_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_types`
--
ALTER TABLE `kyc_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintainance_texts`
--
ALTER TABLE `maintainance_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_visibilities`
--
ALTER TABLE `menu_visibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_documents`
--
ALTER TABLE `message_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_sliders`
--
ALTER TABLE `mobile_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paystack_and_mollies`
--
ALTER TABLE `paystack_and_mollies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `popular_posts`
--
ALTER TABLE `popular_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_bank_handcashes`
--
ALTER TABLE `provider_bank_handcashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_client_reports`
--
ALTER TABLE `provider_client_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_flutterwaves`
--
ALTER TABLE `provider_flutterwaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_instamojos`
--
ALTER TABLE `provider_instamojos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_mollies`
--
ALTER TABLE `provider_mollies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_paypals`
--
ALTER TABLE `provider_paypals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_paystacks`
--
ALTER TABLE `provider_paystacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_razorpays`
--
ALTER TABLE `provider_razorpays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_stripes`
--
ALTER TABLE `provider_stripes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_withdraws`
--
ALTER TABLE `provider_withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pusher_credentails`
--
ALTER TABLE `pusher_credentails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_contents`
--
ALTER TABLE `section_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_controls`
--
ALTER TABLE `section_controls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_login_information`
--
ALTER TABLE `social_login_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_histories`
--
ALTER TABLE `subscription_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawk_chats`
--
ALTER TABLE `tawk_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `appointment_schedules`
--
ALTER TABLE `appointment_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `bank_payments`
--
ALTER TABLE `bank_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `breadcrumb_images`
--
ALTER TABLE `breadcrumb_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complete_requests`
--
ALTER TABLE `complete_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_pages`
--
ALTER TABLE `contact_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_consents`
--
ALTER TABLE `cookie_consents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country_states`
--
ALTER TABLE `country_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `currency_countries`
--
ALTER TABLE `currency_countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_configurations`
--
ALTER TABLE `email_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `error_pages`
--
ALTER TABLE `error_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facebook_comments`
--
ALTER TABLE `facebook_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facebook_pixels`
--
ALTER TABLE `facebook_pixels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `flutterwaves`
--
ALTER TABLE `flutterwaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_links`
--
ALTER TABLE `footer_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `footer_social_links`
--
ALTER TABLE `footer_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `google_analytics`
--
ALTER TABLE `google_analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptchas`
--
ALTER TABLE `google_recaptchas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `how_it_works`
--
ALTER TABLE `how_it_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instamojo_payments`
--
ALTER TABLE `instamojo_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_post_translations`
--
ALTER TABLE `job_post_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kyc_information`
--
ALTER TABLE `kyc_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kyc_types`
--
ALTER TABLE `kyc_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintainance_texts`
--
ALTER TABLE `maintainance_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_visibilities`
--
ALTER TABLE `menu_visibilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message_documents`
--
ALTER TABLE `message_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `mobile_sliders`
--
ALTER TABLE `mobile_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paystack_and_mollies`
--
ALTER TABLE `paystack_and_mollies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popular_posts`
--
ALTER TABLE `popular_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `provider_bank_handcashes`
--
ALTER TABLE `provider_bank_handcashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_client_reports`
--
ALTER TABLE `provider_client_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_flutterwaves`
--
ALTER TABLE `provider_flutterwaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_instamojos`
--
ALTER TABLE `provider_instamojos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_mollies`
--
ALTER TABLE `provider_mollies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_paypals`
--
ALTER TABLE `provider_paypals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `provider_paystacks`
--
ALTER TABLE `provider_paystacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_razorpays`
--
ALTER TABLE `provider_razorpays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_stripes`
--
ALTER TABLE `provider_stripes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_withdraws`
--
ALTER TABLE `provider_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pusher_credentails`
--
ALTER TABLE `pusher_credentails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `refund_requests`
--
ALTER TABLE `refund_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `section_contents`
--
ALTER TABLE `section_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `section_controls`
--
ALTER TABLE `section_controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `service_areas`
--
ALTER TABLE `service_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_login_information`
--
ALTER TABLE `social_login_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_histories`
--
ALTER TABLE `subscription_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tawk_chats`
--
ALTER TABLE `tawk_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
