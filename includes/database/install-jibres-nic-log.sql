-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2021 at 10:10 AM
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
-- Database: `jibres_nic_log`
--
CREATE DATABASE IF NOT EXISTS `jibres_nic_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jibres_nic_log`;

-- --------------------------------------------------------

--
-- Table structure for table `domainactivity`
--

CREATE TABLE `domainactivity` (
  `id` bigint UNSIGNED NOT NULL,
  `domain_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `available` bit(1) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `result` text,
  `runtime` text,
  `holder` varchar(30) DEFAULT NULL,
  `admin` varchar(30) DEFAULT NULL,
  `tech` varchar(30) DEFAULT NULL,
  `bill` varchar(30) DEFAULT NULL,
  `nicstatus` text,
  `reseller` varchar(100) DEFAULT NULL,
  `roid` varchar(100) DEFAULT NULL,
  `dateregister` timestamp NULL DEFAULT NULL,
  `dateexpire` timestamp NULL DEFAULT NULL,
  `ns1` varchar(200) DEFAULT NULL,
  `ns2` varchar(200) DEFAULT NULL,
  `ns3` varchar(200) DEFAULT NULL,
  `ns4` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint UNSIGNED NOT NULL,
  `domain` varchar(300) DEFAULT NULL,
  `root` varchar(300) DEFAULT NULL,
  `tld` varchar(300) DEFAULT NULL,
  `domainlen` smallint DEFAULT NULL,
  `registrar` varchar(200) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `dateregister` timestamp NULL DEFAULT NULL,
  `dateexpire` timestamp NULL DEFAULT NULL,
  `dateupdate` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `ns1` varchar(200) DEFAULT NULL,
  `ns2` varchar(200) DEFAULT NULL,
  `ns3` varchar(200) DEFAULT NULL,
  `ns4` varchar(200) DEFAULT NULL,
  `holder` varchar(30) DEFAULT NULL,
  `admin` varchar(30) DEFAULT NULL,
  `tech` varchar(30) DEFAULT NULL,
  `bill` varchar(30) DEFAULT NULL,
  `nicstatus` text,
  `reseller` varchar(100) DEFAULT NULL,
  `roid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `type` enum('whois','contact_check','contact_info','contact_create','contact_update','contact_credit','domain_check','domain_lock','domain_unlock','domain_info','domain_create','domain_update','domain_renew','domain_delete','domain_transfer','poll_request','poll_acknowledge') DEFAULT NULL,
  `send` text,
  `response` text,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `nic_id` varchar(100) DEFAULT NULL,
  `server_id` varchar(100) DEFAULT NULL,
  `client_id` varchar(100) DEFAULT NULL,
  `result_code` varchar(100) DEFAULT NULL,
  `request_count` smallint DEFAULT NULL,
  `result` text,
  `domain` varchar(200) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `gateway` enum('system','user','api') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domainactivity`
--
ALTER TABLE `domainactivity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domainactivity_domain_id` (`domain_id`),
  ADD KEY `domainactivity_index_search_type` (`type`),
  ADD KEY `domainactivity_index_search_available` (`available`),
  ADD KEY `domainactivity_index_search_user_id` (`user_id`),
  ADD KEY `domainactivity_search_index_available` (`available`),
  ADD KEY `domainactivity_search_index_type` (`type`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domains_index_search_domain` (`domain`),
  ADD KEY `domains_index_search_root` (`root`),
  ADD KEY `domains_index_search_tld` (`tld`),
  ADD KEY `domains_index_search_datecreated` (`datecreated`),
  ADD KEY `domains_index_search_dateexpire` (`dateexpire`),
  ADD KEY `domains_index_search_domainlen` (`domainlen`),
  ADD KEY `domains_search_index_registrar` (`registrar`),
  ADD KEY `domains_index_search_len` (`domainlen`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_index_search_type` (`type`),
  ADD KEY `log_index_search_user_id` (`user_id`),
  ADD KEY `log_index_search_datesend` (`datesend`),
  ADD KEY `log_index_search_domain` (`domain`),
  ADD KEY `log_index_search_nic_id` (`nic_id`),
  ADD KEY `result_code` (`result_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domainactivity`
--
ALTER TABLE `domainactivity`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `domainactivity`
--
ALTER TABLE `domainactivity`
  ADD CONSTRAINT `domainactivity_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
