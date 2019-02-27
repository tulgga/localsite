-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 02:38 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

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
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `Vid` varchar(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `intro` mediumtext,
  `images` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `approve` int(1) NOT NULL DEFAULT '0',
  `created` varchar(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `Vid`, `name`, `intro`, `images`, `status`, `approve`, `created`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'VOL296494', 'Help to get water in Africa', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, voluptua.', 'image-1.jpg', 1, 0, 'USR196494', '2019-02-01', '2019-02-08', '2019-02-13 00:44:24', NULL),
(2, 'VOL123654', 'Help for education of kids', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, voluptua.', 'image-2.jpg', 1, 0, 'ORG483265', '2019-02-04', '2019-02-08', '2019-02-13 01:36:14', NULL),
(3, 'VOL321654', 'Spend food in Ughanda food in Ughanda', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, voluptua, consetetur sadipscing elitr, voluptua.', 'image-3.jpg', 1, 0, 'ORG159654', '2019-02-01', '2019-02-05', '2019-02-13 01:50:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_likes`
--

CREATE TABLE `volunteers_likes` (
  `id` int(11) NOT NULL,
  `Oid` int(11) NOT NULL DEFAULT '0',
  `Vid` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volun_covereds`
--

CREATE TABLE `volun_covereds` (
  `id` int(11) NOT NULL,
  `volunteers_id` int(11) DEFAULT NULL,
  `uo_Oid` varchar(7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volun_organizations`
--

CREATE TABLE `volun_organizations` (
  `id` int(11) NOT NULL,
  `Oid` varchar(250) DEFAULT NULL,
  `CompanyName` varchar(500) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `Direction` int(11) DEFAULT '0',
  `Address` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `emergencyName` varchar(250) DEFAULT NULL,
  `emergencyPhone` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volun_organizations`
--

INSERT INTO `volun_organizations` (`id`, `Oid`, `CompanyName`, `createDate`, `Direction`, `Address`, `Email`, `Phone`, `Password`, `emergencyName`, `emergencyPhone`, `created_at`, `updated_at`) VALUES
(1, 'ORG483265', NULL, NULL, 0, NULL, 'towersoftllc@yahoo.com', 70001011, '8dd54ee89a8bba1ca1863897dea45827', NULL, NULL, '2019-02-13 01:45:13', '2019-02-13 01:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `volun_ratings`
--

CREATE TABLE `volun_ratings` (
  `id` int(11) NOT NULL,
  `Uid` varchar(11) DEFAULT NULL,
  `Vid` varchar(11) DEFAULT NULL,
  `value` int(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `volun_users`
--

CREATE TABLE `volun_users` (
  `id` int(11) NOT NULL,
  `Oid` varchar(250) DEFAULT NULL,
  `FullName` varchar(500) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `CellPhone` int(10) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` int(1) NOT NULL DEFAULT '0',
  `HomeAddress1` varchar(500) DEFAULT NULL,
  `HomeAddress2` varchar(500) DEFAULT NULL,
  `EmergencyName` varchar(250) DEFAULT NULL,
  `EmergencyPhone` int(10) DEFAULT NULL,
  `Password` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volun_users`
--

INSERT INTO `volun_users` (`id`, `Oid`, `FullName`, `Email`, `CellPhone`, `DateOfBirth`, `Gender`, `HomeAddress1`, `HomeAddress2`, `EmergencyName`, `EmergencyPhone`, `Password`, `created_at`, `updated_at`) VALUES
(3, 'USR196494', NULL, 'tulggga@gmail.com', 89065516, NULL, 0, NULL, NULL, NULL, NULL, 'ea5919ac95a9adcde49def7dc29c3d76', '2019-02-12 05:17:54', '2019-02-12 05:17:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers_likes`
--
ALTER TABLE `volunteers_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volun_covereds`
--
ALTER TABLE `volun_covereds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volun_organizations`
--
ALTER TABLE `volun_organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volun_ratings`
--
ALTER TABLE `volun_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volun_users`
--
ALTER TABLE `volun_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `volunteers_likes`
--
ALTER TABLE `volunteers_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volun_covereds`
--
ALTER TABLE `volun_covereds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volun_organizations`
--
ALTER TABLE `volun_organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `volun_ratings`
--
ALTER TABLE `volun_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volun_users`
--
ALTER TABLE `volun_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
