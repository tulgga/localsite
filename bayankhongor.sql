-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 05:54 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bayankhongor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_type` int(11) NOT NULL COMMENT '0-admin, 1-niitlegch, 2-ded admin, 3 ded site niitlegch',
  `site_id` int(11) DEFAULT '0',
  `profile_pic` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `f_name`, `l_name`, `user_name`, `password`, `email`, `phone`, `admin_type`, `site_id`, `profile_pic`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin', 'admin', '$2y$10$fDHwAPXEHHfSLL1eQ3Vt/eh7b1kwwqFf4O.8qv3YtDQeLJt7a/ek.', 'admin@bh.mn', '99987079', 0, 0, 'employees/vgLLqorRZXMoNgni6d0J7iRUP7flkSvdS3h6yPGo.jpeg', 1, NULL, '2018-10-08 03:48:11'),
(3, 'Анхбаатар', 'Түвшин', 'anhaa', '$2y$10$m9XTAn9Qy/Ay4U11wtG0Zei/ZJnss51Hob/58cWjH3d17IDAyHitG', 'bolloomn@gmail.com', '99987079', 2, 36, 'employees/LNQVgG3m3kKBzH02zbOAPhdSGGkzCfjMveyHh330.jpeg', 1, '2018-10-08 03:49:20', '2018-10-08 04:11:02'),
(4, 'test', 'test', 'test', '$2y$10$hGZXUXBHb/WkaywGDYPwbe0fVteQtDduoARpNOhi9QVh8fRmyG9oy', 'test@asd.mn', 'test', 3, 36, 'employees/AFiFQ3xC7ldPVmlZMxxgiffOdDPAC8wBRVqUQRA7.jpeg', 1, '2018-10-08 04:13:03', '2018-10-08 04:13:20'),
(5, 'test1', 'test1', '123', '$2y$10$7sT7shwd0HaHTnnxcEd79.Be0m1sZo.HbR5qlnqiBRzdE7f9nzf8a', 'bolloomn1@gmail.com', '123', 2, 37, '', 0, '2018-10-08 04:14:00', '2018-10-08 08:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `order_num` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `site_id`, `order_num`, `parent_id`, `created_at`, `updated_at`) VALUES
(42, 'asdsad', 0, 0, 41, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(41, 'asdasda', 0, 0, 39, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(39, 'dasdaa', 0, 1, 38, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(44, 'asdas', 0, 0, 38, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(38, 'da', 0, 1, 37, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(31, '12312321', 0, 1, 29, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(30, '12312', 0, 0, 29, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(29, '123', 0, 1, 28, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(34, '1231231231', 0, 0, 28, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(28, 'asda', 0, 1, 32, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(33, 'adada123 ', 0, 0, 32, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(32, 'asdadsa', 0, 0, 37, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(37, 'aasda', 0, 1, 0, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(43, 'asdad', 0, 0, 36, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(36, 'asdad', 0, 0, 0, '2018-10-12 04:21:45', '2018-10-12 04:21:45'),
(45, 'test', 49, 0, 0, '2018-10-23 07:28:17', '2018-10-23 07:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '0-post, 2-page, 3-poll',
  `content` varchar(255) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `file` varchar(300) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cart_number` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `site_id`, `name`, `content`, `file`, `status`, `cart_number`, `publish_date`, `active_date`, `created_at`, `updated_at`) VALUES
(9, 0, '123123', '123123', 'file/78cBc0hVR1th5ut19mKo8lV4b11sseeIKPhmBKRs.zip', 1, 12312, '2018-10-10', '2018-10-13', '2018-10-16 10:06:24', '2018-10-16 10:06:24'),
(10, 0, '21312123sda', '1231123123da', 'file/HrMRX74ZYaTiwGKkR3JGGTwDK24FtRDCx6OlzpjR.docx', 1, 12312, '2018-10-17', '2018-10-19', '2018-10-17 00:13:23', '2018-10-17 02:48:12'),
(11, 0, '123123', '123', 'file/ytvMarHx5HyktYl7wk4WUptKIPhIwEnJsMX3Wpnf.jpeg', 1, 12312, '2018-10-17', '2018-10-10', '2018-10-17 03:53:18', '2018-10-17 03:53:18'),
(12, 49, '12312', '123213', 'file/sxp9u3GPCVk739i3M9rtX5ZcbNOhvG3Wx2NJs46W.jpeg', 1, 12321, '2018-10-25', '2018-10-18', '2018-10-18 05:44:19', '2018-10-18 05:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `file_category`
--

CREATE TABLE `file_category` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `order_num` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `file_category`
--

INSERT INTO `file_category` (`id`, `name`, `site_id`, `order_num`, `parent_id`, `created_at`, `updated_at`) VALUES
(25, 'ssss', 0, 0, 18, '2018-10-19 06:12:03', '2018-10-19 06:12:03'),
(18, 'asdad', 0, 0, 15, '2018-10-19 06:12:03', '2018-10-19 06:12:03'),
(15, '123123sad', 0, 0, 14, '2018-10-19 06:12:03', '2018-10-19 06:12:03'),
(14, '123', 0, 0, 13, '2018-10-19 06:12:03', '2018-10-19 06:12:03'),
(13, 'Тогтоол1', 0, 1, 0, '2018-10-19 06:12:03', '2018-10-19 06:12:03'),
(17, '1231231', 0, 0, 0, '2018-10-19 06:12:03', '2018-10-19 06:12:03'),
(19, 'asdad1', 51, 0, 0, '2018-10-18 05:43:16', '2018-10-18 05:43:16'),
(20, 'asdad1', 51, 0, 19, '2018-10-18 05:43:16', '2018-10-18 05:43:16'),
(21, 'asdad2', 51, 1, 19, '2018-10-18 05:43:16', '2018-10-18 05:43:16'),
(22, '123', 49, 0, 0, '2018-10-18 05:44:01', '2018-10-18 05:44:01'),
(23, '123123', 49, 1, 0, '2018-10-18 05:44:01', '2018-10-18 05:44:01'),
(24, '1231', 49, 2, 0, '2018-10-18 05:44:01', '2018-10-18 05:44:01'),
(16, '123123', 0, 1, 14, '2018-10-19 06:12:03', '2018-10-19 06:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `file_to_category`
--

CREATE TABLE `file_to_category` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `file_to_category`
--

INSERT INTO `file_to_category` (`id`, `file_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(37, 10, 17, '2018-10-17 02:48:12', '2018-10-17 02:48:12'),
(38, 10, 13, '2018-10-17 02:48:12', '2018-10-17 02:48:12'),
(39, 10, 14, '2018-10-17 02:48:12', '2018-10-17 02:48:12'),
(40, 10, 15, '2018-10-17 02:48:12', '2018-10-17 02:48:12'),
(41, 10, 18, '2018-10-17 02:48:12', '2018-10-17 02:48:12'),
(42, 10, 16, '2018-10-17 02:48:12', '2018-10-17 02:48:12'),
(43, 11, 17, '2018-10-17 03:53:18', '2018-10-17 03:53:18'),
(44, 9, 17, '2018-10-17 05:43:38', '2018-10-17 05:43:38'),
(45, 9, 13, '2018-10-17 05:43:38', '2018-10-17 05:43:38'),
(46, 9, 14, '2018-10-17 05:43:38', '2018-10-17 05:43:38'),
(47, 9, 15, '2018-10-17 05:43:38', '2018-10-17 05:43:38'),
(48, 9, 18, '2018-10-17 05:43:38', '2018-10-17 05:43:38'),
(49, 12, 23, '2018-10-18 05:44:19', '2018-10-18 05:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `link` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `name`, `site_id`, `cat_id`, `link`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Аймгийн аудитийн газар', 0, 4, '#', NULL, '2018-10-10 07:59:57', '2018-10-16 09:36:19'),
(4, 'Эрүүл мэндийн газар', 0, 3, '#', NULL, '2018-10-10 08:00:28', '2018-10-10 08:00:28'),
(5, 'dalkommadmin', 0, 3, '12312', NULL, '2018-10-16 09:36:08', '2018-10-16 09:36:08'),
(6, 'dalkommadmin', 0, 4, '123123', NULL, '2018-10-16 09:36:28', '2018-10-16 09:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `link_category`
--

CREATE TABLE `link_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `site_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_category`
--

INSERT INTO `link_category` (`id`, `name`, `site_id`, `created_at`, `updated_at`) VALUES
(4, '1', 0, '2018-10-16 09:36:13', '2018-10-16 09:36:13'),
(3, 'ХЭЛТЭС АГЕНТЛАГ', 0, '2018-10-10 07:25:03', '2018-10-10 07:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `order_num` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL COMMENT '0-link; 1-news single; 2-news category; 3-page;  4-file catgeory; 5-file single; 6-link category',
  `type_id` int(11) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `blank` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `site_id`, `order_num`, `parent_id`, `type`, `type_id`, `link`, `blank`, `created_at`, `updated_at`) VALUES
(50, 'asda', 49, 0, 0, 0, NULL, '', 0, '2018-10-24 03:53:55', '2018-10-24 03:53:55'),
(47, 'sss', 0, 0, 46, 3, 18, '/p/18', 0, '2018-10-24 03:52:26', '2018-10-24 03:52:26'),
(46, 'fdqe', 0, 0, 0, 1, 3, '/news/3', 1, '2018-10-24 03:52:26', '2018-10-24 03:52:26'),
(48, '123asda', 0, 1, 0, 5, 10, '/file/10', 0, '2018-10-24 03:52:26', '2018-10-24 03:52:26'),
(49, 'asdsad', 0, 2, 0, 6, 3, '/link/3', 1, '2018-10-24 03:52:26', '2018-10-24 03:52:26'),
(51, '111', 49, 0, 50, 4, 15, '/files/15', 0, '2018-10-24 03:53:55', '2018-10-24 03:53:55'),
(45, 'test', 49, 1, 0, 0, NULL, NULL, 1, '2018-10-24 03:53:55', '2018-10-24 03:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2018_08_23_040951_admin', 1),
(7, '2018_10_05_081325_create_new_table_sites', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news_to_category`
--

CREATE TABLE `news_to_category` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_to_category`
--

INSERT INTO `news_to_category` (`id`, `post_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(1, 3, 36, '2018-10-19 07:15:01', '2018-10-19 07:15:01'),
(2, 3, 43, '2018-10-19 07:15:01', '2018-10-19 07:15:01'),
(3, 3, 37, '2018-10-19 07:15:01', '2018-10-19 07:15:01'),
(4, 3, 33, '2018-10-19 07:15:01', '2018-10-19 07:15:01'),
(5, 3, 34, '2018-10-19 07:15:01', '2018-10-19 07:15:01'),
(6, 4, 31, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(7, 4, 30, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(8, 4, 29, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(9, 4, 28, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(10, 4, 44, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(11, 4, 39, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(12, 4, 41, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(13, 4, 42, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(14, 4, 37, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(15, 4, 32, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(16, 4, 33, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(17, 5, 45, '2018-10-23 07:28:41', '2018-10-23 07:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `news_to_sites`
--

CREATE TABLE `news_to_sites` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('8cb39f4dbdff0add1e6bb2478038eb71725d62b7d6a261ced59eb891cbda6e583f226afe0e1703e9', 2, 1, 'admin', '[]', 0, '2018-10-04 07:16:09', '2018-10-04 07:16:09', '2019-10-04 15:16:09'),
('7bdb2c6e748dd41c0d736f73a23085b5cd7dd67dd7a3e47c701d6567b27e16b3c26e8b9aada07888', 2, 1, 'admin', '[]', 0, '2018-10-04 07:45:13', '2018-10-04 07:45:13', '2019-10-04 15:45:13'),
('c237bfe06f173c9877ef65ff74e19ae46581b3f7e3712b4fcf13a2ae6e01891e4a0855502df41aa6', 2, 1, 'admin', '[]', 0, '2018-10-04 07:47:17', '2018-10-04 07:47:17', '2019-10-04 15:47:17'),
('10d4421e1e38e17a1a91d3376538ae7c9a912129330181e76ac05f862a9025d73e7050dd2270120f', 2, 1, 'admin', '[]', 0, '2018-10-04 07:50:12', '2018-10-04 07:50:12', '2019-10-04 15:50:12'),
('4534400918b3826ba4db3596b11efca473f2331617ad2bcb166da09b36b234b5ff7dec00a1f46824', 2, 1, 'admin', '[]', 0, '2018-10-04 08:01:26', '2018-10-04 08:01:26', '2019-10-04 16:01:26'),
('1f35054d0e89fa3a51a0e7a8b8fbb2beeaf91452caa4262b53f024f7f256668fa8500e92b1d0ab56', 2, 1, 'admin', '[]', 0, '2018-10-04 08:16:27', '2018-10-04 08:16:27', '2019-10-04 16:16:27'),
('b67f6c907d0ac110dd31c72376e0c6aaa21b52a2ca4400eae04edb3a5ed055f0a8ca860fa0fa6a46', 2, 1, 'admin', '[]', 0, '2018-10-04 08:42:31', '2018-10-04 08:42:31', '2019-10-04 16:42:31'),
('64ac1ed06a4f42488c954ec001015265334348d3a90a5022ce17a8483ead0782f80d74b11ff42bd9', 2, 1, 'admin', '[]', 0, '2018-10-04 08:43:41', '2018-10-04 08:43:41', '2019-10-04 16:43:41'),
('0999ef4b612bdeaa2a2bb61bcac1e67bcf600d227a4fd8f7a2e51453c60246c946ad844457721187', 2, 1, 'admin', '[]', 0, '2018-10-04 08:59:40', '2018-10-04 08:59:40', '2019-10-04 16:59:40'),
('a7fd000a29f5cf2b7a37e37f3e80c6504be895e5f883bd845d16039a22b211557f7c1a187c4b1d53', 2, 1, 'admin', '[]', 0, '2018-10-05 00:08:36', '2018-10-05 00:08:36', '2019-10-05 08:08:36'),
('5f83a0af294c2341da3153cf7c73770178964645ece94784e83801b496777bcb042ac825f3980742', 2, 1, 'admin', '[]', 0, '2018-10-05 01:06:21', '2018-10-05 01:06:21', '2019-10-05 09:06:21'),
('176f9e7e5c39220ef72261a28e9cb857cb646dde3b903d8474ce23e13f3ece4ec8abbf7940c2c347', 2, 1, 'admin', '[]', 0, '2018-10-05 01:36:13', '2018-10-05 01:36:13', '2019-10-05 09:36:13'),
('5a014ab29acb180a3a2abb25fd738ba74523e37f7a62b33c10684c6dbc57156de55531620ad000f0', 2, 1, 'admin', '[]', 0, '2018-10-05 01:46:30', '2018-10-05 01:46:30', '2019-10-05 09:46:30'),
('360a4b8bdce34e2ea2eee8847431ff547e46c3ab6728add934ec682d6c2330410397ed38db492b80', 2, 1, 'admin', '[]', 0, '2018-10-05 01:47:30', '2018-10-05 01:47:30', '2019-10-05 09:47:30'),
('80454947b558c303e86d6235b2dd1d217e1f7220255d500ff9a1eea7b26363fe174a935babb7b61a', 2, 1, 'admin', '[]', 0, '2018-10-05 03:23:50', '2018-10-05 03:23:50', '2019-10-05 11:23:50'),
('73e69c2c18fa2d8df6bef5f957bbda96f3aeb249b63c1f7aa4412f547db795ff97a302a6e3a82bd2', 2, 1, 'admin', '[]', 0, '2018-10-05 07:09:01', '2018-10-05 07:09:01', '2019-10-05 15:09:01'),
('dbf49b48b8f220a7e7b1b004595f5448af37bf4441234a931bf734aaf4609a10c85cbce048e0a659', 2, 1, 'admin', '[]', 0, '2018-10-05 07:09:45', '2018-10-05 07:09:45', '2019-10-05 15:09:45'),
('2c869af05415a0c0934025b900a593c6f8564aae5f488e43eccd852ae666f68b7a702f65ee84d1a5', 2, 1, 'admin', '[]', 0, '2018-10-05 07:13:27', '2018-10-05 07:13:27', '2019-10-05 15:13:27'),
('fc64d6d5d9ec9d191fbcad4d05d989abae436e8c0b7fedd478c491f4a19ee07565dc32ba1c412b4d', 2, 1, 'admin', '[]', 0, '2018-10-05 07:15:21', '2018-10-05 07:15:21', '2019-10-05 15:15:21'),
('256f647563935f6c03073446af538738c03291fe71c0ea5366b86e1f73813fbf8dbfc777ef043b76', 2, 1, 'admin', '[]', 0, '2018-10-05 07:16:21', '2018-10-05 07:16:21', '2019-10-05 15:16:21'),
('debfef6edd89fab2a88b8d4060c706bfae0872e6667ead001765badc7ec8f7d5f61ba321aa76f871', 2, 1, 'admin', '[]', 0, '2018-10-05 07:33:34', '2018-10-05 07:33:34', '2019-10-05 15:33:34'),
('0b049695c95d1c3d0906d4400a019382aa48cac0bf72da7f43a723b392f81217a2cb94e6126bfb77', 2, 1, 'admin', '[]', 0, '2018-10-05 07:34:02', '2018-10-05 07:34:02', '2019-10-05 15:34:02'),
('f932e1c540f76702a7bf2fcff01d90736d38dd6fdafdaa32de65e0dd5b443edaa34d65414af64354', 2, 1, 'admin', '[]', 0, '2018-10-05 08:13:08', '2018-10-05 08:13:08', '2019-10-05 16:13:08'),
('d320e7349e914b67c820f3b25d5fe55da90699076ee182c25c98555888593736ba602d3673638606', 2, 1, 'admin', '[]', 0, '2018-10-05 08:58:14', '2018-10-05 08:58:14', '2019-10-05 16:58:14'),
('7088d87e4446083b55bc2b8ff137676080f55ca0b0595327a8e5a78e132311fd39563faece08595e', 2, 1, 'admin', '[]', 0, '2018-10-05 09:17:36', '2018-10-05 09:17:36', '2019-10-05 17:17:36'),
('5e572d53c8e37fe08d416c9866bf485b8f8580e7cf9730833fd2384e19341c97e212819a3cb7cb8f', 2, 1, 'admin', '[]', 0, '2018-10-05 10:30:49', '2018-10-05 10:30:49', '2019-10-05 18:30:49'),
('7d1a612732bd98e92e4a9f74502fdc175d549e0fcf12366e020d30dfd030d43b3846296356a90c50', 2, 1, 'admin', '[]', 0, '2018-10-05 10:31:07', '2018-10-05 10:31:07', '2019-10-05 18:31:07'),
('b30aeb5ca22138c4be71bec9e744b74c242abab2097bc28be0926ba67c95af6eceb5b33b7b79716c', 2, 1, 'admin', '[]', 0, '2018-10-05 10:31:42', '2018-10-05 10:31:42', '2019-10-05 18:31:42'),
('ecc1bc7b9b134a64fb71ef7761e76249155b4e4b2b21a831a43389535f063270626ac6ac73debe3b', 2, 1, 'admin', '[]', 0, '2018-10-05 10:34:59', '2018-10-05 10:34:59', '2019-10-05 18:34:59'),
('5fb913cc599f272ea26b825b8f1a267f50fed5cf61b5f4b24aa1a8c0bfbd9a0ed0a94736d5722867', 2, 1, 'admin', '[]', 0, '2018-10-05 10:35:53', '2018-10-05 10:35:53', '2019-10-05 18:35:53'),
('26c28aff23033905267d0a8eb44a5774604b01ec15c6ee53e388fc4b3fba8d5f7faa48baf2b1ce38', 2, 1, 'admin', '[]', 0, '2018-10-05 10:36:47', '2018-10-05 10:36:47', '2019-10-05 18:36:47'),
('dd05df3a1869965b1e8a8534b0cad08ad3b26af1964461058b1b07d3a5d42b58aaba46c6818019b8', 2, 1, 'admin', '[]', 0, '2018-10-05 10:40:34', '2018-10-05 10:40:34', '2019-10-05 18:40:34'),
('16eaca309442319c713daa7b94ec7a720b8c167e2be6b1b44e60ce7496812f34933c5028e5e5eed5', 2, 1, 'admin', '[]', 0, '2018-10-05 10:48:20', '2018-10-05 10:48:20', '2019-10-05 18:48:20'),
('b676b812be714add3837e59d4974727c70bc2014fb596a3ce3ac068e3f607cf7602cf81a6f77b12c', 2, 1, 'admin', '[]', 0, '2018-10-05 10:48:36', '2018-10-05 10:48:36', '2019-10-05 18:48:36'),
('a974550a6ed70acf226ba5cdfde54fd429eee6910e3164f9b3cb90f734b17794075743968015d2e2', 2, 1, 'admin', '[]', 0, '2018-10-05 10:49:21', '2018-10-05 10:49:21', '2019-10-05 18:49:21'),
('804fd93f9cb7d5747ba63e2faf356a4a30cee6614d13da9190509739cfd128d1c14fde88f4b7bd99', 2, 1, 'admin', '[]', 0, '2018-10-05 10:49:45', '2018-10-05 10:49:45', '2019-10-05 18:49:45'),
('169ecf5a04a2f00d883614c4a03cd89219fa6acf73c754f2ef440e746cc83c58784c5a9184565518', 2, 1, 'admin', '[]', 0, '2018-10-05 10:55:00', '2018-10-05 10:55:00', '2019-10-05 18:55:00'),
('98e87e79800600096378a695f20e1383dfc38ac5e6ec6830184a312bf7c1c4c64500f78c69ccb759', 2, 1, 'admin', '[]', 0, '2018-10-07 23:54:15', '2018-10-07 23:54:15', '2019-10-08 07:54:15'),
('3b4bacdf839ea5d25f69264e1758323caf9637f946efe2c2c6f7c32c4c7c3eb7d82e9ce7b49e9a05', 2, 1, 'admin', '[]', 0, '2018-10-08 00:40:25', '2018-10-08 00:40:25', '2019-10-08 08:40:25'),
('fd54cc996a3f04ca0e921ffae271fa3fb66c390922285ba50bfe7fc89ee2f5c64737ad49a458e1e3', 2, 1, 'admin', '[]', 0, '2018-10-08 00:43:39', '2018-10-08 00:43:39', '2019-10-08 08:43:39'),
('8036aa08f8006dc5246441bc1f8136d9a4bed1febc60d98fff56daa37bd393b1f80078cdf170bd56', 2, 1, 'admin', '[]', 0, '2018-10-08 01:43:39', '2018-10-08 01:43:39', '2019-10-08 09:43:39'),
('bae5f1ddd14bec0f01595835ae11849f4cd9f7150a38efb2645f4cc2d0b908c7a51cfe7190ef3797', 3, 1, 'admin', '[]', 0, '2018-10-08 03:49:28', '2018-10-08 03:49:28', '2019-10-08 11:49:28'),
('61ef8d65b406b98b0ff863a38ff3c060d27ec940b5706af196a11aa3db3ae78ae300ce8cfaceb220', 2, 1, 'admin', '[]', 0, '2018-10-08 03:49:38', '2018-10-08 03:49:38', '2019-10-08 11:49:38'),
('e366c18b79bb1aabefab1c2c35ce6343f635df6b9034130016e3a18f0ef9b99d417b7d7305d59c74', 2, 1, 'admin', '[]', 0, '2018-10-09 00:04:43', '2018-10-09 00:04:43', '2019-10-09 08:04:43'),
('fb83a386df27fb6acc0a877f60697b9162fe2485ed830b63d0feafe47a6d660a7e95accd3f4c9cfb', 2, 1, 'admin', '[]', 0, '2018-10-09 05:52:54', '2018-10-09 05:52:54', '2019-10-09 13:52:54'),
('f1d317b26445d977d83cf58dddcca2939f7fe508aebeb31b61287e3900d8e711bd9863b8f5aed354', 2, 1, 'admin', '[]', 0, '2018-10-09 05:55:44', '2018-10-09 05:55:44', '2019-10-09 13:55:44'),
('3411a96d908cad793be9cb61bc3464c99b81a8cfb8732c0fdcc12add07f8563374a4a5e25c0a4f50', 2, 1, 'admin', '[]', 0, '2018-10-09 05:56:40', '2018-10-09 05:56:40', '2019-10-09 13:56:40'),
('5b5ee7376b141b658b9ebbcfe591094c32621592e50f1e8bc2f76e8db9135ad8e8f8cfed33fe5368', 2, 1, 'admin', '[]', 0, '2018-10-09 05:57:02', '2018-10-09 05:57:02', '2019-10-09 13:57:02'),
('36553828e98b6d90ffcaba8d753c03fac58369df82d22ed7a59fdbd6e05c40ebfadce8d7fd92a220', 2, 1, 'admin', '[]', 0, '2018-10-09 05:59:17', '2018-10-09 05:59:17', '2019-10-09 13:59:17'),
('14240dae626f1f8bcb4a549cdee9f5c0cc3db9d6bc16dd0b3c62e1741156b2eba5f6031f680d3891', 2, 1, 'admin', '[]', 0, '2018-10-09 06:09:43', '2018-10-09 06:09:43', '2019-10-09 14:09:43'),
('d91f3dbec828f4d1acb8ced1f65f94bf7c96110cc3c231c3da92cc4258c4e710bcf095b9ed21da04', 2, 1, 'admin', '[]', 0, '2018-10-09 06:10:45', '2018-10-09 06:10:45', '2019-10-09 14:10:45'),
('a6b8cb0a2c3c58b2689b5a97a21d270f82352425c86db6275473d89c04f517f6fa47687debd38b32', 2, 1, 'admin', '[]', 0, '2018-10-09 06:11:00', '2018-10-09 06:11:00', '2019-10-09 14:11:00'),
('a54e896e6d50f507268207fe5ecbc3ccc4de7c6951597a38743de4abfc75b1ac61adcd35b671567f', 2, 1, 'admin', '[]', 0, '2018-10-11 00:18:22', '2018-10-11 00:18:22', '2019-10-11 08:18:22'),
('3d3be1b429199e0b3466df67f360a1cc58ada2be52587f8dd8ee54621e6f9253b2aa67becf2ff51f', 2, 1, 'admin', '[]', 0, '2018-10-12 05:26:51', '2018-10-12 05:26:51', '2019-10-12 13:26:51'),
('6fed2a5d7050226fc50d1c449fa1dffc40cf6ec2e11ff9206a731a0b1f573daeeb016b588cb3fc19', 2, 1, 'admin', '[]', 0, '2018-10-16 00:53:01', '2018-10-16 00:53:01', '2019-10-16 08:53:01'),
('72ec4c407cb67e49c78f307c9c2035605c3eda8835fdad340e0e1d885e61ec1b1b774388da4c342d', 2, 1, 'admin', '[]', 0, '2018-10-18 07:11:16', '2018-10-18 07:11:16', '2019-10-18 15:11:16'),
('05df215af2fcf20a1a2853045f20c07acd727c41708f0e2ab4e4df7abd431c7cad11215d395ad6df', 2, 1, 'admin', '[]', 0, '2018-10-19 08:05:07', '2018-10-19 08:05:07', '2019-10-19 16:05:07'),
('178ba863dca01ff1abd80dbec3fe7343d9edae3002474f44ba780c76db65ff72bf8d9795c94fbe22', 2, 1, 'admin', '[]', 0, '2018-10-22 00:05:04', '2018-10-22 00:05:04', '2019-10-22 08:05:04'),
('705ee0d41db203dbcd7aca9201ff4ec9d2408d4a2c0f37a625b28916f25e78a810bf3afc83d8471c', 2, 1, 'admin', '[]', 0, '2018-10-23 07:27:50', '2018-10-23 07:27:50', '2019-10-23 15:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'Gi1QSvVT3diyJhTpYBmMs90WzWY25Yqb0Nt4VT6e', 'http://localhost', 1, 0, 0, '2018-10-04 07:15:47', '2018-10-04 07:15:47'),
(2, NULL, 'Laravel Password Grant Client', 'Zb3yWfHtEsE4iIn8w0lgHojAtERJKhsUV08X64qQ', 'http://localhost', 0, 1, 0, '2018-10-04 07:15:47', '2018-10-04 07:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-10-04 07:15:47', '2018-10-04 07:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `text` text,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `order_num` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `image`, `text`, `site_id`, `order_num`, `parent_id`, `created_at`, `updated_at`) VALUES
(17, 'page1', NULL, '<p>page1</p>\n', 0, 2, 0, '2018-10-10 01:29:42', '2018-10-10 01:30:03'),
(18, 'page2', NULL, '<p>page2</p>\n', 0, 0, 17, '2018-10-10 01:29:50', '2018-10-10 03:47:31'),
(19, 'page3', 'images/cxLe4Y0LpwZgJCJ06Gm62XMLtxpLbIydnSvYUUWP.jpeg', '<p>page3121231231 13132131311</p>\n', 0, 1, 0, '2018-10-10 01:29:57', '2018-10-11 08:14:19'),
(20, '123123', 'images/sQeMuQB9KrEGJZjUkneABj72WTgQtdxtiE2QPzAu.jpeg', '<p>1232131</p>\n', 0, 0, 19, '2018-10-10 01:30:17', '2018-10-11 01:40:59'),
(21, '123124', 'images/vWx6wQozz5Y6PXzZeSy1zDM5JvsIXdD7tTp2AMmW.jpeg', '<p>12313214</p>\n', 0, 0, 19, '2018-10-10 01:30:30', '2018-10-11 01:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `finish_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `question`, `site_id`, `finish_date`, `status`, `created_at`, `updated_at`) VALUES
(5, 'sdfsdf', 0, NULL, 1, '2018-10-18 06:45:42', '2018-10-18 06:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `answer`, `created_at`, `updated_at`) VALUES
(14, 5, '2', '2018-10-18 06:45:42', '2018-10-18 06:45:42'),
(13, 5, '1', '2018-10-18 06:45:42', '2018-10-18 06:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `poll_results`
--

CREATE TABLE `poll_results` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL DEFAULT '0',
  `answer_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(500) DEFAULT NULL,
  `content` text,
  `short_content` varchar(1000) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-medee, 1-photo, 2-video',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-niitlegdsen, 0-noorog',
  `is_primary` tinyint(1) DEFAULT '0',
  `main_site_publish` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-ugui , 1-huleegdej biu, 2 nitlegdsen',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `admin_id`, `site_id`, `title`, `content`, `short_content`, `image`, `type`, `status`, `is_primary`, `main_site_publish`, `view_count`, `created_at`, `updated_at`) VALUES
(4, 2, 0, 'ASDAD', '<p>ASDASDADA</p>\n', '1231232112', 'images/EtNmu7kBSy0FOahXbG941HyS9tGq20sh4HkDYRH3.png', 0, 1, 0, 0, 0, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(2, 1, 0, '61 номын санч мэргэжил дээшлүүллээ', 'Мөрөн суманд төрийн үйлчилгээг иргэдэд ил тод хурдан шуурхай хүргэх, иргэдийн санал хүсэлтийг хүлээн авч танилцах холбогдох газарт уламжлан шийдвэрлэх боломжийг судлах, төрийн бодлого боловсруулахад иргэдийн оролцоог нэмэгдүүлж, төрөөс үзүүлж байгаа үйлчилгээг хүртээмжтэй, чирэгдэлгүй нэг цэгээс иргэдэд хүргэх, мэдээлэл авах боломжоор хангах зорилгоор багуудад “Иргэдээ сонсъё” нээлттэй хаалганы өдөрлөг зохион байгуулагдаж байна. Энэхүү арга хэмжээнд  төрийн бүхий л байгууллагын төлөөлөл оролцож байгаа бөгөөд иргэд түлээ, түлшний хөнгөлөлт, тэтгэвэр тэтгэмжийн тухай мэдээлэл сонирхож нарийн мэргэжлийн эмч нарт ихэвчлэн үзүүлж байлаа. Мөн ерөнхий боловсролын сургуулиудад үдийн цайгаар үйлчилдэг аж ахуйн нэгж, байгууллагууд оролцож иргэдэд бүтээгдэхүүний амталгааг үзүүлж байна. Иргэдээс гарсан санал санаачлагуудыг нэгтгэн цаашдын үйл ажиллагаандаа тусган ажиллах юм.', 'Мөрөн суманд төрийн үйлчилгээг иргэдэд ил тод хурдан шуурхай хүргэх, иргэдийн санал хүсэлтийг хүлээн авч танилцах холбогдох газарт уламжлан шийдвэрлэх боломжийг судлах, төрийн бодлого боловсруулахад иргэдийн оролцоог нэмэгдүүлж, төрөөс үзүүлж байгаа үйлчилгээг хүртээмжтэй, чирэгдэлгүй нэг цэгээс иргэдэд хүргэх, мэдээлэл авах боломжоор хангах зорилгоор багуудад “Иргэдээ сонсъё” нээлттэй хаалганы өдөрлөг зохион байгуулагдаж байна. Энэхүү арга хэмжээнд  төрийн бүхий л байгууллагын төлөөлөл оролцож байгаа бөгөөд иргэд түлээ, түлшний хөнгөлөлт, тэтгэвэр тэтгэмжийн тухай мэдээлэл сонирхож нарийн мэргэжлийн эмч нарт ихэвчлэн үзүүлж байлаа. Мөн ерөнхий боловсролын сургуулиудад үдийн цайгаар үйлчилдэг аж ахуйн нэгж, байгууллагууд оролцож иргэдэд бүтээгдэхүүний амталгааг үзүүлж байна. Иргэдээс гарсан санал санаачлагуудыг нэгтгэн цаашдын үйл ажиллагаандаа тусган ажиллах юм.', NULL, 0, 1, 0, 0, 0, '2018-10-19 04:12:28', NULL),
(3, 2, 0, 'ХИЛИЙН 0101 ДҮГЭЭР АНГИ 14 АЙЛЫН ОРОН СУУЦЫГ АШИГЛАЛТАНД ОРУУЛЛАА', '<p>ХИЛИЙН 0101 ДҮГЭЭР АНГИ 14 АЙЛЫН ОРОН СУУЦЫГ АШИГЛАЛТАНД ОРУУЛЛАА</p>\n\n<p><img src=\"http://selenge.gov.mn/beta/upload/images/dc86ac143383c2040cdee3e7e541440d.jpg\" style=\"float:left\" /></p>\n\n<p>Өнөөдөр аймгийн төв Сүхбаатар суманд аймгийн ИТХ, Засаг даргын дэмжлэгтэйгээр нэгэн шинэ орон сууц баригдаж ашиглалтанд орлоо. Монгол Улсын БААТАР Ж.Нэхийтийн нэрэмжит дэд хурандаа В.Намхайнямбуу захирагчтай Хилийн 0101 дүгээр ангийн хамт олон &ldquo;Хилчдийн нийгмийн хамгаалал 2024&rdquo; хөтөлбөрийн хүрээнд аймгийн удирдлагуудын дэмжлэгтэйгээр албан хаагчдынхаа нийгмийн асуудлыг шийдвэрлэх, орон сууцны фондыг нэмэгдүүлэх&nbsp;зорилгоор 14 айлын орон сууцыг ашиглалтанд оруулж албан ёсоор нээлтээ хийлээ.</p>\n\n<p><img alt=\"\" src=\"http://selenge.gov.mn/beta/upload/other/0101%20%D1%88%D0%B8%D0%BD%D1%8D%20%D0%B1%D0%B0%D0%B9%D1%800+750.jpg\" /></p>\n\n<p>Шинэ орон сууцны туузыг аймгийн ИТХ-ын дарга Г.Бямбаа, Засаг даргын орлогч Б.Нарантуяа, Хилийн 0101 дүгээр ангийн захирагч В.Намхайнямбуу, ХХЕГ-ын ХШҮДАГ-ын дарга хурандаа Д.Чойбаатар нарын албаны хүмүүс хайчиллаа. &ldquo;Хилчин хотхон&rdquo;-ны анхны эзэд энэ өдөр түлхүүрээ гардан авч төвлөрсөн дулаан, бохирт холбогдсон байраа хүлээн авав.</p>\n\n<p><img alt=\"\" src=\"http://selenge.gov.mn/beta/upload/other/0101%20%D1%88%D0%B8%D0%BD%D1%8D%20%D0%B1%D0%B0%D0%B9%D1%801+750.jpg\" /></p>\n', 'Өнөөдөр аймгийн төв Сүхбаатар суманд аймгийн ИТХ, Засаг даргын дэмжлэгтэйгээр нэгэн шинэ орон сууц баригдаж ашиглалтанд орлоо. Монгол Улсын БААТАР Ж.Нэхийтийн нэрэмжит дэд хурандаа В.Намхайнямбуу захирагчтай Хилийн 0101 дүгээр ангийн хамт олон “Хилчдийн нийгмийн хамгаалал 2024” хөтөлбөрийн хүрээнд аймгийн удирдлагуудын дэмжлэгтэйгээр албан хаагчдынхаа нийгмийн асуудлыг шийдвэрлэх, орон сууцны фондыг нэмэгдүүлэх зорилгоор 14 айлын орон сууцыг ашиглалтанд оруулж албан ёсоор нээлтээ хийлээ.', 'images/RJZRNqWViDlN8ABtvv2fxTLKousHcuj9YnwCuXjP.jpeg', 0, 0, 1, 0, 0, '2018-10-19 07:15:01', '2018-10-19 08:19:27'),
(5, 2, 49, '12312', '<p>123123</p>\n', '12312', 'images/z8wKVDSq4HOhNXkx0yZEqZz679CuGtD49ZzUwyM6.jpeg', 0, 1, 0, 2, 0, '2018-10-23 07:28:41', '2018-10-23 07:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` text COLLATE utf8mb4_unicode_ci,
  `contact` text COLLATE utf8mb4_unicode_ci,
  `sidebar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `domain`, `config`, `contact`, `sidebar`, `created_at`, `updated_at`) VALUES
(38, 'Бөмбөгөр', 'bumbugur', NULL, NULL, NULL, '2018-10-05 05:04:33', '2018-10-05 05:04:33'),
(37, 'Галуут', 'galuut', NULL, NULL, NULL, '2018-10-05 05:04:10', '2018-10-05 05:04:10'),
(36, 'Жаргалант', 'jargalant', NULL, NULL, NULL, '2018-10-05 05:03:59', '2018-10-05 05:03:59'),
(35, 'Заг', 'zag', NULL, NULL, NULL, '2018-10-05 05:03:47', '2018-10-05 05:03:47'),
(34, 'Хүрээмарал', 'hureemaral', NULL, NULL, NULL, '2018-10-05 05:03:37', '2018-10-05 05:03:37'),
(33, 'Эрдэнэцогт', 'erdenetsogt', NULL, NULL, NULL, '2018-10-05 05:03:14', '2018-10-05 05:03:14'),
(39, 'Баянцагаан', 'bayntsagaan', NULL, NULL, NULL, '2018-10-05 05:04:47', '2018-10-05 05:04:47'),
(40, 'Баян-Өндөр', 'bayanundur', NULL, NULL, NULL, '2018-10-05 05:12:34', '2018-10-05 05:12:34'),
(41, 'Баянлиг', 'bayanlig', NULL, NULL, NULL, '2018-10-05 05:12:59', '2018-10-05 05:12:59'),
(42, 'Баянбулаг', 'bayanbulag', NULL, NULL, NULL, '2018-10-05 05:13:45', '2018-10-05 05:13:45'),
(43, 'Шинэжинст', 'shinejist', NULL, NULL, NULL, '2018-10-05 05:14:25', '2018-10-05 05:14:25'),
(44, 'Өлзийт', 'ulziit', NULL, NULL, NULL, '2018-10-05 05:14:51', '2018-10-05 05:14:51'),
(45, 'Жинст', 'jinst', NULL, NULL, NULL, '2018-10-05 05:15:11', '2018-10-05 05:15:11'),
(46, 'Гурванбулаг', 'gurvanbulag', NULL, NULL, NULL, '2018-10-05 05:15:39', '2018-10-05 05:15:39'),
(47, 'Бууцагаан', 'buutsagaan', NULL, NULL, NULL, '2018-10-05 05:15:52', '2018-10-05 05:15:52'),
(48, 'Богд', 'bogd', NULL, NULL, NULL, '2018-10-05 05:16:05', '2018-10-05 05:16:05'),
(49, 'Баянхонгор', 'bayanhongor', NULL, NULL, NULL, '2018-10-05 05:16:44', '2018-10-05 05:16:44'),
(50, 'Баян-Овоо', 'bayan-ovoo', NULL, NULL, NULL, '2018-10-05 05:17:16', '2018-10-05 05:17:16'),
(51, 'Баянговь', 'bayangovi', NULL, NULL, NULL, '2018-10-05 05:17:35', '2018-10-05 05:17:35'),
(52, 'Баацагаан', 'baatsagaan', NULL, NULL, NULL, '2018-10-05 05:18:13', '2018-10-05 05:41:18'),
(0, 'Үндсэн сайт', 'bayankhongor.local', NULL, NULL, '<div class=\"asdada\">\n<iframe src=\"https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fontslokh.mn%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=998663530183828\" width=\"320\" height=\"500\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allow=\"encrypted-media\"></iframe>\n<div>\n\n<br><br>\n<img src=\"http://www.ontslokh.mn/wp-content/uploads/useful_banner_manager_banners/204-emc0banner3.jpg\"  class=\"image\">\n\n<br> <br>\n\n<iframe id=\"forecast_embed\" type=\"text/html\" frameborder=\"0\" height=\"310\" width=\"325\" src=\"http://tsag-agaar.gov.mn/embed/?name=287&color=ef6e25&color2=cc530e&color3=ffffff&color4=ffffff&type=vertical&tdegree=cwidth=320\"> </iframe>\n', '2018-10-05 05:03:14', '2018-10-18 09:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `urgudul`
--

CREATE TABLE `urgudul` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 sanal huselt, 1 urgudul,  2 gomdol',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(15) DEFAULT NULL,
  `reply` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urgudul`
--

INSERT INTO `urgudul` (`id`, `type`, `name`, `email`, `phone`, `content`, `image`, `status`, `ip`, `reply`, `created_at`, `updated_at`) VALUES
(4, 1, '123', '123', 9987124, '123', 'images/vWx6wQozz5Y6PXzZeSy1zDM5JvsIXdD7tTp2AMmW.jpeg', 1, '123', 'asd ad ad ad ad as dasda dad1 asdad asdad a', '2018-10-18 06:53:46', '2018-10-18 07:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `zar`
--

CREATE TABLE `zar` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zar`
--

INSERT INTO `zar` (`id`, `title`, `content`, `price`, `phone`, `email`, `cat_id`, `image`, `created_at`, `updated_at`) VALUES
(4, 'baishin zarna', 'hotiin tuvd 5 oroo bair zarna', 50000000, '99987079', 'bolloomn@gmail.com', 38, 'zar/GjRPGBzPXR9GyxNb2bH3GQWliJIkG0QNSpRfywE7.jpeg', '2018-10-17 07:22:29', '2018-10-17 07:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `zar_category`
--

CREATE TABLE `zar_category` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `order_num` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zar_category`
--

INSERT INTO `zar_category` (`id`, `name`, `site_id`, `order_num`, `parent_id`, `created_at`, `updated_at`) VALUES
(36, 'Гэр ахуйн бараа', 0, 13, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(37, 'Төхөөрөмж, барилгын материал, түлш', 0, 14, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(35, 'Цахилгаан бараа', 0, 12, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(34, 'Утас, дугаар', 0, 11, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(33, 'Компьютер сэлбэг хэрэгсэл', 0, 10, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(32, 'Хүүхдийн бараа', 0, 9, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(31, 'Мал амьтан, ургамал', 0, 8, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(30, 'Үйлчилгээ', 0, 7, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(28, 'Үнэгүй өгнө', 0, 5, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(29, 'Ажилд авна', 0, 6, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(27, 'Автомашин', 0, 4, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(38, 'орон сууц', 0, 0, 26, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(39, 'Хашаа байшин', 0, 1, 26, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(26, 'Үл хөдлөх', 0, 3, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(25, 'Хувцас хэрэглэл', 0, 2, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(24, 'Амралт, спорт, хобби ', 0, 1, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
(23, 'Эрүүл мэнд, гоо сайхан, хүнс', 0, 0, 0, '2018-10-17 09:10:07', '2018-10-17 09:10:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_category`
--
ALTER TABLE `file_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_to_category`
--
ALTER TABLE `file_to_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_category`
--
ALTER TABLE `link_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_to_category`
--
ALTER TABLE `news_to_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_to_sites`
--
ALTER TABLE `news_to_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_results`
--
ALTER TABLE `poll_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sites_domain_unique` (`domain`);

--
-- Indexes for table `urgudul`
--
ALTER TABLE `urgudul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zar`
--
ALTER TABLE `zar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zar_category`
--
ALTER TABLE `zar_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `file_category`
--
ALTER TABLE `file_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `file_to_category`
--
ALTER TABLE `file_to_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `link_category`
--
ALTER TABLE `link_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_to_category`
--
ALTER TABLE `news_to_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `news_to_sites`
--
ALTER TABLE `news_to_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `poll_results`
--
ALTER TABLE `poll_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `urgudul`
--
ALTER TABLE `urgudul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zar`
--
ALTER TABLE `zar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zar_category`
--
ALTER TABLE `zar_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
