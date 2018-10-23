-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 23, 2018 at 03:09 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(36, 'asdad', 0, 0, 0, '2018-10-12 04:21:45', '2018-10-12 04:21:45');

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
(16, 4, 33, '2018-10-19 08:22:00', '2018-10-19 08:22:00');

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
  `view_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `admin_id`, `site_id`, `title`, `content`, `short_content`, `image`, `type`, `status`, `is_primary`, `view_count`, `created_at`, `updated_at`) VALUES
(4, 2, 0, 'ASDAD', '<p>ASDASDADA</p>\n', '1231232112', 'images/EtNmu7kBSy0FOahXbG941HyS9tGq20sh4HkDYRH3.png', 0, 1, 0, 0, '2018-10-19 08:22:00', '2018-10-19 08:22:00'),
(2, 1, 0, '61 номын санч мэргэжил дээшлүүллээ', 'Мөрөн суманд төрийн үйлчилгээг иргэдэд ил тод хурдан шуурхай хүргэх, иргэдийн санал хүсэлтийг хүлээн авч танилцах холбогдох газарт уламжлан шийдвэрлэх боломжийг судлах, төрийн бодлого боловсруулахад иргэдийн оролцоог нэмэгдүүлж, төрөөс үзүүлж байгаа үйлчилгээг хүртээмжтэй, чирэгдэлгүй нэг цэгээс иргэдэд хүргэх, мэдээлэл авах боломжоор хангах зорилгоор багуудад “Иргэдээ сонсъё” нээлттэй хаалганы өдөрлөг зохион байгуулагдаж байна. Энэхүү арга хэмжээнд  төрийн бүхий л байгууллагын төлөөлөл оролцож байгаа бөгөөд иргэд түлээ, түлшний хөнгөлөлт, тэтгэвэр тэтгэмжийн тухай мэдээлэл сонирхож нарийн мэргэжлийн эмч нарт ихэвчлэн үзүүлж байлаа. Мөн ерөнхий боловсролын сургуулиудад үдийн цайгаар үйлчилдэг аж ахуйн нэгж, байгууллагууд оролцож иргэдэд бүтээгдэхүүний амталгааг үзүүлж байна. Иргэдээс гарсан санал санаачлагуудыг нэгтгэн цаашдын үйл ажиллагаандаа тусган ажиллах юм.', 'Мөрөн суманд төрийн үйлчилгээг иргэдэд ил тод хурдан шуурхай хүргэх, иргэдийн санал хүсэлтийг хүлээн авч танилцах холбогдох газарт уламжлан шийдвэрлэх боломжийг судлах, төрийн бодлого боловсруулахад иргэдийн оролцоог нэмэгдүүлж, төрөөс үзүүлж байгаа үйлчилгээг хүртээмжтэй, чирэгдэлгүй нэг цэгээс иргэдэд хүргэх, мэдээлэл авах боломжоор хангах зорилгоор багуудад “Иргэдээ сонсъё” нээлттэй хаалганы өдөрлөг зохион байгуулагдаж байна. Энэхүү арга хэмжээнд  төрийн бүхий л байгууллагын төлөөлөл оролцож байгаа бөгөөд иргэд түлээ, түлшний хөнгөлөлт, тэтгэвэр тэтгэмжийн тухай мэдээлэл сонирхож нарийн мэргэжлийн эмч нарт ихэвчлэн үзүүлж байлаа. Мөн ерөнхий боловсролын сургуулиудад үдийн цайгаар үйлчилдэг аж ахуйн нэгж, байгууллагууд оролцож иргэдэд бүтээгдэхүүний амталгааг үзүүлж байна. Иргэдээс гарсан санал санаачлагуудыг нэгтгэн цаашдын үйл ажиллагаандаа тусган ажиллах юм.', NULL, 0, 1, 0, 0, '2018-10-19 04:12:28', NULL),
(3, 2, 0, 'ХИЛИЙН 0101 ДҮГЭЭР АНГИ 14 АЙЛЫН ОРОН СУУЦЫГ АШИГЛАЛТАНД ОРУУЛЛАА', '<p>ХИЛИЙН 0101 ДҮГЭЭР АНГИ 14 АЙЛЫН ОРОН СУУЦЫГ АШИГЛАЛТАНД ОРУУЛЛАА</p>\n\n<p><img src=\"http://selenge.gov.mn/beta/upload/images/dc86ac143383c2040cdee3e7e541440d.jpg\" style=\"float:left\" /></p>\n\n<p>Өнөөдөр аймгийн төв Сүхбаатар суманд аймгийн ИТХ, Засаг даргын дэмжлэгтэйгээр нэгэн шинэ орон сууц баригдаж ашиглалтанд орлоо. Монгол Улсын БААТАР Ж.Нэхийтийн нэрэмжит дэд хурандаа В.Намхайнямбуу захирагчтай Хилийн 0101 дүгээр ангийн хамт олон &ldquo;Хилчдийн нийгмийн хамгаалал 2024&rdquo; хөтөлбөрийн хүрээнд аймгийн удирдлагуудын дэмжлэгтэйгээр албан хаагчдынхаа нийгмийн асуудлыг шийдвэрлэх, орон сууцны фондыг нэмэгдүүлэх&nbsp;зорилгоор 14 айлын орон сууцыг ашиглалтанд оруулж албан ёсоор нээлтээ хийлээ.</p>\n\n<p><img alt=\"\" src=\"http://selenge.gov.mn/beta/upload/other/0101%20%D1%88%D0%B8%D0%BD%D1%8D%20%D0%B1%D0%B0%D0%B9%D1%800+750.jpg\" /></p>\n\n<p>Шинэ орон сууцны туузыг аймгийн ИТХ-ын дарга Г.Бямбаа, Засаг даргын орлогч Б.Нарантуяа, Хилийн 0101 дүгээр ангийн захирагч В.Намхайнямбуу, ХХЕГ-ын ХШҮДАГ-ын дарга хурандаа Д.Чойбаатар нарын албаны хүмүүс хайчиллаа. &ldquo;Хилчин хотхон&rdquo;-ны анхны эзэд энэ өдөр түлхүүрээ гардан авч төвлөрсөн дулаан, бохирт холбогдсон байраа хүлээн авав.</p>\n\n<p><img alt=\"\" src=\"http://selenge.gov.mn/beta/upload/other/0101%20%D1%88%D0%B8%D0%BD%D1%8D%20%D0%B1%D0%B0%D0%B9%D1%801+750.jpg\" /></p>\n', 'Өнөөдөр аймгийн төв Сүхбаатар суманд аймгийн ИТХ, Засаг даргын дэмжлэгтэйгээр нэгэн шинэ орон сууц баригдаж ашиглалтанд орлоо. Монгол Улсын БААТАР Ж.Нэхийтийн нэрэмжит дэд хурандаа В.Намхайнямбуу захирагчтай Хилийн 0101 дүгээр ангийн хамт олон “Хилчдийн нийгмийн хамгаалал 2024” хөтөлбөрийн хүрээнд аймгийн удирдлагуудын дэмжлэгтэйгээр албан хаагчдынхаа нийгмийн асуудлыг шийдвэрлэх, орон сууцны фондыг нэмэгдүүлэх зорилгоор 14 айлын орон сууцыг ашиглалтанд оруулж албан ёсоор нээлтээ хийлээ.', 'images/RJZRNqWViDlN8ABtvv2fxTLKousHcuj9YnwCuXjP.jpeg', 0, 0, 1, 0, '2018-10-19 07:15:01', '2018-10-19 08:19:27');

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
  `menu` text COLLATE utf8mb4_unicode_ci,
  `sidebar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `domain`, `config`, `contact`, `menu`, `sidebar`, `created_at`, `updated_at`) VALUES
(38, 'Бөмбөгөр', 'bumbugur', NULL, NULL, NULL, NULL, '2018-10-05 05:04:33', '2018-10-05 05:04:33'),
(37, 'Галуут', 'galuut', NULL, NULL, NULL, NULL, '2018-10-05 05:04:10', '2018-10-05 05:04:10'),
(36, 'Жаргалант', 'jargalant', NULL, NULL, NULL, NULL, '2018-10-05 05:03:59', '2018-10-05 05:03:59'),
(35, 'Заг', 'zag', NULL, NULL, NULL, NULL, '2018-10-05 05:03:47', '2018-10-05 05:03:47'),
(34, 'Хүрээмарал', 'hureemaral', NULL, NULL, NULL, NULL, '2018-10-05 05:03:37', '2018-10-05 05:03:37'),
(33, 'Эрдэнэцогт', 'erdenetsogt', NULL, NULL, NULL, NULL, '2018-10-05 05:03:14', '2018-10-05 05:03:14'),
(39, 'Баянцагаан', 'bayntsagaan', NULL, NULL, NULL, NULL, '2018-10-05 05:04:47', '2018-10-05 05:04:47'),
(40, 'Баян-Өндөр', 'bayanundur', NULL, NULL, NULL, NULL, '2018-10-05 05:12:34', '2018-10-05 05:12:34'),
(41, 'Баянлиг', 'bayanlig', NULL, NULL, NULL, NULL, '2018-10-05 05:12:59', '2018-10-05 05:12:59'),
(42, 'Баянбулаг', 'bayanbulag', NULL, NULL, NULL, NULL, '2018-10-05 05:13:45', '2018-10-05 05:13:45'),
(43, 'Шинэжинст', 'shinejist', NULL, NULL, NULL, NULL, '2018-10-05 05:14:25', '2018-10-05 05:14:25'),
(44, 'Өлзийт', 'ulziit', NULL, NULL, NULL, NULL, '2018-10-05 05:14:51', '2018-10-05 05:14:51'),
(45, 'Жинст', 'jinst', NULL, NULL, NULL, NULL, '2018-10-05 05:15:11', '2018-10-05 05:15:11'),
(46, 'Гурванбулаг', 'gurvanbulag', NULL, NULL, NULL, NULL, '2018-10-05 05:15:39', '2018-10-05 05:15:39'),
(47, 'Бууцагаан', 'buutsagaan', NULL, NULL, NULL, NULL, '2018-10-05 05:15:52', '2018-10-05 05:15:52'),
(48, 'Богд', 'bogd', NULL, NULL, NULL, NULL, '2018-10-05 05:16:05', '2018-10-05 05:16:05'),
(49, 'Баянхонгор', 'bayanhongor', NULL, NULL, NULL, NULL, '2018-10-05 05:16:44', '2018-10-05 05:16:44'),
(50, 'Баян-Овоо', 'bayan-ovoo', NULL, NULL, NULL, NULL, '2018-10-05 05:17:16', '2018-10-05 05:17:16'),
(51, 'Баянговь', 'bayangovi', NULL, NULL, NULL, NULL, '2018-10-05 05:17:35', '2018-10-05 05:17:35'),
(52, 'Баацагаан', 'baatsagaan', NULL, NULL, NULL, NULL, '2018-10-05 05:18:13', '2018-10-05 05:41:18'),
(0, 'Үндсэн сайт', 'bayankhongor.local', NULL, NULL, NULL, '<div class=\"asdada\">\n<iframe src=\"https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fontslokh.mn%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=998663530183828\" width=\"320\" height=\"500\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allow=\"encrypted-media\"></iframe>\n<div>\n\n<br><br>\n<img src=\"http://www.ontslokh.mn/wp-content/uploads/useful_banner_manager_banners/204-emc0banner3.jpg\"  class=\"image\">\n\n<br> <br>\n\n<iframe id=\"forecast_embed\" type=\"text/html\" frameborder=\"0\" height=\"310\" width=\"325\" src=\"http://tsag-agaar.gov.mn/embed/?name=287&color=ef6e25&color2=cc530e&color3=ffffff&color4=ffffff&type=vertical&tdegree=cwidth=320\"> </iframe>\n', '2018-10-05 05:03:14', '2018-10-18 09:01:24');

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
(25, 'Хувцас хэрэглэл', 0, 2, 38, '2018-10-17 09:10:07', '2018-10-17 09:10:07'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_to_category`
--
ALTER TABLE `news_to_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
