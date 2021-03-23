-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2021 at 10:03 AM
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
-- Database: `jibres`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
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
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int UNSIGNED NOT NULL,
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
  `agentmd5` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Table structure for table `business_domain`
--

CREATE TABLE `business_domain` (
  `id` int UNSIGNED NOT NULL,
  `domain` varchar(150) DEFAULT NULL,
  `domain_id` int UNSIGNED DEFAULT NULL,
  `store_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `subdomain` varchar(150) DEFAULT NULL,
  `root` varchar(150) DEFAULT NULL,
  `tld` varchar(150) DEFAULT NULL,
  `master` bit(1) DEFAULT NULL,
  `redirecttomaster` bit(1) DEFAULT NULL,
  `cdn` enum('arvancloud','cloudflare','enterprise') DEFAULT NULL,
  `status` enum('pending','failed','ok','pending_delete','deleted','inprogress','dns_not_resolved') DEFAULT NULL,
  `checkdns` timestamp NULL DEFAULT NULL,
  `cdnpanel` timestamp NULL DEFAULT NULL,
  `httpsrequest` timestamp NULL DEFAULT NULL,
  `httpsverify` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `dnsok` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_domain_action`
--

CREATE TABLE `business_domain_action` (
  `id` bigint UNSIGNED NOT NULL,
  `business_domain_id` int UNSIGNED DEFAULT NULL,
  `action` varchar(300) DEFAULT NULL,
  `desc` text,
  `meta` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `gateway` enum('user','system') DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_domain_dns`
--

CREATE TABLE `business_domain_dns` (
  `id` bigint UNSIGNED NOT NULL,
  `business_domain_id` int UNSIGNED DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  `key` varchar(150) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `verify` bit(1) DEFAULT NULL,
  `status` enum('pending','failed','ok','pending_delete','deleted','inprogress','waiting_to_connect_cdn') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `for` enum('page','post','product') DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext,
  `gallery` text,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter') DEFAULT NULL,
  `parent` bigint UNSIGNED DEFAULT NULL,
  `star` smallint DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `csrf`
--

CREATE TABLE `csrf` (
  `id` bigint UNSIGNED NOT NULL,
  `token` char(32) DEFAULT NULL,
  `urlmd5` char(32) DEFAULT NULL,
  `status` enum('active','used','expire','deleted','disabled','block') DEFAULT NULL,
  `url` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dayevent`
--

CREATE TABLE `dayevent` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `countcalc` int UNSIGNED DEFAULT NULL,
  `dbtrafic` int UNSIGNED DEFAULT NULL,
  `dbsize` int UNSIGNED DEFAULT NULL,
  `user` int UNSIGNED DEFAULT NULL,
  `activeuser` int UNSIGNED DEFAULT NULL,
  `deactiveuser` int UNSIGNED DEFAULT NULL,
  `log` int UNSIGNED DEFAULT NULL,
  `visitor` int UNSIGNED DEFAULT NULL,
  `agent` int UNSIGNED DEFAULT NULL,
  `session` int UNSIGNED DEFAULT NULL,
  `urls` int UNSIGNED DEFAULT NULL,
  `ticket` int UNSIGNED DEFAULT NULL,
  `comment` int UNSIGNED DEFAULT NULL,
  `address` int UNSIGNED DEFAULT NULL,
  `news` int UNSIGNED DEFAULT NULL,
  `page` int UNSIGNED DEFAULT NULL,
  `post` int UNSIGNED DEFAULT NULL,
  `transaction` int UNSIGNED DEFAULT NULL,
  `term` int UNSIGNED DEFAULT NULL,
  `termusages` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `help` int UNSIGNED DEFAULT NULL,
  `attachment` int UNSIGNED DEFAULT NULL,
  `tag` int UNSIGNED DEFAULT NULL,
  `cat` int UNSIGNED DEFAULT NULL,
  `support_tag` int UNSIGNED DEFAULT NULL,
  `help_tag` int UNSIGNED DEFAULT NULL,
  `user_mobile` int UNSIGNED DEFAULT NULL,
  `user_email` int UNSIGNED DEFAULT NULL,
  `user_chatid` int UNSIGNED DEFAULT NULL,
  `user_username` int UNSIGNED DEFAULT NULL,
  `user_android` int UNSIGNED DEFAULT NULL,
  `user_awaiting` int UNSIGNED DEFAULT NULL,
  `user_removed` int UNSIGNED DEFAULT NULL,
  `user_filter` int UNSIGNED DEFAULT NULL,
  `user_unreachabl` int UNSIGNED DEFAULT NULL,
  `user_permission` int UNSIGNED DEFAULT NULL,
  `ticket_message` int UNSIGNED DEFAULT NULL,
  `userdetail` int UNSIGNED DEFAULT NULL,
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
  `visitor_ip` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_log`
--

CREATE TABLE `email_log` (
  `id` bigint UNSIGNED NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `template` varchar(100) DEFAULT NULL,
  `content` text,
  `type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
  `status` enum('pending','sending','send','sended','delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `url` text,
  `urlmd5` char(32) DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `send` text,
  `response` text,
  `datesend` timestamp NULL DEFAULT NULL,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int UNSIGNED NOT NULL,
  `creator` int UNSIGNED DEFAULT NULL,
  `md5` char(32) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `mime` varchar(200) DEFAULT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `folder` varchar(100) DEFAULT NULL,
  `path` varchar(2000) DEFAULT NULL,
  `size` int UNSIGNED DEFAULT NULL,
  `height` int DEFAULT NULL,
  `width` int DEFAULT NULL,
  `ratio` decimal(5,2) DEFAULT NULL,
  `totalsize` int DEFAULT NULL,
  `status` enum('awaiting','publish','block','filter','removed','spam') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip` bigint DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `domain` varchar(200) DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fileusage`
--

CREATE TABLE `fileusage` (
  `id` int UNSIGNED NOT NULL,
  `file_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `alt` varchar(200) DEFAULT NULL,
  `desc` text,
  `related` varchar(100) DEFAULT NULL,
  `related_id` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `id` bigint UNSIGNED NOT NULL,
  `giftpercent` smallint UNSIGNED DEFAULT NULL,
  `giftamount` bigint UNSIGNED DEFAULT NULL,
  `giftmax` bigint UNSIGNED DEFAULT NULL,
  `pricefloor` bigint UNSIGNED DEFAULT NULL,
  `desc` text,
  `creator` int UNSIGNED DEFAULT NULL,
  `usagetotal` int UNSIGNED DEFAULT NULL,
  `usageperuser` smallint UNSIGNED DEFAULT NULL,
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
  `chap` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giftlookup`
--

CREATE TABLE `giftlookup` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `gift_id` bigint UNSIGNED DEFAULT NULL,
  `valid` enum('yes','no') DEFAULT NULL,
  `errortype` varchar(100) DEFAULT NULL,
  `message` text,
  `datecreated` timestamp NULL DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giftusage`
--

CREATE TABLE `giftusage` (
  `id` bigint UNSIGNED NOT NULL,
  `gift_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `transaction_id` bigint UNSIGNED DEFAULT NULL,
  `price` bigint UNSIGNED DEFAULT NULL,
  `discount` bigint UNSIGNED DEFAULT NULL,
  `discountpercent` smallint UNSIGNED DEFAULT NULL,
  `finalprice` bigint UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(200) NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `jibres_user_id` int UNSIGNED DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `ip_md5` char(32) DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `agent_md5` char(32) DEFAULT NULL,
  `status` enum('active','expire','logout','changepassword','deleted','hijack','changeip','changeagent','block','error') DEFAULT NULL,
  `place` enum('jibres','subdomain','admin','customer_domain','api_core','api_business','telegram') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `trustdomain` varchar(200) DEFAULT NULL,
  `meta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_ip`
--

CREATE TABLE `login_ip` (
  `id` bigint UNSIGNED NOT NULL,
  `login_id` bigint UNSIGNED DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint UNSIGNED NOT NULL,
  `caller` varchar(200) DEFAULT NULL,
  `type` enum('public','system','db','php') DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `send` bit(1) DEFAULT NULL,
  `to` int UNSIGNED DEFAULT NULL,
  `notif` bit(1) DEFAULT NULL,
  `from` int UNSIGNED DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `readdate` timestamp NULL DEFAULT NULL,
  `data` text,
  `status` enum('enable','disable','expire','deliver','awaiting','deleted','cancel','block','notif','notifread','notifexpire') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `visitor_id` bigint UNSIGNED DEFAULT NULL,
  `meta` mediumtext,
  `sms` text,
  `telegram` text,
  `email` text,
  `expiredate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_notif`
--

CREATE TABLE `log_notif` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('ok','error','warn','info') DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `messagemd5` char(32) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `urlkingdom` varchar(255) DEFAULT NULL,
  `urldir` varchar(255) DEFAULT NULL,
  `urlquery` varchar(255) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `meta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
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
  `parent` bigint UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subtype` enum('standard','gallery','video','audio') DEFAULT 'standard',
  `redirecturl` text,
  `specialaddress` enum('independence','special','under_tag','under_page') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(64) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `status` enum('active','terminate','expire','disable','changed','logout') NOT NULL DEFAULT 'active',
  `agent_id` int UNSIGNED DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `count` int UNSIGNED DEFAULT '1',
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_seen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int UNSIGNED NOT NULL,
  `platform` enum('android','ios','telegram','website') DEFAULT NULL,
  `lang` char(2) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `cat` varchar(50) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

CREATE TABLE `sms_log` (
  `id` bigint UNSIGNED NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `mobiles` text,
  `message` text,
  `len` int DEFAULT NULL,
  `smscount` smallint DEFAULT NULL,
  `cost` decimal(13,4) DEFAULT NULL,
  `amount` decimal(13,4) DEFAULT NULL,
  `mode` enum('sms','call','tts') DEFAULT NULL,
  `type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
  `status` enum('pending','sending','send','sended','delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
  `sender` enum('system','admin','customer') DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `url` text,
  `urlmd5` char(32) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int UNSIGNED NOT NULL,
  `subdomain` varchar(50) DEFAULT NULL,
  `fuel` varchar(150) DEFAULT NULL,
  `creator` int UNSIGNED DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `status` enum('enable','close','deleted','spam','hard_delete','upgrade','transfer','backup','lock','broken','limitation','creating','failed','error') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_analytics`
--

CREATE TABLE `store_analytics` (
  `id` int UNSIGNED NOT NULL,
  `question1` smallint UNSIGNED DEFAULT NULL,
  `question2` smallint UNSIGNED DEFAULT NULL,
  `question3` smallint UNSIGNED DEFAULT NULL,
  `lastactivity` timestamp NULL DEFAULT NULL,
  `lastchangesetting` timestamp NULL DEFAULT NULL,
  `lastadminlogin` timestamp NULL DEFAULT NULL,
  `laststafflogin` timestamp NULL DEFAULT NULL,
  `lastsale` timestamp NULL DEFAULT NULL,
  `lastbuy` timestamp NULL DEFAULT NULL,
  `dbtrafic` bigint UNSIGNED DEFAULT NULL,
  `dbsize` bigint UNSIGNED DEFAULT NULL,
  `user` bigint DEFAULT NULL,
  `customer` int UNSIGNED DEFAULT NULL,
  `staff` int UNSIGNED DEFAULT NULL,
  `agent` int UNSIGNED DEFAULT NULL,
  `session` int UNSIGNED DEFAULT NULL,
  `ticket` int UNSIGNED DEFAULT NULL,
  `ticket_message` int UNSIGNED DEFAULT NULL,
  `comment` int UNSIGNED DEFAULT NULL,
  `address` int UNSIGNED DEFAULT NULL,
  `news` int UNSIGNED DEFAULT NULL,
  `page` int UNSIGNED DEFAULT NULL,
  `post` int UNSIGNED DEFAULT NULL,
  `transaction` int UNSIGNED DEFAULT NULL,
  `term` int UNSIGNED DEFAULT NULL,
  `termusages` int UNSIGNED DEFAULT NULL,
  `sumplustransaction` bigint UNSIGNED DEFAULT NULL,
  `summinustransaction` bigint UNSIGNED DEFAULT NULL,
  `product` int UNSIGNED DEFAULT NULL,
  `factor` bigint UNSIGNED DEFAULT NULL,
  `factorbuy` bigint UNSIGNED DEFAULT NULL,
  `factorsale` bigint UNSIGNED DEFAULT NULL,
  `factordetail` bigint UNSIGNED DEFAULT NULL,
  `sumfactor` bigint UNSIGNED DEFAULT NULL,
  `planhistory` int UNSIGNED DEFAULT NULL,
  `help` int UNSIGNED DEFAULT NULL,
  `attachment` int UNSIGNED DEFAULT NULL,
  `tag` int UNSIGNED DEFAULT NULL,
  `cat` int UNSIGNED DEFAULT NULL,
  `support_tag` int UNSIGNED DEFAULT NULL,
  `help_tag` int UNSIGNED DEFAULT NULL,
  `user_mobile` int UNSIGNED DEFAULT NULL,
  `user_email` int UNSIGNED DEFAULT NULL,
  `user_chatid` int UNSIGNED DEFAULT NULL,
  `user_username` int UNSIGNED DEFAULT NULL,
  `user_android` int UNSIGNED DEFAULT NULL,
  `user_awaiting` int UNSIGNED DEFAULT NULL,
  `user_removed` int UNSIGNED DEFAULT NULL,
  `user_filter` int UNSIGNED DEFAULT NULL,
  `user_unreachabl` int UNSIGNED DEFAULT NULL,
  `user_permission` int UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `log` bigint UNSIGNED DEFAULT NULL,
  `cart` bigint UNSIGNED DEFAULT NULL,
  `sync` bigint UNSIGNED DEFAULT NULL,
  `apilog` bigint UNSIGNED DEFAULT NULL,
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
  `visitors` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_app`
--

CREATE TABLE `store_app` (
  `id` bigint UNSIGNED NOT NULL,
  `store_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `version` smallint UNSIGNED DEFAULT NULL,
  `build` int UNSIGNED DEFAULT NULL,
  `status` enum('queue','inprogress','done','failed','disable','expire','cancel','delete','enable','info','error') DEFAULT NULL,
  `daterequest` timestamp NULL DEFAULT NULL,
  `datequeue` timestamp NULL DEFAULT NULL,
  `datedone` timestamp NULL DEFAULT NULL,
  `datedownload` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(500) DEFAULT NULL,
  `meta` text,
  `versiontitle` varchar(50) DEFAULT NULL,
  `versionnumber` int UNSIGNED DEFAULT NULL,
  `packagename` varchar(200) DEFAULT NULL,
  `keystore` varchar(50) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_data`
--

CREATE TABLE `store_data` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `storage` bigint DEFAULT NULL,
  `uploadsize` bigint DEFAULT NULL,
  `enterprise` varchar(100) DEFAULT NULL,
  `owner` int UNSIGNED DEFAULT NULL,
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
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_domain`
--

CREATE TABLE `store_domain` (
  `id` bigint UNSIGNED NOT NULL,
  `store_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
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
  `sslfailed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_file`
--

CREATE TABLE `store_file` (
  `id` int UNSIGNED NOT NULL,
  `store_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `md5` char(32) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `mime` varchar(200) DEFAULT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `folder` varchar(100) DEFAULT NULL,
  `path` varchar(2000) DEFAULT NULL,
  `size` int UNSIGNED DEFAULT NULL,
  `status` enum('draft','awaiting','publish','block','filter','removed','spam') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_plan`
--

CREATE TABLE `store_plan` (
  `id` bigint UNSIGNED NOT NULL,
  `store_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `plan` varchar(100) DEFAULT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `type` enum('change','continuation','upgrade','downgrade','set','auto') DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT NULL,
  `price` int UNSIGNED DEFAULT NULL,
  `discount` int UNSIGNED DEFAULT NULL,
  `promo` varchar(100) DEFAULT NULL,
  `period` enum('monthly','yearly') DEFAULT NULL,
  `expireplan` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_timeline`
--

CREATE TABLE `store_timeline` (
  `id` int UNSIGNED NOT NULL,
  `store_id` int UNSIGNED DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `login_diff` int UNSIGNED DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `start_diff` int UNSIGNED DEFAULT NULL,
  `ask` datetime DEFAULT NULL,
  `ask_diff` int UNSIGNED DEFAULT NULL,
  `subdomain` datetime DEFAULT NULL,
  `subdomain_diff` int UNSIGNED DEFAULT NULL,
  `creating` datetime DEFAULT NULL,
  `creating_diff` int UNSIGNED DEFAULT NULL,
  `startcreate` datetime DEFAULT NULL,
  `startcreate_diff` int UNSIGNED DEFAULT NULL,
  `endcreate` datetime DEFAULT NULL,
  `endcreate_diff` int UNSIGNED DEFAULT NULL,
  `opening` datetime DEFAULT NULL,
  `opening_diff` int UNSIGNED DEFAULT NULL,
  `loadstore` datetime DEFAULT NULL,
  `loadstore_diff` int UNSIGNED DEFAULT NULL,
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
  `apilog` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_user`
--

CREATE TABLE `store_user` (
  `id` bigint UNSIGNED NOT NULL,
  `store_id` int UNSIGNED DEFAULT NULL,
  `creator` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `customer` enum('yes','no') DEFAULT NULL,
  `staff` enum('yes','no') DEFAULT NULL,
  `supplier` enum('yes','no') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telegrams`
--

CREATE TABLE `telegrams` (
  `id` bigint UNSIGNED NOT NULL,
  `chatid` bigint DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` int UNSIGNED DEFAULT NULL,
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
  `response3` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int UNSIGNED NOT NULL,
  `language` char(2) DEFAULT NULL,
  `type` enum('cat','tag','code','other','term','support_tag','mag','mag_tag','help','help_tag') DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `desc` mediumtext,
  `meta` mediumtext,
  `parent` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--

CREATE TABLE `termusages` (
  `id` bigint NOT NULL,
  `term_id` int UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `sort` smallint DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('cat','tag','term','code','other','support_tag','mag','mag_tag','help','help_tag','barcode1','barcode2','barcode3','qrcode1','qrcode2','qrcode3','rfid1','rfid2','rfid3','fingerprint1','fingerprint2','fingerprint3','fingerprint4','fingerprint5','fingerprint6','fingerprint7','fingerprint8','fingerprint9','fingerprint10') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `guestid` varchar(50) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  `status` enum('new','awaiting','answered','close','spam','deleted','pending') DEFAULT NULL,
  `parent` bigint UNSIGNED DEFAULT NULL,
  `base` bigint DEFAULT NULL,
  `branch` bigint DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `subtype` varchar(100) DEFAULT NULL,
  `ip` bigint DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `plus` int UNSIGNED DEFAULT NULL,
  `answertime` int UNSIGNED DEFAULT NULL,
  `solved` bit(1) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  `see` bit(1) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `code` smallint NOT NULL,
  `title` varchar(255) NOT NULL,
  `caller` varchar(100) DEFAULT NULL,
  `type` enum('gift','prize','transfer','promo','money') NOT NULL,
  `amount_request` bigint DEFAULT NULL,
  `amount_end` bigint DEFAULT NULL,
  `plus` bigint UNSIGNED DEFAULT NULL,
  `minus` bigint UNSIGNED DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `budget_before` bigint DEFAULT NULL,
  `budget` bigint DEFAULT NULL,
  `status` enum('enable','disable','deleted','expired','awaiting','filtered','blocked','spam') NOT NULL DEFAULT 'enable',
  `condition` enum('request','redirect','cancel','pending','error','verify_request','verify_error','ok') DEFAULT NULL,
  `verify` bit(1) NOT NULL DEFAULT b'0',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `related_user_id` int UNSIGNED DEFAULT NULL,
  `related_foreign` varchar(50) DEFAULT NULL,
  `related_id` bigint UNSIGNED DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `payment_response` text,
  `meta` mediumtext,
  `desc` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `invoice_id` int UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dateverify` int UNSIGNED DEFAULT NULL,
  `payment_response1` text,
  `payment_response2` text,
  `payment_response3` text,
  `payment_response4` text,
  `token` varchar(32) DEFAULT NULL,
  `banktoken` varchar(100) DEFAULT NULL,
  `finalmsg` bit(1) DEFAULT NULL,
  `ip_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int UNSIGNED NOT NULL,
  `urlmd5` varchar(32) DEFAULT NULL,
  `domain` varchar(500) DEFAULT NULL,
  `subdomain` varchar(200) DEFAULT NULL,
  `path` text,
  `query` text,
  `pwd` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `creator` int UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','filter','spam','delete') DEFAULT 'enable',
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `useremail`
--

CREATE TABLE `useremail` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `status` enum('enable','disable','filter','spam','delete') DEFAULT 'enable',
  `verify` bit(1) DEFAULT NULL,
  `primary` bit(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `gender` enum('male','female','company','rather not say') DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `verifymobile` bit(1) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `verifyemail` bit(1) DEFAULT NULL,
  `status` enum('active','awaiting','deactive','removed','filter','unreachable','ban','block') DEFAULT 'awaiting',
  `accounttype` enum('real','legal') DEFAULT 'real',
  `avatar` varchar(2000) DEFAULT NULL,
  `parent` int UNSIGNED DEFAULT NULL,
  `permission` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pin` smallint UNSIGNED DEFAULT NULL,
  `ref` int UNSIGNED DEFAULT NULL,
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
  `companyregisternumber` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_android`
--

CREATE TABLE `user_android` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
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
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE `user_auth` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `auth` char(32) NOT NULL,
  `status` enum('enable','disable','expire','used') DEFAULT NULL,
  `gateway` enum('android','ios','api') DEFAULT NULL,
  `type` enum('guest','member','appkey') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gateway_id` int UNSIGNED DEFAULT NULL,
  `parent` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_telegram`
--

CREATE TABLE `user_telegram` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `chatid` bigint NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `language` char(2) DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting','inline','callback') DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `statuscode` int DEFAULT NULL,
  `visitor_ip` bigint DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `url_id` int UNSIGNED NOT NULL,
  `url_idreferer` int UNSIGNED DEFAULT NULL,
  `agent_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avgtime` int UNSIGNED DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id` (`user_id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_agentmd5` (`agentmd5`);

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
-- Indexes for table `business_domain`
--
ALTER TABLE `business_domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_domain_index_domain` (`domain`),
  ADD KEY `business_domain_index_checkdns` (`checkdns`),
  ADD KEY `business_domain_index_store_id` (`store_id`),
  ADD KEY `business_domain_index_domain_id` (`domain_id`),
  ADD KEY `business_domain_index_cdnpanel` (`cdnpanel`),
  ADD KEY `business_domain_index_httpsrequest` (`httpsrequest`),
  ADD KEY `business_domain_index_httpsverify` (`httpsverify`),
  ADD KEY `business_domain_index_status` (`status`),
  ADD KEY `business_domain_index_master` (`master`),
  ADD KEY `business_domain_index_datemodified` (`datemodified`),
  ADD KEY `business_domain_index_dnsok` (`dnsok`),
  ADD KEY `business_domain_index_redirecttomaster` (`redirecttomaster`),
  ADD KEY `business_domain_index_subdomain` (`subdomain`),
  ADD KEY `business_domain_index_cdn` (`cdn`);

--
-- Indexes for table `business_domain_action`
--
ALTER TABLE `business_domain_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_domain_action_business_domain_id` (`business_domain_id`),
  ADD KEY `business_domain_action_index_action` (`action`),
  ADD KEY `business_domain_action_index_datecreated` (`datecreated`);

--
-- Indexes for table `business_domain_dns`
--
ALTER TABLE `business_domain_dns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_domain_dns_business_domain_id` (`business_domain_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_posts_id` (`post_id`),
  ADD KEY `comments_users_id` (`user_id`),
  ADD KEY `index_search_star` (`star`),
  ADD KEY `index_search_for` (`for`),
  ADD KEY `index_search_ip` (`ip`),
  ADD KEY `index_search_agent_id` (`agent_id`),
  ADD KEY `index_search_status` (`status`);

--
-- Indexes for table `csrf`
--
ALTER TABLE `csrf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jibres_csrf_status` (`status`),
  ADD KEY `jibres_csrf_token` (`token`),
  ADD KEY `jibres_csrf_urlmd5` (`urlmd5`),
  ADD KEY `jibres_csrf_datemodified` (`datemodified`),
  ADD KEY `jibres_csrf_check` (`token`,`urlmd5`,`status`),
  ADD KEY `csrf_search_index_ip_id` (`ip_id`),
  ADD KEY `csrf_search_index_agent_id` (`agent_id`);

--
-- Indexes for table `dayevent`
--
ALTER TABLE `dayevent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_log`
--
ALTER TABLE `email_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emaillog_status` (`status`),
  ADD KEY `emaillog_template` (`template`),
  ADD KEY `emaillog_email` (`email`),
  ADD KEY `emaillog_urlmd5` (`urlmd5`),
  ADD KEY `emaillog_type` (`type`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_creator` (`creator`),
  ADD KEY `files_md5_search` (`md5`),
  ADD KEY `files_search_index_filename` (`filename`),
  ADD KEY `files_search_index_type` (`type`),
  ADD KEY `files_search_index_ext` (`ext`),
  ADD KEY `files_search_index_size` (`size`),
  ADD KEY `files_search_index_totalsize` (`totalsize`),
  ADD KEY `files_search_index_status` (`status`),
  ADD KEY `files_search_index_height` (`height`),
  ADD KEY `files_search_index_width` (`width`),
  ADD KEY `files_search_index_ratio` (`ratio`);

--
-- Indexes for table `fileusage`
--
ALTER TABLE `fileusage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileuseage_related_search` (`related`),
  ADD KEY `fileuseage_related_id_search` (`related_id`),
  ADD KEY `fileusage_user_id` (`user_id`),
  ADD KEY `fileusage_file_id` (`file_id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gift_index_search_code` (`code`),
  ADD KEY `gift_index_search_status` (`status`),
  ADD KEY `gift_creator` (`creator`);

--
-- Indexes for table `giftlookup`
--
ALTER TABLE `giftlookup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giftlookup_index_search_code` (`code`),
  ADD KEY `giftlookup_index_search_user_id` (`user_id`),
  ADD KEY `giftlookup_index_search_valid` (`valid`),
  ADD KEY `giftlookup_index_search_gift_id` (`gift_id`);

--
-- Indexes for table `giftusage`
--
ALTER TABLE `giftusage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giftusage_user_id` (`user_id`),
  ADD KEY `giftusage_transaction_id` (`transaction_id`),
  ADD KEY `giftusage_gift_id` (`gift_id`),
  ADD KEY `giftusage_search_index_ip_id` (`ip_id`),
  ADD KEY `giftusage_search_index_agent_id` (`agent_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jibres_login_code` (`code`),
  ADD KEY `jibres_login_status` (`status`);

--
-- Indexes for table `login_ip`
--
ALTER TABLE `login_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_status_index` (`status`),
  ADD KEY `log_to_index` (`to`),
  ADD KEY `log_expiredate` (`expiredate`),
  ADD KEY `log_caller` (`caller`),
  ADD KEY `log_code` (`code`),
  ADD KEY `index_search_send` (`send`),
  ADD KEY `index_search_notif` (`notif`),
  ADD KEY `index_search_caller` (`caller`),
  ADD KEY `index_search_subdomain` (`subdomain`),
  ADD KEY `index_search_readdate` (`readdate`),
  ADD KEY `index_search_datecreated` (`datecreated`),
  ADD KEY `jibres_log_index_type` (`type`),
  ADD KEY `logs_search_index_ip_id` (`ip_id`),
  ADD KEY `logs_search_index_agent_id` (`agent_id`);

--
-- Indexes for table `log_notif`
--
ALTER TABLE `log_notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_notif_search_index_messagemd5` (`messagemd5`),
  ADD KEY `log_notif_search_index_type` (`type`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url_unique` (`url`,`language`) USING BTREE,
  ADD KEY `posts_users_id` (`user_id`),
  ADD KEY `index_search_status` (`status`),
  ADD KEY `index_search_type` (`type`),
  ADD KEY `index_search_language` (`language`),
  ADD KEY `index_search_publishdate` (`publishdate`),
  ADD KEY `index_search_url` (`url`),
  ADD KEY `index_search_slug` (`slug`),
  ADD KEY `search_index_subtype` (`subtype`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`code`) USING BTREE,
  ADD KEY `sessions_user_id` (`user_id`),
  ADD KEY `index_search_code` (`code`),
  ADD KEY `index_search_user_id` (`user_id`),
  ADD KEY `index_search_status` (`status`),
  ADD KEY `index_search_agent_id` (`agent_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_index_search_cat` (`cat`),
  ADD KEY `setting_index_search_key` (`key`),
  ADD KEY `setting_index_search_lang` (`lang`),
  ADD KEY `setting_index_search_platform` (`platform`);

--
-- Indexes for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `smslog_cost` (`cost`),
  ADD KEY `smslog_amount` (`amount`),
  ADD KEY `smslog_status` (`status`),
  ADD KEY `smslog_mobile` (`mobile`),
  ADD KEY `smslog_urlmd5` (`urlmd5`),
  ADD KEY `smslog_mode` (`mode`),
  ADD KEY `smslog_len` (`len`),
  ADD KEY `smslog_type` (`type`),
  ADD KEY `smslog_sender` (`sender`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_creator` (`creator`),
  ADD KEY `store_subdomain` (`subdomain`),
  ADD KEY `store_index_search_status` (`status`);

--
-- Indexes for table `store_analytics`
--
ALTER TABLE `store_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_app`
--
ALTER TABLE `store_app`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_store_app_status` (`status`),
  ADD KEY `store_app_store_id` (`store_id`);

--
-- Indexes for table `store_data`
--
ALTER TABLE `store_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_data_owner` (`owner`);

--
-- Indexes for table `store_domain`
--
ALTER TABLE `store_domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_domain` (`domain`),
  ADD KEY `store_domain_store_id` (`store_id`),
  ADD KEY `store_domain_creator` (`user_id`),
  ADD KEY `store_domain_index_search_master` (`master`);

--
-- Indexes for table `store_file`
--
ALTER TABLE `store_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_files_user_id` (`user_id`),
  ADD KEY `files_md5_search` (`md5`);

--
-- Indexes for table `store_plan`
--
ALTER TABLE `store_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_plan_store_id` (`store_id`),
  ADD KEY `store_plan_creator` (`user_id`);

--
-- Indexes for table `store_timeline`
--
ALTER TABLE `store_timeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_timeline_store_id` (`store_id`);

--
-- Indexes for table `store_user`
--
ALTER TABLE `store_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_user_store_id` (`store_id`),
  ADD KEY `store_user_user_id` (`user_id`),
  ADD KEY `store_user_creator` (`creator`);

--
-- Indexes for table `telegrams`
--
ALTER TABLE `telegrams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telegrams_search_index_chatid` (`chatid`),
  ADD KEY `telegrams_search_index_user_id` (`user_id`),
  ADD KEY `telegrams_search_index_post_id` (`post_id`),
  ADD KEY `telegrams_search_index_product_id` (`product_id`),
  ADD KEY `telegrams_search_index_message_id` (`message_id`),
  ADD KEY `telegrams_search_index_username` (`username`),
  ADD KEY `telegrams_search_index_status` (`status`),
  ADD KEY `telegrams_search_index_senddate` (`senddate`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terms_users_id` (`user_id`),
  ADD KEY `terms_type_search_index` (`type`),
  ADD KEY `index_search_type` (`type`);

--
-- Indexes for table `termusages`
--
ALTER TABLE `termusages`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `termusages_type_search_index` (`type`),
  ADD KEY `termusages_index_post_id` (`post_id`),
  ADD KEY `termusages_index_term_id` (`term_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_users_id` (`user_id`),
  ADD KEY `index_search_status` (`status`),
  ADD KEY `index_search_type` (`type`),
  ADD KEY `ticket_index_search_plus` (`plus`),
  ADD KEY `ticket_index_search_answertime` (`answertime`),
  ADD KEY `ticket_index_search_guestid` (`guestid`),
  ADD KEY `ticket_index_search_agent_id` (`agent_id`),
  ADD KEY `tickets_search_index_ip_id` (`ip_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `newtransactions_user_id` (`user_id`),
  ADD KEY `transactions_index_token` (`token`),
  ADD KEY `transactions_index_banktoken` (`banktoken`),
  ADD KEY `transactions_index_payment` (`payment`),
  ADD KEY `transactions_index_dateverify` (`dateverify`),
  ADD KEY `transactions_index_verify` (`verify`),
  ADD KEY `transactions_index_plus` (`plus`),
  ADD KEY `transactions_index_minus` (`minus`),
  ADD KEY `index_search_condition` (`condition`),
  ADD KEY `transactions_currency_index` (`currency`),
  ADD KEY `transactions_search_index_ip_id` (`ip_id`),
  ADD KEY `transactions_search_index_agent_id` (`agent_id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urlmd5_index` (`urlmd5`);

--
-- Indexes for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userdetail_user_id` (`user_id`),
  ADD KEY `userdetail_creator` (`creator`);

--
-- Indexes for table `useremail`
--
ALTER TABLE `useremail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useremail_index_search_email` (`email`),
  ADD KEY `useremail_index_search_primary` (`primary`),
  ADD KEY `useremail_index_search_verify` (`verify`),
  ADD KEY `useremail_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_mobile` (`mobile`),
  ADD KEY `index_search_nationalcode` (`nationalcode`),
  ADD KEY `index_search_pasportcode` (`pasportcode`),
  ADD KEY `index_search_email` (`email`),
  ADD KEY `index_search_username` (`username`),
  ADD KEY `index_search_permission` (`permission`),
  ADD KEY `index_search_status` (`status`);

--
-- Indexes for table `user_android`
--
ALTER TABLE `user_android`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_android_user_id` (`user_id`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_auth_user_id` (`user_id`),
  ADD KEY `index_search_auth` (`auth`),
  ADD KEY `index_search_status` (`status`);

--
-- Indexes for table `user_telegram`
--
ALTER TABLE `user_telegram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_tg_user_id` (`user_id`),
  ADD KEY `index_search_chatid` (`chatid`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_agents` (`agent_id`),
  ADD KEY `visitors_urls` (`url_id`),
  ADD KEY `visitors_urls_referer` (`url_idreferer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apilog`
--
ALTER TABLE `apilog`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_domain`
--
ALTER TABLE `business_domain`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_domain_action`
--
ALTER TABLE `business_domain_action`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_domain_dns`
--
ALTER TABLE `business_domain_dns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csrf`
--
ALTER TABLE `csrf`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dayevent`
--
ALTER TABLE `dayevent`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_log`
--
ALTER TABLE `email_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fileusage`
--
ALTER TABLE `fileusage`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giftlookup`
--
ALTER TABLE `giftlookup`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giftusage`
--
ALTER TABLE `giftusage`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_ip`
--
ALTER TABLE `login_ip`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_notif`
--
ALTER TABLE `log_notif`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_log`
--
ALTER TABLE `sms_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_app`
--
ALTER TABLE `store_app`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_domain`
--
ALTER TABLE `store_domain`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_file`
--
ALTER TABLE `store_file`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_plan`
--
ALTER TABLE `store_plan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_timeline`
--
ALTER TABLE `store_timeline`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_user`
--
ALTER TABLE `store_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telegrams`
--
ALTER TABLE `telegrams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `termusages`
--
ALTER TABLE `termusages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userdetail`
--
ALTER TABLE `userdetail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useremail`
--
ALTER TABLE `useremail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_android`
--
ALTER TABLE `user_android`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_telegram`
--
ALTER TABLE `user_telegram`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `business_domain`
--
ALTER TABLE `business_domain`
  ADD CONSTRAINT `business_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `business_domain_action`
--
ALTER TABLE `business_domain_action`
  ADD CONSTRAINT `business_domain_action_business_domain_id` FOREIGN KEY (`business_domain_id`) REFERENCES `business_domain` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `business_domain_dns`
--
ALTER TABLE `business_domain_dns`
  ADD CONSTRAINT `business_domain_dns_business_domain_id` FOREIGN KEY (`business_domain_id`) REFERENCES `business_domain` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `fileusage`
--
ALTER TABLE `fileusage`
  ADD CONSTRAINT `fileusage_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fileusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `gift`
--
ALTER TABLE `gift`
  ADD CONSTRAINT `gift_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `giftusage`
--
ALTER TABLE `giftusage`
  ADD CONSTRAINT `giftusage_gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `giftusage_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `giftusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_analytics`
--
ALTER TABLE `store_analytics`
  ADD CONSTRAINT `store_analytics_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_app`
--
ALTER TABLE `store_app`
  ADD CONSTRAINT `store_app_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_data`
--
ALTER TABLE `store_data`
  ADD CONSTRAINT `store_data_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `store_data_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_domain`
--
ALTER TABLE `store_domain`
  ADD CONSTRAINT `store_domain_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `store_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_file`
--
ALTER TABLE `store_file`
  ADD CONSTRAINT `store_files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_plan`
--
ALTER TABLE `store_plan`
  ADD CONSTRAINT `store_plan_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `store_plan_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_timeline`
--
ALTER TABLE `store_timeline`
  ADD CONSTRAINT `store_timeline_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `store_user`
--
ALTER TABLE `store_user`
  ADD CONSTRAINT `store_user_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `store_user_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `store_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
  ADD CONSTRAINT `terms_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `newtransactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD CONSTRAINT `userdetail_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userdetail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `useremail`
--
ALTER TABLE `useremail`
  ADD CONSTRAINT `useremail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_android`
--
ALTER TABLE `user_android`
  ADD CONSTRAINT `user_android_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_telegram`
--
ALTER TABLE `user_telegram`
  ADD CONSTRAINT `user_tg_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_agents` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_urls` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_urls_referer` FOREIGN KEY (`url_idreferer`) REFERENCES `urls` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
