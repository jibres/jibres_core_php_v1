-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2014 at 08:28 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jibres`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account_title` varchar(50) NOT NULL,
  `account_slug` varchar(50) NOT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `account_branch` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_card` varchar(30) DEFAULT NULL,
  `account_primarybalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `account_desc` varchar(200) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`account_slug`),
  UNIQUE KEY `cardnumber_unique` (`account_card`),
  UNIQUE KEY `accountnumber_unique` (`account_number`),
  KEY `bank_id` (`bank_id`),
  KEY `accounts_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_title`, `account_slug`, `bank_id`, `account_branch`, `account_number`, `account_card`, `account_primarybalance`, `account_desc`, `user_id`, `date_modified`) VALUES
(10, 'test2', 'test2', 1, 'test', '123', '456', '0.0000', NULL, 15, '2014-11-07 22:52:43'),
(22, 'aaaa', 'sss', 50, 'www', NULL, NULL, '12.0000', 'asda', 16, '2014-11-10 18:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE IF NOT EXISTS `addons` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(50) NOT NULL,
  `addon_slug` varchar(50) NOT NULL,
  `addon_desc` varchar(999) DEFAULT NULL,
  `addon_status` enum('active','deactive','expire','going_to_expire') NOT NULL DEFAULT 'deactive',
  `addon_expire` datetime DEFAULT NULL,
  `addon_installdate` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`addon_slug`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attachment_title` varchar(100) DEFAULT NULL,
  `attachment_model` enum('product_category','product','admin','bank_logo') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `attachment_addr` varchar(100) NOT NULL,
  `attachment_name` varchar(50) NOT NULL,
  `attachment_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `attachment_size` float(12,0) NOT NULL,
  `attachment_desc` varchar(200) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name+type_unique` (`attachment_name`,`attachment_type`),
  KEY `attachments_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `bank_title` varchar(50) NOT NULL,
  `bank_slug` varchar(50) NOT NULL,
  `bank_website` varchar(50) DEFAULT NULL,
  `bank_active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`bank_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_title`, `bank_slug`, `bank_website`, `bank_active`, `date_modified`) VALUES
(1, 'پارسیان', 'parsian', '', 'yes', '2014-11-07 19:03:40'),
(2, 'ملی', 'melli', NULL, 'yes', '2014-11-07 17:37:14'),
(3, 'ملت', 'mellat', NULL, 'yes', '0000-00-00 00:00:00'),
(4, 'پاسارگاد', 'pasargad', NULL, 'yes', '0000-00-00 00:00:00'),
(5, 'تجارت', 'tejarat', NULL, 'yes', '0000-00-00 00:00:00'),
(6, 'انصار', 'ansar', NULL, 'yes', '0000-00-00 00:00:00'),
(7, 'آینده', 'ayandeh', NULL, 'yes', '0000-00-00 00:00:00'),
(8, 'صادرات', 'saderat', NULL, 'yes', '0000-00-00 00:00:00'),
(9, 'سینا', 'sina', NULL, 'yes', '0000-00-00 00:00:00'),
(10, 'اقتصاد نوین', 'eghtesad', NULL, 'yes', '0000-00-00 00:00:00'),
(50, 'test', 'tt', '3', 'yes', '0000-00-00 00:00:00'),
(55, 'test2', 't2', 'www', 'yes', '0000-00-00 00:00:00'),
(56, 'test312', 't3', 'wwwwwwwq', 'no', '2014-11-10 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE IF NOT EXISTS `cheques` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cheque_number` varchar(20) DEFAULT NULL,
  `cheque_date` datetime DEFAULT NULL,
  `cheque_price` decimal(13,4) DEFAULT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `cheque_holder` varchar(100) DEFAULT NULL,
  `cheque_desc` varchar(200) DEFAULT NULL,
  `cheque_status` enum('pass','back_recovery','back_fail','lost','block','delete','inprogress') DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id+bankid_unique` (`id`,`bank_id`) USING BTREE,
  KEY `bank_id` (`bank_id`),
  KEY `cheques_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Triggers `cheques`
--
DROP TRIGGER IF EXISTS `cheques_AU_outline_copy`;
DELIMITER //
CREATE TRIGGER `cheques_AU_outline_copy` BEFORE UPDATE ON `cheques`
 FOR EACH ROW IF coalesce(OLD.cheque_date , '') <> coalesce(NEW.cheque_date , '') or
    coalesce(OLD.cheque_price , '') <> coalesce(NEW.cheque_price , '') or
    coalesce(OLD.cheque_status , '') <> coalesce(NEW.cheque_status , '')
THEN

  Update receipts 
    SET receipt_chequedate = NEW.cheque_date, receipt_price = NEW.cheque_price, receipt_chequestatus = NEW.cheque_status
    WHERE cheque_id = NEW.id;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` smallint(5) unsigned DEFAULT NULL COMMENT 'if comment for post',
  `product_id` smallint(5) unsigned DEFAULT NULL COMMENT 'if comment for product',
  `comment_author` varchar(50) DEFAULT NULL,
  `comment_email` varchar(100) DEFAULT NULL,
  `comment_url` varchar(100) DEFAULT NULL,
  `comment_content` varchar(999) NOT NULL DEFAULT '',
  `comment_status` enum('approved','unapproved','spam','deleted') NOT NULL DEFAULT 'unapproved',
  `comment_parent` int(10) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `Visitor_id` int(10) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comments_visitors_id` (`Visitor_id`),
  KEY `comments_posts_id` (`post_id`) USING BTREE,
  KEY `comments_users_id` (`user_id`) USING BTREE,
  KEY `comments_products_id` (`product_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `costcats`
--

CREATE TABLE IF NOT EXISTS `costcats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `costcat_title` varchar(50) NOT NULL,
  `costcat_slug` varchar(50) NOT NULL,
  `costcat_desc` varchar(200) DEFAULT NULL,
  `costcat_father` smallint(5) DEFAULT NULL,
  `costcat_row` smallint(5) DEFAULT NULL,
  `costcat_type` enum('income','outcome') DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`costcat_slug`),
  KEY `type` (`costcat_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `costcats`
--

INSERT INTO `costcats` (`id`, `costcat_title`, `costcat_slug`, `costcat_desc`, `costcat_father`, `costcat_row`, `costcat_type`, `date_modified`) VALUES
(3, 'test', 'tt', 'eee', NULL, NULL, 'outcome', '0000-00-00 00:00:00'),
(4, 'test2', 'tt2', 'tt2', NULL, NULL, 'income', '0000-00-00 00:00:00'),
(5, 'test3', 't3', 'tt3', 3, 4, 'income', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cost_title` varchar(50) NOT NULL,
  `cost_price` decimal(13,4) NOT NULL,
  `costcat_id` smallint(5) unsigned NOT NULL,
  `account_id` smallint(5) unsigned NOT NULL,
  `cost_date` datetime NOT NULL,
  `cost_desc` varchar(200) DEFAULT NULL,
  `cost_type` enum('income','outcome') NOT NULL DEFAULT 'outcome',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type_index` (`cost_type`) USING BTREE,
  KEY `costs_costcats_id` (`costcat_id`) USING BTREE,
  KEY `costs_accounts_id` (`account_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `errorlogs`
--

CREATE TABLE IF NOT EXISTS `errorlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `errorlog_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `errorlogs_users_id` (`user_id`) USING BTREE,
  KEY `errorlogs_errors_id` (`errorlog_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` smallint(5) unsigned NOT NULL,
  `error_title` varchar(100) NOT NULL,
  `error_solution` varchar(999) DEFAULT NULL,
  `error_priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priotity_index` (`error_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE IF NOT EXISTS `funds` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `fund_title` varchar(100) NOT NULL,
  `fund_slug` varchar(100) NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `fund_initialbalance` decimal(14,4) DEFAULT NULL,
  `fund_desc` varchar(200) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`fund_slug`),
  KEY `funds_locations_id` (`location_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fund_title`, `fund_slug`, `location_id`, `fund_initialbalance`, `fund_desc`, `date_modified`) VALUES
(2, 'Main', 'main', 1, NULL, NULL, '0000-00-00 00:00:00');

--
-- Triggers `funds`
--
DROP TRIGGER IF EXISTS `funds_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `funds_BD_inline_block` BEFORE DELETE ON `funds`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `location_title` varchar(100) NOT NULL,
  `location_slug` varchar(100) NOT NULL,
  `location_desc` varchar(200) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`location_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_title`, `location_slug`, `location_desc`, `date_modified`) VALUES
(1, 'Main Location', 'main', NULL, '2014-11-07 18:21:17'),
(2, 'test', 't', NULL, '0000-00-00 00:00:00');

--
-- Triggers `locations`
--
DROP TRIGGER IF EXISTS `locations_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `locations_BD_inline_block` BEFORE DELETE ON `locations`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_sender` smallint(5) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `notification_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `notification_content` varchar(200) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `notification_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `notification_status` enum('read','unread') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'unread',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status_index` (`notification_status`),
  KEY `notifications_users_idsender` (`user_id_sender`) USING BTREE,
  KEY `notifications_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `option_cat` varchar(50) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_value` varchar(200) DEFAULT NULL,
  `option_extra` varchar(400) DEFAULT NULL,
  `option_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat+name+value` (`option_cat`,`option_name`,`option_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_cat`, `option_name`, `option_value`, `option_extra`, `option_status`, `date_modified`) VALUES
(1, 'global', 'language', 'fa', NULL, 'active', '2014-05-01 08:18:41'),
(2, 'global', 'language', 'en', NULL, 'active', '2014-05-01 08:18:42'),
(3, 'global', 'title', 'Jibres', NULL, 'active', '2014-11-07 17:29:37'),
(4, 'global', 'desc', 'Jibres for all', NULL, 'active', '2014-11-07 17:29:46'),
(5, 'global', 'keyword', 'Jibres, store, online store', NULL, 'active', '2014-11-07 17:30:07'),
(6, 'global', 'url', 'http://jibres.ir', NULL, 'active', '2014-11-07 17:30:18'),
(7, 'global', 'email', 'info@jibres.ir', NULL, 'active', '2014-11-07 17:30:22'),
(8, 'global', 'auto_mail', 'no-reply@jibres.ir', NULL, 'active', '2014-11-07 17:30:27'),
(9, 'users', 'user_degree', 'under diploma', NULL, 'deactive', '0000-00-00 00:00:00'),
(10, 'users', 'user_degree', 'diploma', NULL, 'deactive', '0000-00-00 00:00:00'),
(11, 'users', 'user_degree', '2-year collage', NULL, 'deactive', '0000-00-00 00:00:00'),
(12, 'users', 'user_degree', 'bachelor', NULL, 'deactive', '0000-00-00 00:00:00'),
(13, 'users', 'user_degree', 'master', NULL, 'deactive', '0000-00-00 00:00:00'),
(14, 'users', 'user_degree', 'doctorate', NULL, 'deactive', '0000-00-00 00:00:00'),
(15, 'users', 'user_degree', 'religious', NULL, 'deactive', '0000-00-00 00:00:00'),
(16, 'users', 'user_activity', 'employee', NULL, 'deactive', '0000-00-00 00:00:00'),
(17, 'users', 'user_activity', 'housekeeper ', NULL, 'deactive', '0000-00-00 00:00:00'),
(18, 'users', 'user_activity', 'free lance', NULL, 'deactive', '0000-00-00 00:00:00'),
(19, 'users', 'user_activity', 'retired', NULL, 'deactive', '0000-00-00 00:00:00'),
(20, 'users', 'user_activity', 'student', NULL, 'active', '0000-00-00 00:00:00'),
(21, 'users', 'user_activity', 'unemployed', NULL, 'active', '0000-00-00 00:00:00'),
(22, 'users', 'user_activity', 'seminary student', NULL, 'active', '0000-00-00 00:00:00'),
(23, 'permissions', 'permission_name', 'admin', NULL, 'active', '2014-11-07 17:30:55'),
(24, 'permissions', 'permission_name', 'reseller', NULL, 'active', '2014-11-07 17:30:56'),
(26, 'ships', 'post', '1', NULL, 'active', '2014-11-07 17:30:56'),
(27, 'ships', 'tipax', '2', NULL, 'active', '2014-11-07 17:30:57'),
(28, 'units', 'money_unit', 'toman', NULL, 'active', '2014-11-07 17:31:08'),
(29, 'units', 'product_unit', 'adad', NULL, 'active', '2014-11-07 17:31:29'),
(30, 'permissions', 'permission_name', 'viewer', NULL, 'active', '2014-05-17 21:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `permission_title` varchar(50) NOT NULL,
  `Permission_module` varchar(50) NOT NULL,
  `permission_view` enum('yes','no') NOT NULL DEFAULT 'yes',
  `permission_add` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name+module_unique` (`permission_title`,`Permission_module`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_title`, `Permission_module`, `permission_view`, `permission_add`, `permission_edit`, `permission_delete`, `permission_status`, `date_modified`) VALUES
(1, 'admin', 'banks', 'yes', 'yes', 'yes', 'yes', 'active', '2014-11-08 14:08:16'),
(2, 'reseller', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 'admin2', '', 'yes', 'no', 'no', 'no', 'active', '2014-11-08 09:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `postmetas`
--

CREATE TABLE IF NOT EXISTS `postmetas` (
  `id` smallint(5) NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `postmeta_name` varchar(100) NOT NULL,
  `postmeta_value` varchar(999) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `postmeta_posts_id` (`post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_language` char(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `post_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `post_cat` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `post_slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `post_content` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `post_type` enum('post','page') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'post',
  `post_status` enum('publish','draft','schedule','deleted') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'draft',
  `user_id` smallint(5) unsigned NOT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `post_publishdate` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug+catslug_unique` (`post_cat`,`post_slug`),
  KEY `posts_users_id` (`user_id`) USING BTREE,
  KEY `posts_attachments_id` (`attachment_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `productcats`
--

CREATE TABLE IF NOT EXISTS `productcats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `productcat_title` varchar(50) NOT NULL,
  `productcat_slug` varchar(50) NOT NULL,
  `productcat_desc` varchar(200) DEFAULT NULL,
  `productcat_father` smallint(5) unsigned DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `productcat_row` smallint(5) unsigned DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`productcat_slug`) USING BTREE,
  KEY `productcats_attachments_id` (`attachment_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `productcats`
--

INSERT INTO `productcats` (`id`, `productcat_title`, `productcat_slug`, `productcat_desc`, `productcat_father`, `attachment_id`, `productcat_row`, `date_modified`) VALUES
(1, 'general', 'general', NULL, NULL, NULL, 0, '2014-11-07 18:11:58');

--
-- Triggers `productcats`
--
DROP TRIGGER IF EXISTS `productcats_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `productcats_BD_inline_block` BEFORE DELETE ON `productcats`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `productmetas`
--

CREATE TABLE IF NOT EXISTS `productmetas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_cat` varchar(50) NOT NULL,
  `productmeta_name` varchar(100) NOT NULL,
  `productmeta_value` varchar(999) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product+cat+name_unique` (`product_id`,`productmeta_cat`,`productmeta_name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `productmetas`
--

INSERT INTO `productmetas` (`id`, `product_id`, `productmeta_cat`, `productmeta_name`, `productmeta_value`, `date_modified`) VALUES
(21, 1, 'price_white', 'product_price', '600', '2014-11-07 16:49:50'),
(22, 1, 'price_white', 'product_buy_price', '5000', '2014-11-07 16:49:51'),
(39, 1, 'price1', 'product_vat', '11', '2014-11-07 16:33:34'),
(73, 1, 'price1', 'product_discount', '20', '2014-11-07 16:49:52');

--
-- Triggers `productmetas`
--
DROP TRIGGER IF EXISTS `ProductMeta_AI_outline_copy`;
DELIMITER //
CREATE TRIGGER `ProductMeta_AI_outline_copy` AFTER INSERT ON `productmetas`
 FOR EACH ROW IF New.productmeta_cat like 'price%'
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_name = "product_buyprice" or
      New.productmeta_name = "product_price"         or
      New.productmeta_name = "product_discount"  or
      New.productmeta_name = "product_vat"
  THEN
    # if our valid price data inserted

    IF ( Select count(*) from productprices
      WHERE (product_id = NEW.product_id and productprice_cat = New.productmeta_cat) and (TIMESTAMPDIFF(MINUTE, productprice_startdate, NOW() ) < 3) ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE productprices SET productprice_enddate = now()
        WHERE product_id = NEW.product_id and productprice_cat = New.productmeta_cat and (productprice_enddate is null);

      INSERT INTO productprices ( product_id, productmeta_id, productprice_cat, productprice_startdate)
        VALUES(NEW.product_id, NEW.id ,NEW.productmeta_cat, NOW());

    End if;
    # now record is exit this is the time of update price_archive table with valid data


    IF New.productmeta_name = "product_buyprice"
    THEN
      UPDATE productprices SET productprice_buyprice = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_price"
    THEN
      UPDATE productprices SET productprice_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_discount"
    THEN
      UPDATE productprices SET productprice_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_vat"
    THEN
      UPDATE productprices SET productprice_vat = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

  End if;
End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `ProductMeta_AU_outline_copy2`;
DELIMITER //
CREATE TRIGGER `ProductMeta_AU_outline_copy2` AFTER UPDATE ON `productmetas`
 FOR EACH ROW IF New.productmeta_cat like 'price%'
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_name = "product_buyprice" or
      New.productmeta_name = "product_price"         or
      New.productmeta_name = "product_discount"  or
      New.productmeta_name = "product_vat"
  THEN
    # if our valid price data inserted

    IF ( Select count(*) from productprices
      WHERE (product_id = NEW.product_id and productprice_cat = New.productmeta_cat) and (TIMESTAMPDIFF(MINUTE, productprice_startdate, NOW() ) < 3) ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE productprices SET productprice_enddate = now()
        WHERE product_id = NEW.product_id and productprice_cat = New.productmeta_cat and (productprice_enddate is null);

      INSERT INTO productprices ( product_id, productmeta_id, productprice_cat, productprice_startdate)
        VALUES(NEW.product_id, NEW.id ,NEW.productmeta_cat, NOW());

    End if;
    # now record is exit this is the time of update price_archive table with valid data


    IF New.productmeta_name = "product_buyprice"
    THEN
      UPDATE productprices SET productprice_buyprice = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_price"
    THEN
      UPDATE productprices SET productprice_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_discount"
    THEN
      UPDATE productprices SET productprice_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_vat"
    THEN
      UPDATE productprices SET productprice_vat = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

  End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `productprices`
--

CREATE TABLE IF NOT EXISTS `productprices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_id` int(10) unsigned DEFAULT NULL,
  `productprice_cat` varchar(50) DEFAULT NULL,
  `productprice_startdate` datetime NOT NULL,
  `productprice_enddate` datetime DEFAULT NULL,
  `productprice_buyprice` decimal(13,4) DEFAULT NULL,
  `productprice_price` decimal(13,4) DEFAULT NULL,
  `productprice_discount` decimal(13,4) DEFAULT NULL,
  `productprice_vat` decimal(6,4) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `startdate` (`productprice_startdate`),
  KEY `enddate` (`productprice_enddate`),
  KEY `productprices_products_id` (`product_id`) USING BTREE,
  KEY `productprices_productmetas_id` (`productmeta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `product_title` varchar(100) NOT NULL,
  `product_slug` varchar(50) NOT NULL,
  `productcat_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `product_barcode` varchar(20) DEFAULT NULL,
  `product_barcode2` varchar(20) DEFAULT NULL,
  `product_buyprice` decimal(13,4) DEFAULT NULL,
  `product_price` decimal(13,4) NOT NULL,
  `product_discount` decimal(13,4) DEFAULT NULL,
  `product_vat` decimal(6,4) DEFAULT NULL,
  `product_initialbalance` int(10) DEFAULT '0',
  `product_mininventory` int(10) DEFAULT NULL,
  `product_status` enum('unset','available','soon','discontinued','unavailable') DEFAULT 'unset',
  `product_sold` int(10) DEFAULT '0',
  `product_stock` int(10) DEFAULT '0',
  `product_carton` int(10) DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `product_service` enum('yes','no') NOT NULL DEFAULT 'no',
  `product_sellin` enum('store','online','both') NOT NULL DEFAULT 'both',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`product_slug`) USING BTREE,
  UNIQUE KEY `barcode_unique` (`product_barcode`) USING BTREE,
  UNIQUE KEY `barcode2_unique` (`product_barcode2`) USING BTREE,
  KEY `products_attachments_id` (`attachment_id`) USING BTREE,
  KEY `products_productcats_id` (`productcat_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_slug`, `productcat_id`, `product_barcode`, `product_barcode2`, `product_buyprice`, `product_price`, `product_discount`, `product_vat`, `product_initialbalance`, `product_mininventory`, `product_status`, `product_sold`, `product_stock`, `product_carton`, `attachment_id`, `product_service`, `product_sellin`, `date_modified`) VALUES
(1, 'aa', 'aa', 1, NULL, NULL, '890.0000', '960.0000', '10.0000', '2.0000', 0, NULL, 'unset', 5, NULL, NULL, NULL, 'yes', 'both', '2014-11-07 14:42:53'),
(2, 'bb', 'bb', 1, NULL, NULL, NULL, '400.0000', '0.0000', NULL, 0, NULL, 'unset', 0, 20, NULL, NULL, 'yes', 'both', '2014-11-07 14:43:31'),
(3, 'cc', 'cc', 1, NULL, NULL, NULL, '0.0000', '0.0000', '1.0000', 0, NULL, 'unset', 90, 40, NULL, NULL, 'yes', 'both', '2014-06-12 08:56:25'),
(4, 'dd', 'dd', 1, NULL, NULL, '90.0000', '200.0000', '10.0000', NULL, 0, NULL, 'unset', 8, 42, NULL, NULL, 'yes', 'both', '2014-05-30 22:01:45'),
(5, 'ee', 'ee', 1, NULL, NULL, '100.0000', '120.0000', '5.0000', NULL, 0, NULL, 'unset', 0, 50, NULL, NULL, 'yes', 'both', '2014-05-30 21:42:55');

--
-- Triggers `products`
--
DROP TRIGGER IF EXISTS `products_AI_outline_copy`;
DELIMITER //
CREATE TRIGGER `products_AI_outline_copy` AFTER INSERT ON `products`
 FOR EACH ROW INSERT INTO productprices
    (product_id, productprice_startdate, productprice_buyprice, productprice_price,  productprice_discount, productprice_vat) 
    
    VALUES(NEW.id,  NOW(), NEW.product_buyprice, new.product_price, new.product_discount, new.product_vat)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `products_AU_copy2`;
DELIMITER //
CREATE TRIGGER `products_AU_copy2` AFTER UPDATE ON `products`
 FOR EACH ROW IF coalesce(OLD.product_buyprice , '')   <> coalesce(NEW.product_buyprice , '')   or
    coalesce(OLD.product_price , '')          <> coalesce(NEW.product_price , '')         or
    coalesce(OLD.product_discount , '')   <> coalesce(NEW.product_discount , '')   or
    coalesce(OLD.product_vat , '')             <> coalesce(NEW.product_vat , '')

  Then
    IF
      (Select count(*) from productprices 
        WHERE (product_id = NEW.id and productmeta_id is null ) and (TIMESTAMPDIFF(MINUTE, productprice_startdate, NOW() ) < 3)
        ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE productprices SET productprice_enddate = now()
        WHERE product_id = NEW.id 
          and productmeta_id is null
          and productprice_enddate is null;

      INSERT INTO productprices (product_id, productprice_startdate, productprice_buyprice, productprice_price,  productprice_discount, productprice_vat) 
      VALUES(NEW.id,  NOW(), NEW.product_buyprice, new.product_price, new.product_discount, new.product_vat);

    ELSE

      UPDATE productprices SET 
          productprice_buyprice   = NEW.product_buyprice,
          productprice_price          = new.product_price,
          productprice_discount   = new.product_discount,
          productprice_vat             = new.product_vat
        WHERE  product_id = NEW.id and productmeta_id is null and productprice_enddate is null;

  End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_code` varchar(30) DEFAULT NULL,
  `receipt_price` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `cheque_id` smallint(5) unsigned DEFAULT NULL,
  `receipt_chequedate` datetime DEFAULT NULL,
  `receipt_chequestatus` enum('pass','back_recovery','back_fail','lost','block','delete','inprogress') DEFAULT NULL,
  `receipt_desc` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `fund_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipts_cheques_id` (`cheque_id`) USING BTREE,
  KEY `receipts_transactions_id` (`transaction_id`) USING BTREE,
  KEY `receipts_funds_id` (`fund_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `term_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `term_slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `term_desc` varchar(200) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `term_father` smallint(5) unsigned DEFAULT NULL,
  `term_type` enum('cat','tag') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'cat',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`term_slug`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_name`, `term_slug`, `term_desc`, `term_father`, `term_type`, `date_modified`) VALUES
(1, 'news', 'news', '', NULL, 'cat', '0000-00-00 00:00:00'),
(5, 'test', 't', 't', 1, 'tag', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--

CREATE TABLE IF NOT EXISTS `termusages` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` smallint(5) unsigned NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `term+post_unique` (`term_id`,`post_id`) USING BTREE,
  KEY `termusages_posts_id` (`post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetails`
--

CREATE TABLE IF NOT EXISTS `transactiondetails` (
  `transactiondetail_row` smallint(5) unsigned DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` smallint(5) unsigned NOT NULL,
  `transactiondetail_quantity` int(10) NOT NULL DEFAULT '0',
  `transactiondetail_price` decimal(13,4) NOT NULL,
  `transactiondetail_discount` decimal(13,4) DEFAULT NULL,
  UNIQUE KEY `sale+product_unique` (`transaction_id`,`product_id`),
  KEY `transactiondetails_products_id` (`product_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactiondetails`
--

INSERT INTO `transactiondetails` (`transactiondetail_row`, `transaction_id`, `product_id`, `transactiondetail_quantity`, `transactiondetail_price`, `transactiondetail_discount`) VALUES
(NULL, 2, 1, 20, '0.0000', NULL),
(NULL, 2, 2, 20, '0.0000', NULL),
(NULL, 2, 5, 1, '50.0000', NULL),
(NULL, 3, 2, 1, '100.0000', NULL);

--
-- Triggers `transactiondetails`
--
DROP TRIGGER IF EXISTS `TransactionDetails_AI_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_AI_outline_update` AFTER INSERT ON `transactiondetails`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold , 0) + NEW.transactiondetail_quantity),
  product_stock = (coalesce(product_stock, 0) - NEW.transactiondetail_quantity)
Where
  id = NEW.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((transactiondetail_price-coalesce(transactiondetail_discount,0)) * transactiondetail_quantity) from transactiondetails where id = new.transaction_id)
Where
  id = new.transaction_id;


End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TransactionDetails_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_AU_outline_update` AFTER UPDATE ON `transactiondetails`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold , 0) + (NEW.transactiondetail_quantity - OLD.transactiondetail_quantity) ),
  product_stock = (coalesce(product_stock, 0) - (NEW.transactiondetail_quantity - OLD.transactiondetail_quantity) )
Where
  id = NEW.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((transactiondetail_price-coalesce(transactiondetail_discount,0)) * transactiondetail_quantity) from transactiondetails where id = new.transaction_id)
Where
  id = new.transaction_id;


End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TransactionDetails_BD_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_BD_outline_update` BEFORE DELETE ON `transactiondetails`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold, 0) -OLD.transactiondetail_quantity),
  product_stock = (coalesce(product_stock, 0) + OLD.transactiondetail_quantity)
Where
  id = OLD.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((transactiondetail_price-coalesce(transactiondetail_discount,0)) * transactiondetail_quantity) from transactiondetails where id = OLD.transaction_id)
Where
  id = OLD.transaction_id;


End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` enum('sale','purchase','customer_to_store','store_to_company','anbargardani','install','repair','chqeue_back_fail') DEFAULT 'sale',
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `user_id_customer` smallint(5) unsigned DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `transaction_sum` decimal(13,4) DEFAULT NULL,
  `transaction_discount` decimal(13,4) DEFAULT NULL,
  `transaction_initialreceived` decimal(13,4) DEFAULT NULL,
  `transaction_received` decimal(13,4) DEFAULT NULL,
  `transaction_remained` decimal(13,4) DEFAULT NULL,
  `transaction_pre` enum('yes','no') DEFAULT NULL,
  `transaction_desc` varchar(200) DEFAULT NULL,
  `transaction_transport` decimal(13,4) DEFAULT NULL,
  `transaction_vat` enum('yes','yes_nocalc','no') DEFAULT NULL COMMENT 'in percent',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transactions_users_id` (`user_id`) USING BTREE,
  KEY `transactions_users_idcustomer` (`user_id_customer`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `user_id`, `user_id_customer`, `transaction_date`, `transaction_sum`, `transaction_discount`, `transaction_initialreceived`, `transaction_received`, `transaction_remained`, `transaction_pre`, `transaction_desc`, `transaction_transport`, `transaction_vat`, `date_modified`) VALUES
(2, 'sale', 15, 15, NULL, '50.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-30 21:42:55'),
(3, 'sale', 15, 16, NULL, '240.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-30 21:41:20'),
(5, 'sale', 15, 14, NULL, '10000.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE IF NOT EXISTS `userlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userlog_title` varchar(50) DEFAULT NULL,
  `userlog_desc` varchar(999) DEFAULT NULL,
  `userlog_priority` enum('high','medium','low') NOT NULL DEFAULT 'medium',
  `userlog_type` enum('forget_password') DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priority_index` (`userlog_priority`),
  KEY `type_index` (`userlog_type`),
  KEY `userlogs_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usermeta`
--

CREATE TABLE IF NOT EXISTS `usermeta` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) unsigned DEFAULT NULL,
  `usermeta_cat` varchar(50) DEFAULT NULL,
  `usermeta_name` varchar(100) DEFAULT NULL,
  `usermeta_value` varchar(999) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usermeta_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'use char(36) if i want use uuid',
  `user_type` enum('customer','supplier','employee') DEFAULT 'customer',
  `user_pass` char(32) NOT NULL COMMENT 'Password',
  `user_email` varchar(50) DEFAULT NULL,
  `user_gender` enum('male','female') DEFAULT NULL COMMENT 'Gender',
  `user_married` enum('single','married') DEFAULT NULL,
  `user_firstname` varchar(50) DEFAULT NULL COMMENT 'First Name',
  `user_lastname` varchar(50) DEFAULT NULL COMMENT 'Last Name',
  `user_nickname` varchar(50) DEFAULT NULL,
  `user_tel` varchar(15) DEFAULT NULL COMMENT 'Tel',
  `user_mobile` varchar(15) DEFAULT NULL COMMENT 'Mobile',
  `user_birthday` datetime DEFAULT NULL,
  `user_country` smallint(5) unsigned DEFAULT NULL,
  `user_state` smallint(5) unsigned DEFAULT NULL,
  `user_city` smallint(5) unsigned DEFAULT NULL,
  `user_address` varchar(200) DEFAULT NULL,
  `user_postcode` varchar(10) DEFAULT NULL,
  `user_newsletter` enum('yes','no') DEFAULT 'no',
  `user_refer` varchar(50) DEFAULT NULL COMMENT 'select from list like enum',
  `user_nationalcode` varchar(15) DEFAULT NULL,
  `user_website` varchar(100) DEFAULT NULL COMMENT 'Website',
  `user_status` enum('active','awaiting','deactive','removed') DEFAULT 'awaiting' COMMENT 'Status',
  `user_degree` varchar(50) DEFAULT NULL COMMENT 'Select from list',
  `user_activity` varchar(50) DEFAULT NULL COMMENT 'Select from list',
  `user_incomes` bigint(11) DEFAULT '0',
  `user_outcomes` bigint(11) DEFAULT '0',
  `user_credit` enum('yes','no') DEFAULT 'no',
  `user_question` varchar(100) DEFAULT NULL,
  `user_answer` varchar(100) DEFAULT NULL,
  `permission_id` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_uniques` (`user_email`) USING BTREE,
  UNIQUE KEY `mobile_unique` (`user_mobile`) USING BTREE,
  KEY `users_permissions_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_pass`, `user_email`, `user_gender`, `user_married`, `user_firstname`, `user_lastname`, `user_nickname`, `user_tel`, `user_mobile`, `user_birthday`, `user_country`, `user_state`, `user_city`, `user_address`, `user_postcode`, `user_newsletter`, `user_refer`, `user_nationalcode`, `user_website`, `user_status`, `user_degree`, `user_activity`, `user_incomes`, `user_outcomes`, `user_credit`, `user_question`, `user_answer`, `permission_id`, `date_modified`) VALUES
(14, 'customer', '1', 'eee2', 'male', NULL, NULL, NULL, 'Test1', NULL, '9112223333', NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'active', NULL, NULL, 9010, 0, 'no', NULL, NULL, 1, '2014-11-08 09:34:15'),
(15, 'supplier', '1', NULL, NULL, NULL, 'Test', NULL, 'Test2', NULL, '9123334444', NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, 9032, 0, 'no', NULL, NULL, 1, '2014-11-08 09:34:17'),
(16, 'employee', '1', 'aaa2', NULL, NULL, NULL, 'Test last', 'Test3', NULL, '9134445555', NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'active', NULL, NULL, 0, 0, 'no', NULL, NULL, 1, '2014-11-08 09:34:19'),
(28, 'customer', '', 'test&commat;test&period;com', NULL, NULL, 'Javad', 'Evazzadeh', 'Javad', '123', '09357269759', NULL, 0, 0, 0, 'test', '12345', 'no', NULL, '2190053994', 'evazzadeh&period;com', 'active', NULL, NULL, 0, 0, 'yes', NULL, NULL, NULL, '0000-00-00 00:00:00');

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `Users_AI_ouline_verification`;
DELIMITER //
CREATE TRIGGER `Users_AI_ouline_verification` AFTER INSERT ON `users`
 FOR EACH ROW insert into verifications 
(verification_type, verification_email, verification_code, user_id)
VALUES(	
				"register_by_email",
				new.user_email,
				md5(New.id & New.date_modified),
				New.id
 )
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `verification_type` enum('registerbyemail','registerbymobile','forget','changeemail','changemobile') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `verification_verified` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'no',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_unique` (`verification_code`),
  KEY `verifications_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `verification_type`, `verification_email`, `verification_code`, `user_id`, `verification_verified`, `date_modified`) VALUES
(13, 'forget', 'test&commat;test&period;com', 'cfcd208495d565ef66e7dff9f98764da', 28, 'no', '2014-11-10 19:13:12'),
(14, 'registerbymobile', 'test@aa.com', '432rfewfw432r', 28, 'no', '2014-11-10 19:25:52');

--
-- Triggers `verifications`
--
DROP TRIGGER IF EXISTS `verification_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `verification_AU_outline_update` AFTER UPDATE ON `verifications`
 FOR EACH ROW IF NEW.verification_verified <> OLD.verification_verified THEN
   if new.verification_verified = 'yes' then
       UPDATE users SET user_status = 'active' WHERE id = New.user_id;
   END IF;
END IF
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_ip` int(10) unsigned NOT NULL COMMENT 'use the INET_ATON() and INET_NTOA() functions to return the IP address from its numeric value, and vice versa.',
  `visitor_agent` varchar(255) DEFAULT NULL,
  `visitor_referrer` varchar(255) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_banks_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `accounts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cheques`
--
ALTER TABLE `cheques`
  ADD CONSTRAINT `cheques_banks_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `cheques_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_visitors_id` FOREIGN KEY (`Visitor_id`) REFERENCES `visitors` (`id`);

--
-- Constraints for table `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_accounts_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `costs_costcats_id` FOREIGN KEY (`costcat_id`) REFERENCES `costcats` (`id`);

--
-- Constraints for table `errorlogs`
--
ALTER TABLE `errorlogs`
  ADD CONSTRAINT `errorlogs_errors_id` FOREIGN KEY (`errorlog_id`) REFERENCES `errors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `errorlogs_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `funds`
--
ALTER TABLE `funds`
  ADD CONSTRAINT `funds_locations_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_users_idsender` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `postmetas`
--
ALTER TABLE `postmetas`
  ADD CONSTRAINT `postmeta_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `productcats`
--
ALTER TABLE `productcats`
  ADD CONSTRAINT `productcats_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `productmetas`
--
ALTER TABLE `productmetas`
  ADD CONSTRAINT `productmetas_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `productprices`
--
ALTER TABLE `productprices`
  ADD CONSTRAINT `productprices_productmetas_id` FOREIGN KEY (`productmeta_id`) REFERENCES `productmetas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productprices_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_productcats_id` FOREIGN KEY (`productcat_id`) REFERENCES `productcats` (`id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `receipts_cheques_id` FOREIGN KEY (`cheque_id`) REFERENCES `cheques` (`id`),
  ADD CONSTRAINT `receipts_funds_id` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`);

--
-- Constraints for table `termusages`
--
ALTER TABLE `termusages`
  ADD CONSTRAINT `termusages_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `termusages_terms_id` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactiondetails`
--
ALTER TABLE `transactiondetails`
  ADD CONSTRAINT `transactiondetails_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transactiondetails_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_users_idcustomer` FOREIGN KEY (`user_id_customer`) REFERENCES `users` (`id`);

--
-- Constraints for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD CONSTRAINT `userlogs_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `usermeta`
--
ALTER TABLE `usermeta`
  ADD CONSTRAINT `usermeta_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_permissions_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
