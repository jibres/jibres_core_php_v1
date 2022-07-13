-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: server-host    Database: jibres
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
-- Current Database: `jibres`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jibres` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `jibres`;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `address` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `company` bit(1) DEFAULT NULL,
  `companyname` varchar(100) DEFAULT NULL,
  `jobtitle` varchar(100) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `province` varchar(6) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `address2` varchar(500) DEFAULT NULL,
  `postcode` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `status` enum('enable','disable','filter','leave','spam','delete') DEFAULT 'enable',
  `favorite` bit(1) DEFAULT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `map` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `address_user_id` (`user_id`),
  CONSTRAINT `address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `agent` text NOT NULL,
  `group` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `osnum` varchar(50) DEFAULT NULL,
  `robot` bit(1) DEFAULT NULL,
  `meta` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `agentmd5` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_agentmd5` (`agentmd5`)
) ENGINE=InnoDB AUTO_INCREMENT=6713 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `business_domain`
--

DROP TABLE IF EXISTS `business_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_domain` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(150) DEFAULT NULL,
  `domain_id` int unsigned DEFAULT NULL,
  `store_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `subdomain` varchar(150) DEFAULT NULL,
  `root` varchar(150) DEFAULT NULL,
  `tld` varchar(150) DEFAULT NULL,
  `master` bit(1) DEFAULT NULL,
  `redirecttomaster` bit(1) DEFAULT NULL,
  `cdn` enum('arvancloud','cloudflare','enterprise') DEFAULT NULL,
  `status` enum('pending','failed','ok','pending_delete','deleted','inprogress','dns_not_resolved','pending_verify','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `checkdns` timestamp NULL DEFAULT NULL,
  `cdnpanel` timestamp NULL DEFAULT NULL,
  `httpsrequest` timestamp NULL DEFAULT NULL,
  `httpsverify` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `dnsok` timestamp NULL DEFAULT NULL,
  `arvan_result` text,
  `lastactivity` datetime DEFAULT NULL,
  `nextactivity` datetime DEFAULT NULL,
  `verifyprocess` text,
  PRIMARY KEY (`id`),
  KEY `business_domain_index_domain` (`domain`),
  KEY `business_domain_index_checkdns` (`checkdns`),
  KEY `business_domain_index_store_id` (`store_id`),
  KEY `business_domain_index_domain_id` (`domain_id`),
  KEY `business_domain_index_cdnpanel` (`cdnpanel`),
  KEY `business_domain_index_httpsrequest` (`httpsrequest`),
  KEY `business_domain_index_httpsverify` (`httpsverify`),
  KEY `business_domain_index_status` (`status`),
  KEY `business_domain_index_master` (`master`),
  KEY `business_domain_index_datemodified` (`datemodified`),
  KEY `business_domain_index_dnsok` (`dnsok`),
  KEY `business_domain_index_redirecttomaster` (`redirecttomaster`),
  KEY `business_domain_index_subdomain` (`subdomain`),
  KEY `business_domain_index_cdn` (`cdn`),
  KEY `business_domain_index_nextactivity` (`nextactivity`),
  CONSTRAINT `business_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1299 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `business_domain_action`
--

DROP TABLE IF EXISTS `business_domain_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_domain_action` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `business_domain_id` int unsigned DEFAULT NULL,
  `action` varchar(300) DEFAULT NULL,
  `desc` text,
  `meta` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `gateway` enum('user','system') DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_domain_action_business_domain_id` (`business_domain_id`),
  KEY `business_domain_action_index_action` (`action`),
  KEY `business_domain_action_index_datecreated` (`datecreated`),
  CONSTRAINT `business_domain_action_business_domain_id` FOREIGN KEY (`business_domain_id`) REFERENCES `business_domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6578 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `business_domain_dns`
--

DROP TABLE IF EXISTS `business_domain_dns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_domain_dns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `business_domain_id` int unsigned DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  `key` varchar(150) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `cloud` bit(1) DEFAULT b'1',
  `priority` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `verify` bit(1) DEFAULT NULL,
  `status` enum('pending','failed','ok','pending_delete','deleted','inprogress','waiting_to_connect_cdn') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_domain_dns_business_domain_id` (`business_domain_id`),
  CONSTRAINT `business_domain_dns_business_domain_id` FOREIGN KEY (`business_domain_id`) REFERENCES `business_domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=566586 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `changelog`
--

DROP TABLE IF EXISTS `changelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `changelog` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `title` text,
  `link` text,
  `user_id` int unsigned DEFAULT NULL,
  `tag1` varchar(50) DEFAULT NULL,
  `tag2` varchar(50) DEFAULT NULL,
  `tag3` varchar(50) DEFAULT NULL,
  `tag4` varchar(50) DEFAULT NULL,
  `tag5` varchar(50) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_changelog_date` (`date`),
  KEY `index_search_changelog_language` (`language`),
  KEY `index_search_changelog_tag1` (`tag1`),
  KEY `index_search_changelog_tag2` (`tag2`),
  KEY `index_search_changelog_tag3` (`tag3`),
  KEY `index_search_changelog_tag4` (`tag4`),
  KEY `index_search_changelog_tag5` (`tag5`),
  KEY `index_search_changelog_version` (`version`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned DEFAULT NULL,
  `for` enum('page','post','product') DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext,
  `gallery` text,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter') DEFAULT NULL,
  `parent` bigint unsigned DEFAULT NULL,
  `star` smallint DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_posts_id` (`post_id`),
  KEY `comments_users_id` (`user_id`),
  KEY `index_search_star` (`star`),
  KEY `index_search_for` (`for`),
  KEY `index_search_ip` (`ip`),
  KEY `index_search_agent_id` (`agent_id`),
  KEY `index_search_status` (`status`),
  CONSTRAINT `comments_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `crm_email`
--

DROP TABLE IF EXISTS `crm_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `crm_email` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider` varchar(50) DEFAULT NULL,
  `from` varchar(200) DEFAULT NULL,
  `to` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `design` varchar(100) DEFAULT NULL,
  `body` text,
  `template` varchar(100) DEFAULT NULL,
  `status` enum('pending','sending','send','sended','delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `response` text,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `crm_email_status` (`status`),
  KEY `crm_email_template` (`template`),
  KEY `crm_email_from` (`from`),
  KEY `crm_email_to` (`to`),
  KEY `crm_email_subject` (`subject`),
  KEY `crm_email_datecreated` (`datecreated`),
  KEY `crm_email_ip_id` (`ip_id`),
  KEY `crm_email_agent_id` (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=397 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `csrf`
--

DROP TABLE IF EXISTS `csrf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `csrf` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token` char(32) DEFAULT NULL,
  `urlmd5` char(32) DEFAULT NULL,
  `status` enum('active','used','expire','deleted','disabled','block') DEFAULT NULL,
  `url` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `remember_me` varchar(500) DEFAULT NULL,
  `session_id` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jibres_csrf_status` (`status`),
  KEY `jibres_csrf_token` (`token`),
  KEY `jibres_csrf_urlmd5` (`urlmd5`),
  KEY `jibres_csrf_datemodified` (`datemodified`),
  KEY `jibres_csrf_check` (`token`,`urlmd5`,`status`),
  KEY `csrf_search_index_ip_id` (`ip_id`),
  KEY `csrf_search_index_agent_id` (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=327161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dayevent`
--

DROP TABLE IF EXISTS `dayevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dayevent` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `countcalc` int unsigned DEFAULT NULL,
  `dbtrafic` int unsigned DEFAULT NULL,
  `dbsize` int unsigned DEFAULT NULL,
  `user` int unsigned DEFAULT NULL,
  `activeuser` int unsigned DEFAULT NULL,
  `deactiveuser` int unsigned DEFAULT NULL,
  `log` int unsigned DEFAULT NULL,
  `visitor` int unsigned DEFAULT NULL,
  `agent` int unsigned DEFAULT NULL,
  `session` int unsigned DEFAULT NULL,
  `urls` int unsigned DEFAULT NULL,
  `ticket` int unsigned DEFAULT NULL,
  `comment` int unsigned DEFAULT NULL,
  `address` int unsigned DEFAULT NULL,
  `news` int unsigned DEFAULT NULL,
  `page` int unsigned DEFAULT NULL,
  `post` int unsigned DEFAULT NULL,
  `transaction` int unsigned DEFAULT NULL,
  `term` int unsigned DEFAULT NULL,
  `termusages` int unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `help` int unsigned DEFAULT NULL,
  `attachment` int unsigned DEFAULT NULL,
  `tag` int unsigned DEFAULT NULL,
  `cat` int unsigned DEFAULT NULL,
  `support_tag` int unsigned DEFAULT NULL,
  `help_tag` int unsigned DEFAULT NULL,
  `user_mobile` int unsigned DEFAULT NULL,
  `user_email` int unsigned DEFAULT NULL,
  `user_chatid` int unsigned DEFAULT NULL,
  `user_username` int unsigned DEFAULT NULL,
  `user_android` int unsigned DEFAULT NULL,
  `user_awaiting` int unsigned DEFAULT NULL,
  `user_removed` int unsigned DEFAULT NULL,
  `user_filter` int unsigned DEFAULT NULL,
  `user_unreachabl` int unsigned DEFAULT NULL,
  `user_permission` int unsigned DEFAULT NULL,
  `ticket_message` int unsigned DEFAULT NULL,
  `userdetail` int unsigned DEFAULT NULL,
  `apilog` bigint DEFAULT NULL,
  `business_domain` bigint DEFAULT NULL,
  `business_domain_action` bigint DEFAULT NULL,
  `business_domain_dns` bigint DEFAULT NULL,
  `csrf` bigint DEFAULT NULL,
  `files` bigint DEFAULT NULL,
  `fileusage` bigint DEFAULT NULL,
  `gift` bigint DEFAULT NULL,
  `giftusage` bigint DEFAULT NULL,
  `log_notif` bigint DEFAULT NULL,
  `login` bigint DEFAULT NULL,
  `login_ip` bigint DEFAULT NULL,
  `setting` bigint DEFAULT NULL,
  `store` bigint DEFAULT NULL,
  `store_analytics` bigint DEFAULT NULL,
  `store_app` bigint DEFAULT NULL,
  `store_data` bigint DEFAULT NULL,
  `store_domain` bigint DEFAULT NULL,
  `store_file` bigint DEFAULT NULL,
  `store_plan` bigint DEFAULT NULL,
  `store_timeline` bigint DEFAULT NULL,
  `store_user` bigint DEFAULT NULL,
  `telegrams` bigint DEFAULT NULL,
  `user_auth` bigint DEFAULT NULL,
  `user_telegram` bigint DEFAULT NULL,
  `useremail` bigint DEFAULT NULL,
  `nic_contact` bigint DEFAULT NULL,
  `nic_contactdetail` bigint DEFAULT NULL,
  `nic_credit` bigint DEFAULT NULL,
  `nic_dns` bigint DEFAULT NULL,
  `nic_domain` bigint DEFAULT NULL,
  `nic_domainaction` bigint DEFAULT NULL,
  `nic_domainbilling` bigint DEFAULT NULL,
  `nic_domainstatus` bigint DEFAULT NULL,
  `nic_poll` bigint DEFAULT NULL,
  `nic_usersetting` bigint DEFAULT NULL,
  `nic_log_domainactivity` bigint DEFAULT NULL,
  `nic_log_domains` bigint DEFAULT NULL,
  `nic_log_log` bigint DEFAULT NULL,
  `onlinenic_log_log` bigint DEFAULT NULL,
  `visitor_ip` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=559 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `creator` int unsigned DEFAULT NULL,
  `md5` char(32) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `mime` varchar(200) DEFAULT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `folder` varchar(100) DEFAULT NULL,
  `path` varchar(2000) DEFAULT NULL,
  `size` int unsigned DEFAULT NULL,
  `height` int DEFAULT NULL,
  `width` int DEFAULT NULL,
  `ratio` decimal(5,2) DEFAULT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `totalsize` int DEFAULT NULL,
  `status` enum('awaiting','publish','block','filter','removed','spam') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip` bigint DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `domain` varchar(200) DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `preview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`),
  KEY `files_creator` (`creator`),
  KEY `files_md5_search` (`md5`),
  KEY `files_search_index_filename` (`filename`),
  KEY `files_search_index_type` (`type`),
  KEY `files_search_index_ext` (`ext`),
  KEY `files_search_index_size` (`size`),
  KEY `files_search_index_totalsize` (`totalsize`),
  KEY `files_search_index_status` (`status`),
  KEY `files_search_index_height` (`height`),
  KEY `files_search_index_width` (`width`),
  KEY `files_search_index_ratio` (`ratio`),
  CONSTRAINT `files_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=722 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fileusage`
--

DROP TABLE IF EXISTS `fileusage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fileusage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `alt` varchar(200) DEFAULT NULL,
  `desc` text,
  `related` varchar(100) DEFAULT NULL,
  `related_id` int unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fileuseage_related_search` (`related`),
  KEY `fileuseage_related_id_search` (`related_id`),
  KEY `fileusage_user_id` (`user_id`),
  KEY `fileusage_file_id` (`file_id`),
  CONSTRAINT `fileusage_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fileusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=624 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gift`
--

DROP TABLE IF EXISTS `gift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gift` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `giftpercent` smallint unsigned DEFAULT NULL,
  `giftamount` bigint unsigned DEFAULT NULL,
  `giftmax` bigint unsigned DEFAULT NULL,
  `pricefloor` bigint unsigned DEFAULT NULL,
  `desc` text,
  `creator` int unsigned DEFAULT NULL,
  `usagetotal` int unsigned DEFAULT NULL,
  `usageperuser` smallint unsigned DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `dateexpire` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `datefirstuse` timestamp NULL DEFAULT NULL,
  `datefinish` timestamp NULL DEFAULT NULL,
  `status` enum('draft','enable','disable','deleted','expire','blocked') DEFAULT NULL,
  `usagestatus` enum('used','full') DEFAULT NULL,
  `forusein` enum('any','domain','store','sms','ipg','ir_domain','ir_domain_1','ir_domain_5') DEFAULT NULL,
  `emailto` text,
  `emailtemplate` varchar(100) DEFAULT NULL,
  `msgsuccess` text,
  `forfirstorder` bit(1) DEFAULT NULL,
  `dedicated` text,
  `physical` bit(1) DEFAULT NULL,
  `chap` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gift_index_search_code` (`code`),
  KEY `gift_index_search_status` (`status`),
  KEY `gift_creator` (`creator`),
  CONSTRAINT `gift_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `giftlookup`
--

DROP TABLE IF EXISTS `giftlookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `giftlookup` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `gift_id` bigint unsigned DEFAULT NULL,
  `valid` enum('yes','no') DEFAULT NULL,
  `errortype` varchar(100) DEFAULT NULL,
  `message` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `giftlookup_index_search_code` (`code`),
  KEY `giftlookup_index_search_user_id` (`user_id`),
  KEY `giftlookup_index_search_valid` (`valid`),
  KEY `giftlookup_index_search_gift_id` (`gift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1692 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `giftusage`
--

DROP TABLE IF EXISTS `giftusage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `giftusage` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gift_id` bigint unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `transaction_id` bigint unsigned DEFAULT NULL,
  `price` bigint unsigned DEFAULT NULL,
  `discount` bigint unsigned DEFAULT NULL,
  `discountpercent` smallint unsigned DEFAULT NULL,
  `finalprice` bigint unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `giftusage_user_id` (`user_id`),
  KEY `giftusage_transaction_id` (`transaction_id`),
  KEY `giftusage_gift_id` (`gift_id`),
  KEY `giftusage_search_index_ip_id` (`ip_id`),
  KEY `giftusage_search_index_agent_id` (`agent_id`),
  CONSTRAINT `giftusage_gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `giftusage_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `giftusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=627 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_notif`
--

DROP TABLE IF EXISTS `log_notif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_notif` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('ok','error','warn','info') DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `messagemd5` char(32) DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `urlkingdom` varchar(255) DEFAULT NULL,
  `urldir` varchar(255) DEFAULT NULL,
  `urlquery` varchar(255) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `meta` text,
  PRIMARY KEY (`id`),
  KEY `log_notif_search_index_messagemd5` (`messagemd5`),
  KEY `log_notif_search_index_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=41461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `jibres_user_id` int unsigned DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `ip_md5` char(32) DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `agent_md5` char(32) DEFAULT NULL,
  `status` enum('active','expire','logout','changepassword','deleted','hijack','changeip','changeagent','block','error') DEFAULT NULL,
  `place` enum('jibres','subdomain','admin','customer_domain','api_core','api_business','telegram') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `trustdomain` varchar(200) DEFAULT NULL,
  `meta` text,
  PRIMARY KEY (`id`),
  KEY `jibres_login_code` (`code`),
  KEY `jibres_login_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7496 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login_ip`
--

DROP TABLE IF EXISTS `login_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_ip` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `login_id` bigint unsigned DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25454 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `caller` varchar(200) DEFAULT NULL,
  `type` enum('public','system','db','php') DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `send` bit(1) DEFAULT NULL,
  `to` int unsigned DEFAULT NULL,
  `notif` bit(1) DEFAULT NULL,
  `from` int unsigned DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `readdate` timestamp NULL DEFAULT NULL,
  `data` text,
  `status` enum('enable','disable','expire','deliver','awaiting','deleted','cancel','block','notif','notifread','notifexpire') CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `visitor_id` bigint unsigned DEFAULT NULL,
  `meta` mediumtext,
  `sms` text,
  `telegram` text,
  `email` text,
  `expiredate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_status_index` (`status`),
  KEY `log_to_index` (`to`),
  KEY `log_expiredate` (`expiredate`),
  KEY `log_caller` (`caller`),
  KEY `log_code` (`code`),
  KEY `index_search_send` (`send`),
  KEY `index_search_notif` (`notif`),
  KEY `index_search_caller` (`caller`),
  KEY `index_search_subdomain` (`subdomain`),
  KEY `index_search_readdate` (`readdate`),
  KEY `index_search_datecreated` (`datecreated`),
  KEY `jibres_log_index_type` (`type`),
  KEY `logs_search_index_ip_id` (`ip_id`),
  KEY `logs_search_index_agent_id` (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1474094 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `industry` varchar(200) DEFAULT NULL,
  `desc` text,
  `store_id` bigint DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `url` text,
  `status` enum('request','accept','reject','delete') DEFAULT NULL,
  `tag1` varchar(50) DEFAULT NULL,
  `tag2` varchar(50) DEFAULT NULL,
  `tag3` varchar(50) DEFAULT NULL,
  `tag4` varchar(50) DEFAULT NULL,
  `tag5` varchar(50) DEFAULT NULL,
  `thumb` text,
  `image` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_portfolio_sort` (`sort`),
  KEY `index_search_portfolio_language` (`language`),
  KEY `index_search_portfolio_title` (`title`),
  KEY `index_search_portfolio_tag1` (`tag1`),
  KEY `index_search_portfolio_tag2` (`tag2`),
  KEY `index_search_portfolio_tag3` (`tag3`),
  KEY `index_search_portfolio_tag4` (`tag4`),
  KEY `index_search_portfolio_tag5` (`tag5`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `seotitle` varchar(500) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `url` varchar(190) DEFAULT NULL,
  `content` mediumtext,
  `thumb` varchar(500) DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  `gallery` text,
  `subtitle` varchar(500) DEFAULT NULL,
  `excerpt` varchar(500) DEFAULT NULL,
  `meta` mediumtext,
  `type` varchar(100) NOT NULL DEFAULT 'post',
  `special` varchar(100) DEFAULT NULL,
  `comment` enum('open','closed') DEFAULT NULL,
  `status` enum('publish','draft','schedule','deleted','expire') NOT NULL DEFAULT 'draft',
  `parent` bigint unsigned DEFAULT NULL,
  `user_id` int unsigned NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subtype` enum('standard','gallery','video','audio') DEFAULT 'standard',
  `redirecturl` text,
  `specialaddress` enum('independence','special','under_tag','under_page') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_unique` (`url`,`language`) USING BTREE,
  KEY `posts_users_id` (`user_id`),
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`),
  KEY `index_search_language` (`language`),
  KEY `index_search_publishdate` (`publishdate`),
  KEY `index_search_url` (`url`),
  KEY `index_search_slug` (`slug`),
  KEY `search_index_subtype` (`subtype`),
  CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `status` enum('active','terminate','expire','disable','changed','logout') NOT NULL DEFAULT 'active',
  `agent_id` int unsigned DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `count` int unsigned DEFAULT '1',
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_seen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`code`) USING BTREE,
  KEY `sessions_user_id` (`user_id`),
  KEY `index_search_code` (`code`),
  KEY `index_search_user_id` (`user_id`),
  KEY `index_search_status` (`status`),
  KEY `index_search_agent_id` (`agent_id`),
  CONSTRAINT `sessions_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `platform` enum('android','ios','telegram','website') DEFAULT NULL,
  `lang` char(2) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `cat` varchar(50) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `setting_index_search_cat` (`cat`),
  KEY `setting_index_search_key` (`key`),
  KEY `setting_index_search_lang` (`lang`),
  KEY `setting_index_search_platform` (`platform`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms_log`
--

DROP TABLE IF EXISTS `sms_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `message` text,
  `len` int DEFAULT NULL,
  `smscount` smallint DEFAULT NULL,
  `cost` decimal(13,4) DEFAULT NULL,
  `amount` decimal(13,4) DEFAULT NULL,
  `mode` enum('sms','call','tts','verification','receive','lookup') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
  `status` enum('register','pending','sending','expired','moneylow','unknown','send','sended','delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
  `sender` enum('system','admin','customer') DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `url` text,
  `urlmd5` char(32) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `line` varchar(100) DEFAULT NULL,
  `apikey` text,
  `response` text,
  `send` text,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `template` varchar(100) DEFAULT NULL,
  `jibres_sms_id` bigint unsigned DEFAULT NULL,
  `meta` text,
  PRIMARY KEY (`id`),
  KEY `smslog_cost` (`cost`),
  KEY `smslog_amount` (`amount`),
  KEY `smslog_status` (`status`),
  KEY `smslog_mobile` (`mobile`),
  KEY `smslog_urlmd5` (`urlmd5`),
  KEY `smslog_mode` (`mode`),
  KEY `smslog_len` (`len`),
  KEY `smslog_type` (`type`),
  KEY `smslog_sender` (`sender`)
) ENGINE=InnoDB AUTO_INCREMENT=4394 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subdomain` varchar(50) DEFAULT NULL,
  `fuel` varchar(150) DEFAULT NULL,
  `creator` int unsigned DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `status` enum('awaiting','reserve_creating','enable','close','deleted','spam','hard_delete','upgrade','transfer','backup','lock','broken','limitation','creating','failed','error') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'enable',
  `dbversion` varchar(100) DEFAULT NULL,
  `dbversiondate` datetime DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_creator` (`creator`),
  KEY `store_subdomain` (`subdomain`),
  KEY `store_index_search_status` (`status`),
  CONSTRAINT `store_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1001483 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_analytics`
--

DROP TABLE IF EXISTS `store_analytics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_analytics` (
  `id` int unsigned NOT NULL,
  `question1` smallint unsigned DEFAULT NULL,
  `question2` smallint unsigned DEFAULT NULL,
  `question3` smallint unsigned DEFAULT NULL,
  `lastactivity` timestamp NULL DEFAULT NULL,
  `lastchangesetting` timestamp NULL DEFAULT NULL,
  `lastadminlogin` timestamp NULL DEFAULT NULL,
  `laststafflogin` timestamp NULL DEFAULT NULL,
  `lastsale` timestamp NULL DEFAULT NULL,
  `lastbuy` timestamp NULL DEFAULT NULL,
  `dbtrafic` bigint unsigned DEFAULT NULL,
  `dbsize` bigint unsigned DEFAULT NULL,
  `user` bigint DEFAULT NULL,
  `customer` int unsigned DEFAULT NULL,
  `staff` int unsigned DEFAULT NULL,
  `agent` int unsigned DEFAULT NULL,
  `session` int unsigned DEFAULT NULL,
  `ticket` int unsigned DEFAULT NULL,
  `ticket_message` int unsigned DEFAULT NULL,
  `comment` int unsigned DEFAULT NULL,
  `address` int unsigned DEFAULT NULL,
  `news` int unsigned DEFAULT NULL,
  `page` int unsigned DEFAULT NULL,
  `post` int unsigned DEFAULT NULL,
  `transaction` int unsigned DEFAULT NULL,
  `term` int unsigned DEFAULT NULL,
  `termusages` int unsigned DEFAULT NULL,
  `sumplustransaction` bigint unsigned DEFAULT NULL,
  `summinustransaction` bigint unsigned DEFAULT NULL,
  `product` int unsigned DEFAULT NULL,
  `factor` bigint unsigned DEFAULT NULL,
  `factorbuy` bigint unsigned DEFAULT NULL,
  `factorsale` bigint unsigned DEFAULT NULL,
  `factordetail` bigint unsigned DEFAULT NULL,
  `sumfactor` bigint unsigned DEFAULT NULL,
  `planhistory` int unsigned DEFAULT NULL,
  `help` int unsigned DEFAULT NULL,
  `attachment` int unsigned DEFAULT NULL,
  `tag` int unsigned DEFAULT NULL,
  `cat` int unsigned DEFAULT NULL,
  `support_tag` int unsigned DEFAULT NULL,
  `help_tag` int unsigned DEFAULT NULL,
  `user_mobile` int unsigned DEFAULT NULL,
  `user_email` int unsigned DEFAULT NULL,
  `user_chatid` int unsigned DEFAULT NULL,
  `user_username` int unsigned DEFAULT NULL,
  `user_android` int unsigned DEFAULT NULL,
  `user_awaiting` int unsigned DEFAULT NULL,
  `user_removed` int unsigned DEFAULT NULL,
  `user_filter` int unsigned DEFAULT NULL,
  `user_unreachabl` int unsigned DEFAULT NULL,
  `user_permission` int unsigned DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `log` bigint unsigned DEFAULT NULL,
  `cart` bigint unsigned DEFAULT NULL,
  `sync` bigint unsigned DEFAULT NULL,
  `apilog` bigint unsigned DEFAULT NULL,
  `app_download` bigint DEFAULT NULL,
  `csrf` bigint DEFAULT NULL,
  `dayevent` bigint DEFAULT NULL,
  `factoraction` bigint DEFAULT NULL,
  `factoraddress` bigint DEFAULT NULL,
  `files` bigint DEFAULT NULL,
  `fileusage` bigint DEFAULT NULL,
  `form` bigint DEFAULT NULL,
  `form_answer` bigint DEFAULT NULL,
  `form_answerdetail` bigint DEFAULT NULL,
  `form_choice` bigint DEFAULT NULL,
  `form_filter` bigint DEFAULT NULL,
  `form_filter_where` bigint DEFAULT NULL,
  `form_item` bigint DEFAULT NULL,
  `funds` bigint DEFAULT NULL,
  `importexport` bigint DEFAULT NULL,
  `inventory` bigint DEFAULT NULL,
  `ir_vat` bigint DEFAULT NULL,
  `log_notif` bigint DEFAULT NULL,
  `login` bigint DEFAULT NULL,
  `login_ip` bigint DEFAULT NULL,
  `pos` bigint DEFAULT NULL,
  `productcategory` bigint DEFAULT NULL,
  `productcategoryusage` bigint DEFAULT NULL,
  `productcomment` bigint DEFAULT NULL,
  `productcompany` bigint DEFAULT NULL,
  `productinventory` bigint DEFAULT NULL,
  `productprices` bigint DEFAULT NULL,
  `productproperties` bigint DEFAULT NULL,
  `producttag` bigint DEFAULT NULL,
  `producttagusage` bigint DEFAULT NULL,
  `productunit` bigint DEFAULT NULL,
  `setting` bigint DEFAULT NULL,
  `tax_coding` bigint DEFAULT NULL,
  `tax_docdetail` bigint DEFAULT NULL,
  `tax_document` bigint DEFAULT NULL,
  `tax_year` bigint DEFAULT NULL,
  `telegrams` bigint DEFAULT NULL,
  `urls` bigint DEFAULT NULL,
  `user_auth` bigint DEFAULT NULL,
  `user_telegram` bigint DEFAULT NULL,
  `userdetail` bigint DEFAULT NULL,
  `userlegal` bigint DEFAULT NULL,
  `visitors` bigint DEFAULT NULL,
  `factorshipping` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `store_analytics_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_app`
--

DROP TABLE IF EXISTS `store_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_app` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `version` smallint unsigned DEFAULT NULL,
  `build` int unsigned DEFAULT NULL,
  `status` enum('queue','inprogress','done','failed','disable','expire','cancel','delete','enable','info','error') DEFAULT NULL,
  `daterequest` timestamp NULL DEFAULT NULL,
  `datequeue` timestamp NULL DEFAULT NULL,
  `datedone` timestamp NULL DEFAULT NULL,
  `datedownload` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(500) DEFAULT NULL,
  `meta` text,
  `versiontitle` varchar(50) DEFAULT NULL,
  `versionnumber` int unsigned DEFAULT NULL,
  `packagename` varchar(200) DEFAULT NULL,
  `keystore` varchar(50) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_store_app_status` (`status`),
  KEY `store_app_store_id` (`store_id`),
  CONSTRAINT `store_app_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_data`
--

DROP TABLE IF EXISTS `store_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_data` (
  `id` int unsigned NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `storage` bigint DEFAULT NULL,
  `uploadsize` bigint DEFAULT NULL,
  `enterprise` varchar(100) DEFAULT NULL,
  `owner` int unsigned DEFAULT NULL,
  `description` text,
  `lang` char(2) DEFAULT NULL,
  `branding` timestamp NULL DEFAULT NULL,
  `instagram` timestamp NULL DEFAULT NULL,
  `support` timestamp NULL DEFAULT NULL,
  `logo` varchar(2000) DEFAULT NULL,
  `lastactivity` timestamp NULL DEFAULT NULL,
  `dbversion` varchar(50) DEFAULT NULL,
  `dbversiondate` datetime DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `portfolio` enum('request','accept','reject','delete') DEFAULT NULL,
  `portfolio_detail` text,
  PRIMARY KEY (`id`),
  KEY `store_data_owner` (`owner`),
  KEY `index_search_store_data_portfolio` (`portfolio`),
  CONSTRAINT `store_data_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `store_data_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_domain`
--

DROP TABLE IF EXISTS `store_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_domain` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `root` varchar(100) DEFAULT NULL,
  `tld` varchar(100) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `dns1` varchar(100) DEFAULT NULL,
  `dns2` varchar(100) DEFAULT NULL,
  `dnsrecord` bit(1) DEFAULT NULL,
  `dnsip` varchar(100) DEFAULT NULL,
  `https` bit(1) DEFAULT NULL,
  `status` enum('failed','ok','pending') DEFAULT NULL,
  `message` text,
  `datemodified` timestamp NULL DEFAULT NULL,
  `master` bit(1) DEFAULT NULL,
  `cronjobstatus` varchar(100) DEFAULT NULL,
  `cronjobdate` datetime DEFAULT NULL,
  `sslrequestdate` datetime DEFAULT NULL,
  `sslfailed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_domain` (`domain`),
  KEY `store_domain_store_id` (`store_id`),
  KEY `store_domain_creator` (`user_id`),
  KEY `store_domain_index_search_master` (`master`),
  CONSTRAINT `store_domain_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `store_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_file`
--

DROP TABLE IF EXISTS `store_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_file` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `md5` char(32) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `mime` varchar(200) DEFAULT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `folder` varchar(100) DEFAULT NULL,
  `path` varchar(2000) DEFAULT NULL,
  `size` int unsigned DEFAULT NULL,
  `status` enum('draft','awaiting','publish','block','filter','removed','spam') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_files_user_id` (`user_id`),
  KEY `files_md5_search` (`md5`),
  CONSTRAINT `store_files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_plan`
--

DROP TABLE IF EXISTS `store_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_plan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `plan` varchar(100) DEFAULT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `type` enum('change','continuation','upgrade','downgrade','set','auto') DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT NULL,
  `price` int unsigned DEFAULT NULL,
  `discount` int unsigned DEFAULT NULL,
  `promo` varchar(100) DEFAULT NULL,
  `period` enum('monthly','yearly') DEFAULT NULL,
  `expireplan` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_plan_store_id` (`store_id`),
  KEY `store_plan_creator` (`user_id`),
  CONSTRAINT `store_plan_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `store_plan_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_plugin`
--

DROP TABLE IF EXISTS `store_plugin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_plugin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned NOT NULL,
  `plugin` varchar(150) DEFAULT NULL,
  `zone` varchar(50) DEFAULT NULL,
  `status` enum('pending','enable','disable','deleted','expired','cancel') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `datestart` timestamp NULL DEFAULT NULL,
  `expiredate` timestamp NULL DEFAULT NULL,
  `packagecount` int DEFAULT NULL,
  `alerton` int DEFAULT NULL,
  `alerttime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_store_plugin_datecreated` (`datecreated`),
  KEY `index_search_store_plugin_expiredate` (`expiredate`),
  KEY `index_search_store_plugin_store_id` (`store_id`),
  KEY `index_search_store_plugin_plugin` (`plugin`),
  KEY `index_search_store_plugin_status` (`status`),
  KEY `index_search_store_plugin_zone` (`zone`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_plugin_action`
--

DROP TABLE IF EXISTS `store_plugin_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_plugin_action` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plugin_id` bigint unsigned NOT NULL,
  `action` varchar(100) DEFAULT NULL,
  `status` enum('pending','enable','disable','deleted','expired','cancel','refund','failed','used','finished') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `addedby` enum('user','admin','system') DEFAULT NULL,
  `type` enum('activate','cancel','refund','delete','renew') DEFAULT NULL,
  `parent` bigint unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `price` decimal(22,4) DEFAULT NULL,
  `discount` decimal(22,4) DEFAULT NULL,
  `finalprice` decimal(22,4) DEFAULT NULL,
  `transaction_id` bigint unsigned DEFAULT NULL,
  `giftusage_id` bigint unsigned DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `datestart` timestamp NULL DEFAULT NULL,
  `plusday` int DEFAULT NULL,
  `packagecount` int DEFAULT NULL,
  `expiredate` timestamp NULL DEFAULT NULL,
  `desc` text,
  PRIMARY KEY (`id`),
  KEY `plugin_action_plugin_id` (`plugin_id`),
  KEY `index_search_store_plugin_action_datecreated` (`datecreated`),
  KEY `index_search_store_plugin_action_finalprice` (`finalprice`),
  KEY `index_search_store_plugin_action_expiredate` (`expiredate`),
  KEY `index_search_store_plugin_action_addedby` (`addedby`),
  KEY `index_search_store_plugin_action_plusday` (`plusday`),
  KEY `index_search_store_plugin_action_status` (`status`),
  KEY `index_search_store_plugin_action_price` (`price`),
  KEY `index_search_store_plugin_action_type` (`type`),
  KEY `index_search_store_plugin_action_action` (`action`),
  CONSTRAINT `plugin_action_plugin_id` FOREIGN KEY (`plugin_id`) REFERENCES `store_plugin` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_timeline`
--

DROP TABLE IF EXISTS `store_timeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_timeline` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `login_diff` int unsigned DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `start_diff` int unsigned DEFAULT NULL,
  `ask` datetime DEFAULT NULL,
  `ask_diff` int unsigned DEFAULT NULL,
  `subdomain` datetime DEFAULT NULL,
  `subdomain_diff` int unsigned DEFAULT NULL,
  `creating` datetime DEFAULT NULL,
  `creating_diff` int unsigned DEFAULT NULL,
  `startcreate` datetime DEFAULT NULL,
  `startcreate_diff` int unsigned DEFAULT NULL,
  `endcreate` datetime DEFAULT NULL,
  `endcreate_diff` int unsigned DEFAULT NULL,
  `opening` datetime DEFAULT NULL,
  `opening_diff` int unsigned DEFAULT NULL,
  `loadstore` datetime DEFAULT NULL,
  `loadstore_diff` int unsigned DEFAULT NULL,
  `users` datetime DEFAULT NULL,
  `productcompany` datetime DEFAULT NULL,
  `productunit` datetime DEFAULT NULL,
  `products` datetime DEFAULT NULL,
  `factors` datetime DEFAULT NULL,
  `factordetails` datetime DEFAULT NULL,
  `funds` datetime DEFAULT NULL,
  `inventory` datetime DEFAULT NULL,
  `productcategory` datetime DEFAULT NULL,
  `productcomment` datetime DEFAULT NULL,
  `productprices` datetime DEFAULT NULL,
  `productproperties` datetime DEFAULT NULL,
  `producttag` datetime DEFAULT NULL,
  `producttagusage` datetime DEFAULT NULL,
  `files` datetime DEFAULT NULL,
  `fileusage` datetime DEFAULT NULL,
  `agents` datetime DEFAULT NULL,
  `apilog` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_timeline_store_id` (`store_id`),
  CONSTRAINT `store_timeline_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1283 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `store_user`
--

DROP TABLE IF EXISTS `store_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int unsigned DEFAULT NULL,
  `creator` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `customer` enum('yes','no') DEFAULT NULL,
  `staff` enum('yes','no') DEFAULT NULL,
  `supplier` enum('yes','no') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_user_store_id` (`store_id`),
  KEY `store_user_user_id` (`user_id`),
  KEY `store_user_creator` (`creator`),
  CONSTRAINT `store_user_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `store_user_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `store_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4324 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telegrams`
--

DROP TABLE IF EXISTS `telegrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telegrams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chatid` bigint DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `post_id` bigint unsigned DEFAULT NULL,
  `product_id` int unsigned DEFAULT NULL,
  `message_id` bigint DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `step` text,
  `hook` mediumtext,
  `hooktext` text,
  `hookdate` datetime DEFAULT NULL,
  `hookmessageid` text,
  `send` mediumtext,
  `senddate` datetime DEFAULT NULL,
  `sendtext` text,
  `sendmesageid` text,
  `sendmethod` text,
  `sendkeyboard` text,
  `response` mediumtext,
  `responsedate` datetime DEFAULT NULL,
  `status` enum('enable','disable','ok','failed','other') DEFAULT NULL,
  `url` text,
  `meta` mediumtext,
  `send2` mediumtext,
  `response2` mediumtext,
  `send3` mediumtext,
  `response3` mediumtext,
  PRIMARY KEY (`id`),
  KEY `telegrams_search_index_chatid` (`chatid`),
  KEY `telegrams_search_index_user_id` (`user_id`),
  KEY `telegrams_search_index_post_id` (`post_id`),
  KEY `telegrams_search_index_product_id` (`product_id`),
  KEY `telegrams_search_index_message_id` (`message_id`),
  KEY `telegrams_search_index_username` (`username`),
  KEY `telegrams_search_index_status` (`status`),
  KEY `telegrams_search_index_senddate` (`senddate`)
) ENGINE=InnoDB AUTO_INCREMENT=223968 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_stats_monthly`
--

DROP TABLE IF EXISTS `temp_stats_monthly`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_stats_monthly` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `year` smallint DEFAULT NULL,
  `month` smallint DEFAULT NULL,
  `count_store` bigint DEFAULT NULL,
  `count_products` bigint DEFAULT NULL,
  `count_factors` bigint DEFAULT NULL,
  `count_factors_filtered` bigint DEFAULT NULL,
  `sum_factors` bigint DEFAULT NULL,
  `sum_factors_filtered` bigint DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `count_transaction` bigint DEFAULT NULL,
  `count_transaction_verify` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_temp_stats_monthly_year` (`year`),
  KEY `index_search_temp_stats_monthly_month` (`month`),
  KEY `index_search_temp_stats_monthly_count_store` (`count_store`),
  KEY `index_search_temp_stats_monthly_count_products` (`count_products`),
  KEY `index_search_temp_stats_monthly_count_factors` (`count_factors`),
  KEY `index_search_temp_stats_monthly_count_factors_filtered` (`count_factors_filtered`),
  KEY `index_search_temp_stats_monthly_sum_factors` (`sum_factors`),
  KEY `index_search_temp_stats_monthly_count_sum_factors_filtered` (`sum_factors_filtered`),
  KEY `index_search_temp_stats_monthly_count_transaction` (`count_transaction`),
  KEY `index_search_temp_stats_monthly_count_transaction_verify` (`count_transaction_verify`)
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `type` enum('cat','tag','code','other','term','support_tag','mag','mag_tag','help','help_tag') DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `desc` mediumtext,
  `meta` mediumtext,
  `parent` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `terms_users_id` (`user_id`),
  KEY `terms_type_search_index` (`type`),
  KEY `index_search_type` (`type`),
  CONSTRAINT `terms_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `termusages`
--

DROP TABLE IF EXISTS `termusages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `termusages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `term_id` int unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `sort` smallint DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('cat','tag','term','code','other','support_tag','mag','mag_tag','help','help_tag','barcode1','barcode2','barcode3','qrcode1','qrcode2','qrcode3','rfid1','rfid2','rfid3','fingerprint1','fingerprint2','fingerprint3','fingerprint4','fingerprint5','fingerprint6','fingerprint7','fingerprint8','fingerprint9','fingerprint10') DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `termusages_type_search_index` (`type`),
  KEY `termusages_index_post_id` (`post_id`),
  KEY `termusages_index_term_id` (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `guestid` varchar(50) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  `status` enum('new','awaiting','answered','close','spam','deleted','pending') DEFAULT NULL,
  `parent` bigint unsigned DEFAULT NULL,
  `base` bigint DEFAULT NULL,
  `branch` bigint DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `subtype` varchar(100) DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` bigint unsigned DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `plus` int unsigned DEFAULT NULL,
  `answertime` int unsigned DEFAULT NULL,
  `solved` bit(1) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  `see` bit(1) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tickets_users_id` (`user_id`),
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`),
  KEY `ticket_index_search_plus` (`plus`),
  KEY `ticket_index_search_answertime` (`answertime`),
  KEY `ticket_index_search_guestid` (`guestid`),
  KEY `ticket_index_search_agent_id` (`agent_id`),
  KEY `tickets_search_index_ip_id` (`ip_id`),
  CONSTRAINT `tickets_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `code` smallint NOT NULL,
  `title` varchar(255) NOT NULL,
  `caller` varchar(100) DEFAULT NULL,
  `type` enum('gift','prize','transfer','promo','money') NOT NULL,
  `amount_request` bigint DEFAULT NULL,
  `amount_end` bigint DEFAULT NULL,
  `plus` bigint unsigned DEFAULT NULL,
  `minus` bigint unsigned DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `budget_before` bigint DEFAULT NULL,
  `budget` bigint DEFAULT NULL,
  `status` enum('enable','disable','deleted','expired','awaiting','filtered','blocked','spam') NOT NULL DEFAULT 'enable',
  `condition` enum('request','redirect','cancel','pending','error','verify_request','verify_error','ok') DEFAULT NULL,
  `verify` bit(1) NOT NULL DEFAULT b'0',
  `parent_id` bigint unsigned DEFAULT NULL,
  `related_user_id` int unsigned DEFAULT NULL,
  `related_foreign` varchar(50) DEFAULT NULL,
  `related_id` bigint unsigned DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `payment_response` text,
  `meta` mediumtext,
  `desc` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `invoice_id` int unsigned DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dateverify` int unsigned DEFAULT NULL,
  `payment_response1` text,
  `payment_response2` text,
  `payment_response3` text,
  `payment_response4` text,
  `token` varchar(32) DEFAULT NULL,
  `banktoken` varchar(100) DEFAULT NULL,
  `finalmsg` bit(1) DEFAULT NULL,
  `ip_id` bigint unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `newtransactions_user_id` (`user_id`),
  KEY `transactions_index_token` (`token`),
  KEY `transactions_index_banktoken` (`banktoken`),
  KEY `transactions_index_payment` (`payment`),
  KEY `transactions_index_dateverify` (`dateverify`),
  KEY `transactions_index_verify` (`verify`),
  KEY `transactions_index_plus` (`plus`),
  KEY `transactions_index_minus` (`minus`),
  KEY `index_search_condition` (`condition`),
  KEY `transactions_currency_index` (`currency`),
  KEY `transactions_search_index_ip_id` (`ip_id`),
  KEY `transactions_search_index_agent_id` (`agent_id`),
  CONSTRAINT `newtransactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8826 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `urls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `urlmd5` varchar(32) DEFAULT NULL,
  `domain` varchar(500) DEFAULT NULL,
  `subdomain` varchar(200) DEFAULT NULL,
  `path` text,
  `query` text,
  `pwd` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `urlmd5_index` (`urlmd5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_android`
--

DROP TABLE IF EXISTS `user_android`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_android` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `uniquecode` char(32) NOT NULL,
  `osversion` varchar(200) DEFAULT NULL,
  `version` varchar(200) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `language` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting') DEFAULT NULL,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_android_user_id` (`user_id`),
  CONSTRAINT `user_android_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_auth`
--

DROP TABLE IF EXISTS `user_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_auth` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `auth` char(32) NOT NULL,
  `status` enum('enable','disable','expire','used') DEFAULT NULL,
  `gateway` enum('android','ios','api') DEFAULT NULL,
  `type` enum('guest','member','appkey') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gateway_id` int unsigned DEFAULT NULL,
  `parent` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_auth_user_id` (`user_id`),
  KEY `index_search_auth` (`auth`),
  KEY `index_search_status` (`status`),
  CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_telegram`
--

DROP TABLE IF EXISTS `user_telegram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_telegram` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `chatid` bigint NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `language` char(2) DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting','inline','callback') DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_tg_user_id` (`user_id`),
  KEY `index_search_chatid` (`chatid`),
  CONSTRAINT `user_tg_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userdetail`
--

DROP TABLE IF EXISTS `userdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userdetail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `creator` int unsigned DEFAULT NULL,
  `status` enum('enable','disable','filter','spam','delete') DEFAULT 'enable',
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userdetail_user_id` (`user_id`),
  KEY `userdetail_creator` (`creator`),
  CONSTRAINT `userdetail_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userdetail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `useremail`
--

DROP TABLE IF EXISTS `useremail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `useremail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `emailraw` varchar(200) DEFAULT NULL,
  `status` enum('enable','disable','filter','spam','delete') DEFAULT 'enable',
  `verify` bit(1) DEFAULT NULL,
  `dateverify` datetime DEFAULT NULL,
  `daterequestverify` datetime DEFAULT NULL,
  `primary` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `useremail_index_search_email` (`email`),
  KEY `useremail_index_search_primary` (`primary`),
  KEY `useremail_index_search_verify` (`verify`),
  KEY `useremail_user_id` (`user_id`),
  KEY `useremail_index_search_emailraw` (`emailraw`),
  CONSTRAINT `useremail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=581 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `gender` enum('male','female','company','rather not say') DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `password` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `verifymobile` bit(1) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `verifyemail` bit(1) DEFAULT NULL,
  `status` enum('active','awaiting','deactive','removed','filter','unreachable','ban','block') DEFAULT 'awaiting',
  `accounttype` enum('real','legal') DEFAULT 'real',
  `avatar` varchar(2000) DEFAULT NULL,
  `parent` int unsigned DEFAULT NULL,
  `permission` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pin` smallint unsigned DEFAULT NULL,
  `ref` int unsigned DEFAULT NULL,
  `twostep` bit(1) DEFAULT NULL,
  `subscribe` bit(1) DEFAULT NULL,
  `birthday` varchar(50) DEFAULT NULL,
  `unit_id` smallint DEFAULT NULL,
  `language` char(2) DEFAULT NULL,
  `meta` mediumtext,
  `website` varchar(200) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `gmail` varchar(200) DEFAULT NULL,
  `sidebar` bit(1) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `bio` text,
  `forceremember` bit(1) DEFAULT NULL,
  `signature` text,
  `father` varchar(100) DEFAULT NULL,
  `nationalcode` varchar(50) DEFAULT NULL,
  `nationality` varchar(5) DEFAULT NULL,
  `pasportcode` varchar(50) DEFAULT NULL,
  `pasportdate` varchar(20) DEFAULT NULL,
  `marital` enum('single','married') DEFAULT NULL,
  `foreign` bit(1) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `detail` text,
  `businesscount` int DEFAULT NULL,
  `ban_expire` datetime DEFAULT NULL,
  `companyname` varchar(200) DEFAULT NULL,
  `companyeconomiccode` varchar(200) DEFAULT NULL,
  `companynationalid` varchar(200) DEFAULT NULL,
  `companyregisternumber` varchar(200) DEFAULT NULL,
  `accounting_detail_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_search_mobile` (`mobile`),
  KEY `index_search_nationalcode` (`nationalcode`),
  KEY `index_search_pasportcode` (`pasportcode`),
  KEY `index_search_email` (`email`),
  KEY `index_search_username` (`username`),
  KEY `index_search_permission` (`permission`),
  KEY `index_search_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6519 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `statuscode` int DEFAULT NULL,
  `visitor_ip` bigint DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `url_id` int unsigned NOT NULL,
  `url_idreferer` int unsigned DEFAULT NULL,
  `agent_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avgtime` int unsigned DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visitors_agents` (`agent_id`),
  KEY `visitors_urls` (`url_id`),
  KEY `visitors_urls_referer` (`url_idreferer`),
  CONSTRAINT `visitors_agents` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `visitors_urls` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `visitors_urls_referer` FOREIGN KEY (`url_idreferer`) REFERENCES `urls` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-13 14:42:33
