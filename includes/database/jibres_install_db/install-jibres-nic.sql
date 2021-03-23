-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2021 at 10:08 AM
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
-- Database: `jibres_nic`
--
CREATE DATABASE IF NOT EXISTS `jibres_nic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jibres_nic`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `nic_id` varchar(30) DEFAULT NULL,
  `roid` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `holder` bit(1) DEFAULT NULL,
  `admin` bit(1) DEFAULT NULL,
  `tech` bit(1) DEFAULT NULL,
  `bill` bit(1) DEFAULT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `firstname_en` varchar(100) DEFAULT NULL,
  `lastname_en` varchar(100) DEFAULT NULL,
  `nationalcode` varchar(20) DEFAULT NULL,
  `passportcode` varchar(50) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `signator` varchar(200) DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT NULL,
  `jsonstatus` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactdetail`
--

CREATE TABLE `contactdetail` (
  `id` bigint UNSIGNED NOT NULL,
  `nic_id` varchar(300) DEFAULT NULL,
  `person` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `address` text,
  `phone` varchar(300) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `fax` varchar(300) DEFAULT NULL,
  `org` varchar(500) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `id` bigint UNSIGNED NOT NULL,
  `nic_id` varchar(100) DEFAULT NULL,
  `roid` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` text,
  `amount` int DEFAULT NULL,
  `balance` int DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dns`
--

CREATE TABLE `dns` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `ns1` varchar(100) DEFAULT NULL,
  `ip1` varchar(100) DEFAULT NULL,
  `ns2` varchar(100) DEFAULT NULL,
  `ip2` varchar(100) DEFAULT NULL,
  `ns3` varchar(100) DEFAULT NULL,
  `ip3` varchar(100) DEFAULT NULL,
  `ns4` varchar(100) DEFAULT NULL,
  `ip4` varchar(100) DEFAULT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `status` enum('enable','disable','deleted','expire') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `registrar` enum('irnic','onlinenic') DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` enum('awaiting','failed','pending','enable','disable','deleted','expire') DEFAULT NULL,
  `holder` varchar(30) DEFAULT NULL,
  `admin` varchar(30) DEFAULT NULL,
  `tech` varchar(30) DEFAULT NULL,
  `bill` varchar(30) DEFAULT NULL,
  `roid` varchar(100) DEFAULT NULL,
  `reseller` varchar(100) DEFAULT NULL,
  `autorenew` bit(1) DEFAULT NULL,
  `renewtry` timestamp NULL DEFAULT NULL,
  `renewnotif` timestamp NULL DEFAULT NULL,
  `lock` bit(1) DEFAULT NULL,
  `verify` bit(1) DEFAULT NULL,
  `nicstatus` text,
  `dns` int UNSIGNED DEFAULT NULL,
  `dateregister` timestamp NULL DEFAULT NULL,
  `dateexpire` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `lastfetch` timestamp NULL DEFAULT NULL,
  `dateupdate` timestamp NULL DEFAULT NULL,
  `ns1` varchar(200) DEFAULT NULL,
  `ns2` varchar(200) DEFAULT NULL,
  `ns3` varchar(200) DEFAULT NULL,
  `ns4` varchar(200) DEFAULT NULL,
  `ip1` varchar(200) DEFAULT NULL,
  `ip2` varchar(200) DEFAULT NULL,
  `ip3` varchar(200) DEFAULT NULL,
  `ip4` varchar(200) DEFAULT NULL,
  `available` bit(1) DEFAULT NULL,
  `gateway` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `ownercheckdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domainaction`
--

CREATE TABLE `domainaction` (
  `id` bigint UNSIGNED NOT NULL,
  `domain_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','deleted','expire') DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `mode` enum('auto','manual') DEFAULT NULL,
  `detail` text,
  `date` timestamp NULL DEFAULT NULL,
  `price` int UNSIGNED DEFAULT NULL,
  `discount` int UNSIGNED DEFAULT NULL,
  `transaction_id` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `period` smallint DEFAULT NULL,
  `domainname` varchar(300) DEFAULT NULL,
  `finalprice` bigint UNSIGNED DEFAULT NULL,
  `giftusage_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domainbilling`
--

CREATE TABLE `domainbilling` (
  `id` bigint UNSIGNED NOT NULL,
  `domain_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `action` enum('register','renew','transfer','delete') DEFAULT NULL,
  `status` enum('enable','disable','deleted','expire') DEFAULT NULL,
  `mode` enum('auto','manual') DEFAULT NULL,
  `detail` text,
  `date` timestamp NULL DEFAULT NULL,
  `period` smallint UNSIGNED DEFAULT NULL,
  `price` int UNSIGNED DEFAULT NULL,
  `discount` int UNSIGNED DEFAULT NULL,
  `transaction_id` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `finalprice` bigint UNSIGNED DEFAULT NULL,
  `giftusage_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domainstatus`
--

CREATE TABLE `domainstatus` (
  `id` bigint UNSIGNED NOT NULL,
  `domain` varchar(300) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` bigint UNSIGNED NOT NULL,
  `server_id` varchar(50) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `nic_id` varchar(50) DEFAULT NULL,
  `notif_count` int UNSIGNED DEFAULT NULL,
  `index` varchar(500) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `detail` text,
  `read` bit(1) DEFAULT NULL,
  `acknowledge` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usersetting`
--

CREATE TABLE `usersetting` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `autorenewperiod` varchar(100) DEFAULT NULL,
  `defaultautorenew` bit(1) DEFAULT NULL,
  `autorenewperiodcom` varchar(50) DEFAULT NULL,
  `domainlifetime` varchar(100) DEFAULT NULL,
  `notifsms` bit(1) DEFAULT NULL,
  `notifemail` bit(1) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `firstname_en` varchar(100) DEFAULT NULL,
  `lastname_en` varchar(100) DEFAULT NULL,
  `nationalcode` varchar(20) DEFAULT NULL,
  `passportcode` varchar(50) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `faxcc` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `phonecc` varchar(50) DEFAULT NULL,
  `ns1` varchar(200) DEFAULT NULL,
  `ns2` varchar(200) DEFAULT NULL,
  `ns3` varchar(200) DEFAULT NULL,
  `ns4` varchar(200) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_index_search_nic_id` (`nic_id`);

--
-- Indexes for table `contactdetail`
--
ALTER TABLE `contactdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactdetail_nic_id` (`nic_id`),
  ADD KEY `contactdetail_email` (`email`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dns`
--
ALTER TABLE `dns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domain_index_search_name` (`name`),
  ADD KEY `domain_index_search_user_id` (`user_id`),
  ADD KEY `domain_index_search_dns` (`dns`),
  ADD KEY `domain_search_index_verify` (`verify`),
  ADD KEY `domain_search_index_available` (`available`),
  ADD KEY `domain_search_index_autorenew` (`autorenew`),
  ADD KEY `domain_index_search_mobile` (`mobile`),
  ADD KEY `domain_index_search_email` (`email`),
  ADD KEY `domain_index_search_ownercheckdate` (`ownercheckdate`);

--
-- Indexes for table `domainaction`
--
ALTER TABLE `domainaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domainaction_domain_id` (`domain_id`);

--
-- Indexes for table `domainbilling`
--
ALTER TABLE `domainbilling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domainbilling_domain_id` (`domain_id`);

--
-- Indexes for table `domainstatus`
--
ALTER TABLE `domainstatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domainstatus_domain` (`domain`),
  ADD KEY `domainstatus_status` (`status`),
  ADD KEY `domainstatus_active` (`active`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersetting`
--
ALTER TABLE `usersetting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersetting_index_search_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactdetail`
--
ALTER TABLE `contactdetail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dns`
--
ALTER TABLE `dns`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domainaction`
--
ALTER TABLE `domainaction`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domainbilling`
--
ALTER TABLE `domainbilling`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domainstatus`
--
ALTER TABLE `domainstatus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersetting`
--
ALTER TABLE `usersetting`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `domain_dns` FOREIGN KEY (`dns`) REFERENCES `dns` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `domainaction`
--
ALTER TABLE `domainaction`
  ADD CONSTRAINT `domainaction_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `domainbilling`
--
ALTER TABLE `domainbilling`
  ADD CONSTRAINT `domainbilling_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
