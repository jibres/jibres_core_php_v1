-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: server-host    Database: jibres_nic_log
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
-- Current Database: `jibres_nic_log`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jibres_nic_log` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `jibres_nic_log`;

--
-- Table structure for table `domains`
--

DROP TABLE IF EXISTS `domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domains` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
  `roid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domains_index_search_domain` (`domain`),
  KEY `domains_index_search_root` (`root`),
  KEY `domains_index_search_tld` (`tld`),
  KEY `domains_index_search_datecreated` (`datecreated`),
  KEY `domains_index_search_dateexpire` (`dateexpire`),
  KEY `domains_index_search_domainlen` (`domainlen`),
  KEY `domains_search_index_registrar` (`registrar`),
  KEY `domains_index_search_len` (`domainlen`)
) ENGINE=InnoDB AUTO_INCREMENT=1846034 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domainactivity`
--

DROP TABLE IF EXISTS `domainactivity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domainactivity` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` bigint unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
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
  `ns4` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domainactivity_domain_id` (`domain_id`),
  KEY `domainactivity_index_search_type` (`type`),
  KEY `domainactivity_index_search_available` (`available`),
  KEY `domainactivity_index_search_user_id` (`user_id`),
  KEY `domainactivity_search_index_available` (`available`),
  KEY `domainactivity_search_index_type` (`type`),
  CONSTRAINT `domainactivity_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2580888 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `type` enum('whois','contact_check','contact_info','contact_create','contact_update','contact_credit','domain_check','domain_lock','domain_unlock','domain_info','domain_create','domain_update','domain_renew','domain_delete','domain_transfer','poll_request','poll_acknowledge') DEFAULT NULL,
  `send` text,
  `response` longtext,
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
  `gateway` enum('system','user','api') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_index_search_type` (`type`),
  KEY `log_index_search_user_id` (`user_id`),
  KEY `log_index_search_datesend` (`datesend`),
  KEY `log_index_search_domain` (`domain`),
  KEY `log_index_search_nic_id` (`nic_id`),
  KEY `result_code` (`result_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2725758 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-13 14:42:35
