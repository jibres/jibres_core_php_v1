-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: server-host    Database: jibres_onlinenic_log
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
-- Current Database: `jibres_onlinenic_log`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jibres_onlinenic_log` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `jibres_onlinenic_log`;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `type` enum('checkDomain','registerDomain','renewDomain','queryTransferStatus','cancelDomainTransfer','getAuthCode','updateAuthCode','infoDomain','updateDomainStatus','updateDomainDns','setDomainPassword','createContact','infoContact','domainChangeContact','updateContact','transferDomain') DEFAULT NULL,
  `send` text,
  `response` longtext,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `result_code` varchar(100) DEFAULT NULL,
  `result` text,
  `domain` varchar(200) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `gateway` enum('system','user','api') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onlinenic_log_index_search_type` (`type`),
  KEY `onlinenic_log_index_search_user_id` (`user_id`),
  KEY `onlinenic_log_index_search_datesend` (`datesend`),
  KEY `onlinenic_log_index_search_domain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=1179 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
