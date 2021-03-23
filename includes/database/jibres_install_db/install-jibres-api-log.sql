-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2021 at 10:09 AM
-- Server version: 8.0.23
-- PHP Version: 7.3.27-9+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jibres_api_log`
--
CREATE DATABASE IF NOT EXISTS `jibres_api_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jibres_api_log`;

-- --------------------------------------------------------

--
-- Table structure for table `apilog`
--

CREATE TABLE `apilog` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `apikey` varchar(100) DEFAULT NULL,
  `appkey` varchar(100) DEFAULT NULL,
  `zoneid` varchar(100) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `method` varchar(200) DEFAULT NULL,
  `header` mediumtext,
  `headerlen` int UNSIGNED DEFAULT NULL,
  `body` mediumtext,
  `bodylen` int UNSIGNED DEFAULT NULL,
  `datesend` timestamp NULL DEFAULT NULL,
  `pagestatus` varchar(100) DEFAULT NULL,
  `resultstatus` varchar(100) DEFAULT NULL,
  `responseheader` mediumtext,
  `responsebody` mediumtext,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `responselen` int UNSIGNED DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `urlmd5` char(32) DEFAULT NULL,
  `notif` mediumtext,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kavenegar`
--

CREATE TABLE `kavenegar` (
  `id` bigint UNSIGNED NOT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `mobiles` text,
  `message` text,
  `urlmd5` char(32) DEFAULT NULL,
  `url` text,
  `mode` enum('sms','call','tts') DEFAULT NULL,
  `type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `store_id` int UNSIGNED DEFAULT NULL,
  `ip_id` int UNSIGNED DEFAULT NULL,
  `ip_md5` char(32) DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `line` varchar(100) DEFAULT NULL,
  `apikey` text,
  `response` text,
  `send` text,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apilog`
--
ALTER TABLE `apilog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_version` (`version`),
  ADD KEY `index_search_token` (`token`),
  ADD KEY `index_search_apikey` (`apikey`),
  ADD KEY `index_search_appkey` (`appkey`),
  ADD KEY `index_search_zoneid` (`zoneid`),
  ADD KEY `index_search_method` (`method`),
  ADD KEY `index_search_headerlen` (`headerlen`),
  ADD KEY `index_search_bodylen` (`bodylen`),
  ADD KEY `index_search_pagestatus` (`pagestatus`),
  ADD KEY `index_search_resultstatus` (`resultstatus`),
  ADD KEY `index_search_responselen` (`responselen`),
  ADD KEY `index_search_urlmd5` (`urlmd5`),
  ADD KEY `index_search_subdomain` (`subdomain`);

--
-- Indexes for table `kavenegar`
--
ALTER TABLE `kavenegar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jibres_api_log_kavenegar_mobile` (`mobile`),
  ADD KEY `jibres_api_log_kavenegar_urlmd5` (`urlmd5`),
  ADD KEY `jibres_api_log_kavenegar_type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apilog`
--
ALTER TABLE `apilog`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kavenegar`
--
ALTER TABLE `kavenegar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
