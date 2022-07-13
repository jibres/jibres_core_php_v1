-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: server-host    Database: jibres_nic
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `jibres_nic`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jibres_nic` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `jibres_nic`;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
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
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_index_search_nic_id` (`nic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=377 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contactdetail`
--

DROP TABLE IF EXISTS `contactdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactdetail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nic_id` varchar(300) DEFAULT NULL,
  `person` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `address` text,
  `phone` varchar(300) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `fax` varchar(300) DEFAULT NULL,
  `org` varchar(500) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactdetail_nic_id` (`nic_id`),
  KEY `contactdetail_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2697 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `credit`
--

DROP TABLE IF EXISTS `credit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nic_id` varchar(100) DEFAULT NULL,
  `roid` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` text,
  `amount` int DEFAULT NULL,
  `balance` int DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `domain` varchar(200) DEFAULT NULL,
  `refund_transaction_id` bigint unsigned DEFAULT NULL,
  `meta` text,
  PRIMARY KEY (`id`),
  KEY `nic_credit_index_domain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=6174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dns`
--

DROP TABLE IF EXISTS `dns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dns` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
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
  `datecreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domain` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
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
  `dns` int unsigned DEFAULT NULL,
  `dateregister` timestamp NULL DEFAULT NULL,
  `dateexpire` date DEFAULT NULL,
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
  `email_tech` varchar(200) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `ownercheckdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_index_search_name` (`name`),
  KEY `domain_index_search_user_id` (`user_id`),
  KEY `domain_index_search_dns` (`dns`),
  KEY `domain_search_index_verify` (`verify`),
  KEY `domain_search_index_available` (`available`),
  KEY `domain_search_index_autorenew` (`autorenew`),
  KEY `domain_index_search_mobile` (`mobile`),
  KEY `domain_index_search_email` (`email`),
  KEY `domain_index_search_ownercheckdate` (`ownercheckdate`),
  KEY `domain_index_search_email_tech` (`email_tech`),
  CONSTRAINT `domain_dns` FOREIGN KEY (`dns`) REFERENCES `dns` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domainaction`
--

DROP TABLE IF EXISTS `domainaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domainaction` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `status` enum('enable','disable','deleted','expire') DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `mode` enum('auto','manual') DEFAULT NULL,
  `detail` text,
  `date` timestamp NULL DEFAULT NULL,
  `price` int unsigned DEFAULT NULL,
  `discount` int unsigned DEFAULT NULL,
  `transaction_id` int unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `period` smallint DEFAULT NULL,
  `domainname` varchar(300) DEFAULT NULL,
  `finalprice` bigint unsigned DEFAULT NULL,
  `giftusage_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domainaction_domain_id` (`domain_id`),
  CONSTRAINT `domainaction_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19072 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domainbilling`
--

DROP TABLE IF EXISTS `domainbilling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domainbilling` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `action` enum('register','renew','transfer','delete') DEFAULT NULL,
  `status` enum('enable','disable','deleted','expire') DEFAULT NULL,
  `mode` enum('auto','manual') DEFAULT NULL,
  `detail` text,
  `date` timestamp NULL DEFAULT NULL,
  `period` smallint unsigned DEFAULT NULL,
  `price` int unsigned DEFAULT NULL,
  `discount` int unsigned DEFAULT NULL,
  `transaction_id` int unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `finalprice` bigint unsigned DEFAULT NULL,
  `giftusage_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domainbilling_domain_id` (`domain_id`),
  CONSTRAINT `domainbilling_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domainstatus`
--

DROP TABLE IF EXISTS `domainstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domainstatus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(300) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domainstatus_domain` (`domain`),
  KEY `domainstatus_status` (`status`),
  KEY `domainstatus_active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=37490 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `poll`
--

DROP TABLE IF EXISTS `poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poll` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `server_id` varchar(50) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `nic_id` varchar(50) DEFAULT NULL,
  `notif_count` int unsigned DEFAULT NULL,
  `index` varchar(500) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `detail` text,
  `read` bit(1) DEFAULT NULL,
  `acknowledge` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3029 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usersetting`
--

DROP TABLE IF EXISTS `usersetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersetting` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
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
  `datemodified` timestamp NULL DEFAULT NULL,
  `domain_parking` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usersetting_index_search_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-13 14:42:34
