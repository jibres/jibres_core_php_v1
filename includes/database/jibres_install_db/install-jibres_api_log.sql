-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: server-host    Database: jibres_api_log
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
-- Current Database: `jibres_api_log`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jibres_api_log` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `jibres_api_log`;

--
-- Table structure for table `apilog`
--

DROP TABLE IF EXISTS `apilog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apilog` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `apikey` varchar(100) DEFAULT NULL,
  `appkey` varchar(100) DEFAULT NULL,
  `zoneid` varchar(100) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `method` varchar(200) DEFAULT NULL,
  `header` mediumtext,
  `headerlen` int unsigned DEFAULT NULL,
  `body` mediumtext,
  `bodylen` int unsigned DEFAULT NULL,
  `datesend` timestamp NULL DEFAULT NULL,
  `pagestatus` varchar(100) DEFAULT NULL,
  `resultstatus` varchar(100) DEFAULT NULL,
  `responseheader` mediumtext,
  `responsebody` mediumtext,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `responselen` int unsigned DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `urlmd5` char(32) DEFAULT NULL,
  `notif` mediumtext,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_version` (`version`),
  KEY `index_search_token` (`token`),
  KEY `index_search_apikey` (`apikey`),
  KEY `index_search_appkey` (`appkey`),
  KEY `index_search_zoneid` (`zoneid`),
  KEY `index_search_method` (`method`),
  KEY `index_search_headerlen` (`headerlen`),
  KEY `index_search_bodylen` (`bodylen`),
  KEY `index_search_pagestatus` (`pagestatus`),
  KEY `index_search_resultstatus` (`resultstatus`),
  KEY `index_search_responselen` (`responselen`),
  KEY `index_search_urlmd5` (`urlmd5`),
  KEY `index_search_subdomain` (`subdomain`)
) ENGINE=InnoDB AUTO_INCREMENT=6013 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `instagram`
--

DROP TABLE IF EXISTS `instagram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instagram` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint DEFAULT NULL,
  `app_id` varchar(200) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `pwd` text,
  `request_type` varchar(200) DEFAULT NULL,
  `access_token` text,
  `user_id` text,
  `username` varchar(200) DEFAULT NULL,
  `status` enum('enable','disable','expire','used','deleted') DEFAULT NULL,
  `send` mediumtext,
  `receive` mediumtext,
  `meta` mediumtext,
  `datecreated` timestamp NULL DEFAULT NULL,
  `expiredate` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_instagram_token` (`token`),
  KEY `index_search_instagram_store_id` (`store_id`),
  KEY `index_search_instagram_status` (`status`),
  KEY `index_search_instagram_request_type` (`request_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kavenegar`
--

DROP TABLE IF EXISTS `kavenegar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kavenegar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(50) DEFAULT NULL,
  `mobiles` text,
  `message` text,
  `urlmd5` char(32) DEFAULT NULL,
  `url` text,
  `mode` enum('sms','call','tts') DEFAULT NULL,
  `type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `store_id` int unsigned DEFAULT NULL,
  `ip_id` int unsigned DEFAULT NULL,
  `ip_md5` char(32) DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `line` varchar(100) DEFAULT NULL,
  `apikey` text,
  `response` text,
  `send` text,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jibres_api_log_kavenegar_mobile` (`mobile`),
  KEY `jibres_api_log_kavenegar_urlmd5` (`urlmd5`),
  KEY `jibres_api_log_kavenegar_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned DEFAULT NULL,
  `store_smslog_id` bigint unsigned DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `message` text,
  `mode` enum('sms','call','tts','verification','receive','lookup') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
  `status` enum('register','pending','sending','expired','moneylow','unknown','send','sended','delivered','queue','failed','undelivered','cancel','block','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deliverstatus` enum('delivered','undelivered','block','other','failed','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sender` enum('system','admin','customer') DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `line` varchar(100) DEFAULT NULL,
  `apikey` text,
  `send` text,
  `template` varchar(100) DEFAULT NULL,
  `response` mediumtext,
  `responsecode` smallint DEFAULT NULL,
  `provider_status` varchar(100) DEFAULT NULL,
  `provider_messageid` varchar(100) DEFAULT NULL,
  `provider_sender` varchar(100) DEFAULT NULL,
  `provider_receptor` varchar(100) DEFAULT NULL,
  `provider_date` datetime DEFAULT NULL,
  `provider_cost` decimal(13,4) DEFAULT NULL,
  `provider_currency` varchar(50) DEFAULT NULL,
  `provider_deliverstatus` varchar(100) DEFAULT NULL,
  `len` int DEFAULT NULL,
  `smscount` smallint DEFAULT NULL,
  `package_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(13,4) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `meta` text,
  `dateregister` timestamp NULL DEFAULT NULL,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datedeliver` timestamp NULL DEFAULT NULL,
  `datestoresync` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `sms_sending_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sms_store_id` (`store_id`),
  KEY `sms_store_smslog_id` (`store_smslog_id`),
  KEY `sms_provider_messageid` (`provider_messageid`),
  KEY `sms_package_id` (`package_id`),
  KEY `sms_status` (`status`),
  KEY `sms_smscount` (`smscount`),
  KEY `sms_mobile` (`mobile`),
  KEY `sms_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3005599 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms_sending`
--

DROP TABLE IF EXISTS `sms_sending`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms_sending` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sms_id` bigint unsigned NOT NULL,
  `status` enum('pending','sending','done') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sms_sending_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4808 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telegram`
--

DROP TABLE IF EXISTS `telegram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telegram` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned DEFAULT NULL,
  `store_telegramlog_id` bigint unsigned DEFAULT NULL,
  `chatid` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` enum('register','pending','sending','expired','moneylow','unknown','send','sended','queue','failed','cancel','block','other') DEFAULT NULL,
  `bot` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `send` mediumtext,
  `response` mediumtext,
  `dateregister` timestamp NULL DEFAULT NULL,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `telegram_store_id` (`store_id`),
  KEY `telegram_store_telegramlog_id` (`store_telegramlog_id`),
  KEY `telegram_status` (`status`),
  KEY `telegram_chatid` (`chatid`),
  KEY `telegram_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=26612 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telegram_sending`
--

DROP TABLE IF EXISTS `telegram_sending`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telegram_sending` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `telegram_id` bigint unsigned NOT NULL,
  `status` enum('pending','sending','done') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `telegram_sending_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=26612 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `twitter`
--

DROP TABLE IF EXISTS `twitter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `twitter` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint DEFAULT NULL,
  `identify` text,
  `request_type` varchar(200) DEFAULT NULL,
  `user_id` text,
  `username` varchar(200) DEFAULT NULL,
  `status` enum('enable','disable','expire','used','deleted') DEFAULT NULL,
  `send` mediumtext,
  `receive` mediumtext,
  `meta` mediumtext,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_twitter_store_id` (`store_id`),
  KEY `index_search_twitter_status` (`status`),
  KEY `index_search_twitter_request_type` (`request_type`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
