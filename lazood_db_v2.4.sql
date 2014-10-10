-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2014 at 03:36 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
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
  `account_branch_name` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_card_number` varchar(30) DEFAULT NULL,
  `account_primarybalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `account_desc` varchar(200) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`account_slug`),
  UNIQUE KEY `cardnumber_unique` (`account_card_number`),
  UNIQUE KEY `accountnumber_unique` (`account_number`),
  KEY `bank_id` (`bank_id`),
  KEY `accounts_users_userid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name+type_unique` (`attachment_name`,`attachment_type`),
  KEY `attachments_users_userid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`bank_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_title`, `bank_slug`, `bank_website`, `bank_active`, `date_created`, `date_modified`) VALUES
(1, '', 'پارسیان', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(2, '', 'ملی', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(3, '', 'ملت', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(4, '', 'پاسارگاد', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(5, '', 'تجارت', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(6, '', 'انصار', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(7, '', 'آینده', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(8, '', 'صادرات', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(9, '', 'سینا', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00'),
(10, '', 'اقتصاد نوین', NULL, 'yes', '2014-05-08 21:52:03', '0000-00-00 00:00:00');

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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chequeid+bankid_unique` (`id`,`bank_id`),
  KEY `bank_id` (`bank_id`),
  KEY `cheques_users_userid` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cheques`
--

INSERT INTO `cheques` (`id`, `cheque_number`, `cheque_date`, `cheque_price`, `bank_id`, `cheque_holder`, `cheque_desc`, `cheque_status`, `user_id`, `date_created`, `date_modified`) VALUES
(4, '1', '2014-05-16 22:41:56', '100.0000', 1, 'aa', 'desc', '', 15, '2014-05-28 18:30:49', '2014-05-29 18:12:03'),
(5, '2', NULL, '2000.0000', 1, NULL, NULL, NULL, 15, '2014-05-28 18:31:34', '0000-00-00 00:00:00');

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
    SET rd_cheque_date = NEW.cheque_date, rd_price = NEW.cheque_price, cheque_status = NEW.cheque_status
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
  `comment_author_email` varchar(100) DEFAULT NULL,
  `comment_author_url` varchar(100) DEFAULT NULL,
  `comment_author_ip` int(10) unsigned DEFAULT NULL COMMENT 'use the INET_ATON() and INET_NTOA() functions to return the IP address from its numeric value, and vice versa.',
  `comment_agent` varchar(255) DEFAULT NULL,
  `comment_content` varchar(999) NOT NULL DEFAULT '',
  `comment_status` enum('approved','unapproved','spam','deleted') NOT NULL DEFAULT 'unapproved',
  `comment_parent` int(10) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comments_posts_postid` (`post_id`),
  KEY `comments_users_userid` (`user_id`),
  KEY `comments_products_productid` (`product_id`),
  KEY `ip_index` (`comment_author_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cost_title` varchar(50) NOT NULL,
  `cost_price` decimal(13,4) NOT NULL,
  `cc_id` smallint(5) unsigned NOT NULL,
  `account_id` smallint(5) unsigned NOT NULL,
  `cost_date` datetime NOT NULL,
  `cost_desc` varchar(200) DEFAULT NULL,
  `cost_type` enum('income','outcome') NOT NULL DEFAULT 'outcome',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `costs_costcategories_ccid` (`cc_id`),
  KEY `costs_accounts_accountid` (`account_id`),
  KEY `type_index` (`cost_type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cost_categories`
--

CREATE TABLE IF NOT EXISTS `cost_categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cc_title` varchar(50) NOT NULL,
  `cc_slug` varchar(50) NOT NULL,
  `cc_desc` varchar(200) DEFAULT NULL,
  `cc_father` smallint(5) DEFAULT NULL,
  `cc_row` smallint(5) DEFAULT NULL,
  `cc_type` enum('income','outcome') DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`cc_slug`),
  KEY `type` (`cc_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cost_categories`
--

INSERT INTO `cost_categories` (`id`, `cc_title`, `cc_slug`, `cc_desc`, `cc_father`, `cc_row`, `cc_type`, `date_created`, `date_modified`) VALUES
(1, 'ماشین', 'car', 'هزینه های ماشین', NULL, NULL, NULL, '2014-06-12 11:39:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` smallint(5) unsigned NOT NULL,
  `ed_title` varchar(100) NOT NULL,
  `ed_solution` varchar(999) DEFAULT NULL,
  `ed_priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priotity_index` (`ed_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE IF NOT EXISTS `error_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `ed_id` smallint(5) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `errorlogs_users_userid` (`user_id`),
  KEY `errorlogs_errors_edid` (`ed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE IF NOT EXISTS `funds` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `fund_title` varchar(100) NOT NULL,
  `fund_slug` varchar(100) NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `fund_initial_balance` decimal(14,4) DEFAULT NULL,
  `fund_desc` varchar(200) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`fund_slug`),
  KEY `funds_locations_locationid` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fund_title`, `fund_slug`, `location_id`, `fund_initial_balance`, `fund_desc`, `date_created`, `date_modified`) VALUES
(2, 'Main', 'main', 1, NULL, NULL, '2014-05-26 14:20:44', '0000-00-00 00:00:00');

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
DROP TRIGGER IF EXISTS `funds_BI_inline_copy`;
DELIMITER //
CREATE TRIGGER `funds_BI_inline_copy` BEFORE INSERT ON `funds`
 FOR EACH ROW IF NEW.fund_slug ='' THEN
   if new.fund_title='' then
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'require';
   else
      set new.fund_slug = new.fund_title;
   End if;
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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`location_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_title`, `location_slug`, `location_desc`, `date_created`, `date_modified`) VALUES
(1, 'main', 'main', NULL, '2014-05-26 14:18:25', '0000-00-00 00:00:00');

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
DROP TRIGGER IF EXISTS `locations_BI_inline_copy`;
DELIMITER //
CREATE TRIGGER `locations_BI_inline_copy` BEFORE INSERT ON `locations`
 FOR EACH ROW IF NEW.location_slug ='' THEN
   if new.location_title='' then
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'require';
   else
      set new.location_slug = new.location_title;
   End if;
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
  `user_id_reciever` smallint(5) unsigned NOT NULL,
  `notification_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `notification_content` varchar(200) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `notification_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `notification_status` enum('read','unread') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'unread',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `notifications_users_useridsender` (`user_id_sender`),
  KEY `notifications_users_useridreciever` (`user_id_reciever`),
  KEY `status_index` (`notification_status`)
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
  `option_value_extra` varchar(255) DEFAULT NULL,
  `option_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat+name+value` (`option_cat`,`option_name`,`option_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_cat`, `option_name`, `option_value`, `option_value_extra`, `option_status`, `date_created`, `date_modified`) VALUES
(1, 'global', 'language', 'fa', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:41'),
(2, 'global', 'language', 'en', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:42'),
(3, 'global', 'title', 'سامانه فروش آنلاین', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:42'),
(4, 'global', 'desc', 'این یک سامانه همه کاره برای فروشگاه شماست', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:42'),
(5, 'global', 'keyword', 'سامانه , فروشگاه , مدیریت فروش , صدور فاکتور', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:43'),
(6, 'global', 'url', 'http://supersaeed.ir', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:43'),
(7, 'global', 'email', 'info@supersaeed.ir', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:44'),
(8, 'global', 'auto_mail', 'no-reply@supersaeed.ir', NULL, 'active', '2014-05-01 08:08:13', '2014-05-01 08:18:44'),
(9, 'users', 'user_degree', 'under diploma', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(10, 'users', 'user_degree', 'diploma', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(11, 'users', 'user_degree', '2-year collage', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(12, 'users', 'user_degree', 'bachelor', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(13, 'users', 'user_degree', 'master', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(14, 'users', 'user_degree', 'doctorate', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(15, 'users', 'user_degree', 'religious', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(16, 'users', 'user_activity', 'employee', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(17, 'users', 'user_activity', 'housekeeper ', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(18, 'users', 'user_activity', 'free lance', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(19, 'users', 'user_activity', 'retired', NULL, 'deactive', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(20, 'users', 'user_activity', 'student', NULL, 'active', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(21, 'users', 'user_activity', 'unemployed', NULL, 'active', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(22, 'users', 'user_activity', 'seminary student', NULL, 'active', '2014-05-01 08:08:13', '0000-00-00 00:00:00'),
(23, 'permissions', 'permission_name', 'admin', 'مدیریت سیستم', 'active', '2014-05-01 08:08:13', '2014-05-01 08:19:34'),
(24, 'permissions', 'permission_name', 'reseller', 'فروشنده', 'active', '2014-05-01 08:08:13', '2014-05-01 08:19:34'),
(26, 'ships', 'post', '1', 'پست پیشتاز', 'active', '2014-05-07 15:34:02', '2014-05-07 18:13:08'),
(27, 'ships', 'tipax', '2', 'تیپاکس', 'active', '2014-05-07 18:13:12', '2014-05-07 18:13:23'),
(28, 'units', 'money_unit', 'تومان', NULL, 'active', '2014-05-07 20:43:33', '2014-05-07 20:44:13'),
(29, 'units', 'product_unit', 'عدد', NULL, 'active', '2014-05-07 20:44:24', '0000-00-00 00:00:00'),
(30, 'permissions', 'permission_name', 'viewer', NULL, 'active', '2014-05-17 21:27:45', '2014-05-17 21:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(50) NOT NULL,
  `Permission_table` varchar(50) NOT NULL,
  `permission_view` enum('yes','no') NOT NULL DEFAULT 'yes',
  `permission_add` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name+table_unique` (`permission_name`,`Permission_table`) USING BTREE,
  KEY `permission_name` (`permission_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `Permission_table`, `permission_view`, `permission_add`, `permission_edit`, `permission_delete`, `permission_status`, `date_created`, `date_modified`) VALUES
(1, 'admin', 'a', '', '', '', '', '', '2014-05-07 09:23:27', '2014-05-07 09:26:38'),
(2, 'reseller', '', '', '', '', '', '', '2014-05-07 09:23:27', '0000-00-00 00:00:00'),
(4, 'admin', '', 'yes', 'yes', 'no', 'no', 'active', '2014-05-07 09:25:02', '2014-05-07 09:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_language` char(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `post_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `post_slug_cat` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `post_slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `post_content` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `post_type` enum('post','page') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'post',
  `post_status` enum('publish','draft','schedule','deleted') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'draft',
  `user_id` smallint(5) unsigned NOT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `post_publishdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug+catslug_unique` (`post_slug_cat`,`post_slug`),
  KEY `posts_users_userid` (`user_id`),
  KEY `posts_attachments_attachmentid` (`attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_meta`
--

CREATE TABLE IF NOT EXISTS `post_meta` (
  `id` smallint(5) NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `postmeta_name` varchar(100) NOT NULL,
  `postmeta_value` varchar(999) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `postmeta_posts_postid` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `product_title` varchar(100) NOT NULL,
  `product_slug` varchar(50) NOT NULL,
  `pcat_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `product_barcode` varchar(20) DEFAULT NULL,
  `product_barcode2` varchar(20) DEFAULT NULL,
  `product_buy_price` decimal(13,4) DEFAULT NULL,
  `product_price` decimal(13,4) NOT NULL,
  `product_discount` decimal(13,4) DEFAULT NULL,
  `product_vat` decimal(6,4) DEFAULT NULL,
  `product_initial_balance` int(10) DEFAULT '0',
  `product_min_inventory` int(10) DEFAULT NULL,
  `product_status` enum('unset','available','soon','discontinued','unavailable') DEFAULT 'unset',
  `product_sold` int(10) DEFAULT '0',
  `product_stock` int(10) DEFAULT '0',
  `product_carton` int(10) DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `product_service` enum('yes','no') NOT NULL DEFAULT 'no',
  `product_sellin` enum('store','online','both') NOT NULL DEFAULT 'both',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`product_slug`) USING BTREE,
  UNIQUE KEY `barcode_unique` (`product_barcode`) USING BTREE,
  UNIQUE KEY `barcode2_unique` (`product_barcode2`) USING BTREE,
  KEY `products_productcategories_pcatid` (`pcat_id`),
  KEY `products_attachments_attachmentid` (`attachment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_slug`, `pcat_id`, `product_barcode`, `product_barcode2`, `product_buy_price`, `product_price`, `product_discount`, `product_vat`, `product_initial_balance`, `product_min_inventory`, `product_status`, `product_sold`, `product_stock`, `product_carton`, `attachment_id`, `product_service`, `product_sellin`, `date_created`, `date_modified`) VALUES
(1, 'aa', 'aa', 1, NULL, NULL, NULL, '0.0000', '0.0000', NULL, 0, NULL, 'unset', 5, NULL, NULL, NULL, 'yes', 'both', '2014-05-17 09:10:27', '2014-05-31 10:51:19'),
(2, 'bb', 'bb', 1, NULL, NULL, NULL, '0.0000', '0.0000', NULL, 0, NULL, 'unset', 0, 20, NULL, NULL, 'yes', 'both', '2014-05-17 09:10:31', '2014-05-30 21:41:52'),
(3, 'cc', 'cc', 1, NULL, NULL, NULL, '0.0000', '0.0000', '1.0000', 0, NULL, 'unset', 90, 40, NULL, NULL, 'yes', 'both', '2014-05-17 09:10:32', '2014-06-12 08:56:25'),
(4, 'dd', 'dd', 1, NULL, NULL, '90.0000', '200.0000', '10.0000', NULL, 0, NULL, 'unset', 8, 42, NULL, NULL, 'yes', 'both', '2014-05-17 18:59:57', '2014-05-30 22:01:45'),
(5, 'ee', 'ee', 1, NULL, NULL, '100.0000', '120.0000', '5.0000', NULL, 0, NULL, 'unset', 0, 50, NULL, NULL, 'yes', 'both', '2014-05-17 19:01:04', '2014-05-30 21:42:55');

--
-- Triggers `products`
--
DROP TRIGGER IF EXISTS `products_AI_outline_copy`;
DELIMITER //
CREATE TRIGGER `products_AI_outline_copy` AFTER INSERT ON `products`
 FOR EACH ROW INSERT INTO product_prices
    (product_id, pa_startdate, pa_buy_price, pa_price,  pa_discount, pa_vat) 
    
    VALUES(NEW.id,  NOW(), NEW.product_buy_price, new.product_price, new.product_discount, new.product_vat)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `products_AU_copy2`;
DELIMITER //
CREATE TRIGGER `products_AU_copy2` AFTER UPDATE ON `products`
 FOR EACH ROW IF coalesce(OLD.product_buy_price , '') <> coalesce(NEW.product_buy_price , '') or
    coalesce(OLD.product_price , '')          <> coalesce(NEW.product_price , '')         or
    coalesce(OLD.product_discount , '')   <> coalesce(NEW.product_discount , '')   or
    coalesce(OLD.product_vat , '')             <> coalesce(NEW.product_vat , '')

  Then
    IF
      (Select count(*) from product_prices 
        WHERE (product_id = NEW.id and productmeta_cat is null ) and (TIMESTAMPDIFF(MINUTE, pa_startdate, NOW() ) < 3)
        ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE product_prices SET pa_enddate = now()
        WHERE  product_id = NEW.id 
          and productmeta_cat is null
          and pa_enddate is null;

      INSERT INTO product_prices  (product_id, pa_startdate, pa_buy_price, pa_price,  pa_discount, pa_vat) 
      VALUES(NEW.id,  NOW(), NEW.product_buy_price, new.product_price, new.product_discount, new.product_vat);

    ELSE

      UPDATE product_prices SET 
          pa_buy_price = NEW.product_buy_price,
          pa_price          = new.product_price,
          pa_discount   = new.product_discount,
          pa_vat             = new.product_vat
        WHERE  product_id = NEW.id and productmeta_cat is null and pa_enddate is null
        ORDER BY pa_id DESC LIMIT 1;

  End if;

End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `products_BI_inline_copy`;
DELIMITER //
CREATE TRIGGER `products_BI_inline_copy` BEFORE INSERT ON `products`
 FOR EACH ROW IF NEW.product_slug ='' THEN
   if new.product_title='' then
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'require';
   else
      set new.product_slug = new.product_title;
   End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pcat_title` varchar(50) NOT NULL,
  `pcat_slug` varchar(50) NOT NULL,
  `pcat_desc` varchar(200) DEFAULT NULL,
  `pcat_father` smallint(5) unsigned DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `pcat_row` smallint(5) unsigned NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`pcat_slug`) USING BTREE,
  KEY `productcategories_attachments_attachmentid` (`attachment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `pcat_title`, `pcat_slug`, `pcat_desc`, `pcat_father`, `attachment_id`, `pcat_row`, `date_created`, `date_modified`) VALUES
(1, 'عمومی', 'general', NULL, NULL, NULL, 0, '2014-05-07 11:02:09', '0000-00-00 00:00:00');

--
-- Triggers `product_categories`
--
DROP TRIGGER IF EXISTS `pcat_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `pcat_BD_inline_block` BEFORE DELETE ON `product_categories`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `pcat_BI_inline_copy`;
DELIMITER //
CREATE TRIGGER `pcat_BI_inline_copy` BEFORE INSERT ON `product_categories`
 FOR EACH ROW IF NEW.pcat_slug ='' THEN
   if new.pcat_title='' then
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'require';
   else
      set new.pcat_slug = new.pcat_title;
   End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_meta`
--

CREATE TABLE IF NOT EXISTS `product_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_cat` varchar(50) DEFAULT NULL,
  `productmeta_name` varchar(100) NOT NULL,
  `productmeta_value` varchar(999) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product+cat+name_unique` (`product_id`,`productmeta_cat`,`productmeta_name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `product_meta`
--

INSERT INTO `product_meta` (`id`, `product_id`, `productmeta_cat`, `productmeta_name`, `productmeta_value`, `date_created`, `date_modified`) VALUES
(13, 3, 'price2', 'product_buy_price', '200', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(17, 3, 'price2', 'product_discount', '600', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(18, 3, 'price2', 'product_price', '69', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(19, 3, 'price1', 'product_price', '500', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(20, 3, 'price1', 'product_buy_price', '20000', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(21, 2, 'price_white', 'product_price', '600', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(22, 2, 'price_white', 'product_buy_price', '5000', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(23, 1, 'price_black', 'product_discount', '999', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(24, 1, 'price_black', 'product_price', '11', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(25, 3, 'price_aa', 'product_price', '3300', '2014-05-17 23:26:04', '0000-00-00 00:00:00'),
(26, 3, 'price_aa', 'product_buy_price', '44', '2014-05-17 23:26:04', '0000-00-00 00:00:00');

--
-- Triggers `product_meta`
--
DROP TRIGGER IF EXISTS `ProductMeta_BI_outline_copy`;
DELIMITER //
CREATE TRIGGER `ProductMeta_BI_outline_copy` BEFORE INSERT ON `product_meta`
 FOR EACH ROW IF New.productmeta_cat like 'price%' 
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_name = "product_buy_price" or
      New.productmeta_name = "product_price"         or
      New.productmeta_name = "product_discount"   
  THEN
    # if our valid price data inserted
    
    IF
      (Select count(*) from product_prices 
        WHERE (product_id = NEW.product_id and productmeta_cat = New.productmeta_cat) and (TIMESTAMPDIFF(MINUTE, pa_startdate, NOW() ) < 3)
        ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE product_prices SET pa_enddate = now()
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat and (pa_enddate is null);

      INSERT INTO product_prices ( product_id, productmeta_cat, pa_startdate)
        VALUES(NEW.product_id, NEW.productmeta_cat, NOW());

    End if;
    # now record is exit this is the time of update price_archive table with valid data


    IF New.productmeta_name = "product_buy_price"
    THEN
      UPDATE product_prices SET pa_buy_price = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat and pa_enddate is null
        ORDER BY pa_id DESC LIMIT 1;
    End if;

    IF New.productmeta_name = "product_price"
    THEN
      UPDATE product_prices SET pa_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat and pa_enddate is null
        ORDER BY pa_id DESC LIMIT 1;
    End if;

    IF New.productmeta_name = "product_discount"
    THEN
      UPDATE product_prices SET pa_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat and pa_enddate is null
        ORDER BY pa_id DESC LIMIT 1;
    End if;


  End if;
End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `ProductMeta_BU_outline_copy2`;
DELIMITER //
CREATE TRIGGER `ProductMeta_BU_outline_copy2` BEFORE UPDATE ON `product_meta`
 FOR EACH ROW IF New.productmeta_cat like 'price%' 
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_name = "product_buy_price" or
      New.productmeta_name = "product_price"         or
      New.productmeta_name = "product_discount"   
  THEN
    # if our valid price data inserted
    
    IF
      (Select count(*) from product_prices 
        WHERE (product_id = NEW.product_id and productmeta_cat = New.productmeta_cat) and (TIMESTAMPDIFF(MINUTE, pa_startdate, NOW() ) < 3)
        ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE product_prices SET pa_enddate = now()
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat and (pa_enddate is null);

      INSERT INTO product_prices ( product_id, productmeta_cat, pa_startdate)
        VALUES(NEW.product_id, NEW.productmeta_cat, NOW());

    End if;
    # now record is exit this is the time of update price_archive table with valid data


    IF New.productmeta_name = "product_buy_price"
    THEN
      UPDATE product_prices SET pa_buy_price = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat
        ORDER BY pa_id DESC LIMIT 1;
    End if;

    IF New.productmeta_name = "product_price"
    THEN
      UPDATE product_prices SET pa_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat
        ORDER BY pa_id DESC LIMIT 1;
    End if;

    IF New.productmeta_name = "product_discount"
    THEN
      UPDATE product_prices SET pa_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productmeta_cat = New.productmeta_cat
        ORDER BY pa_id DESC LIMIT 1;
    End if;


  End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE IF NOT EXISTS `product_prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` smallint(5) unsigned DEFAULT NULL,
  `productmeta_cat` varchar(50) DEFAULT NULL,
  `pa_startdate` datetime NOT NULL,
  `pa_enddate` datetime DEFAULT NULL,
  `pa_buy_price` decimal(13,4) DEFAULT NULL,
  `pa_price` decimal(13,4) DEFAULT NULL,
  `pa_discount` decimal(13,4) DEFAULT NULL,
  `pa_vat` decimal(6,4) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `productprices_products_productid` (`product_id`),
  KEY `startdate` (`pa_startdate`),
  KEY `enddate` (`pa_enddate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `productmeta_cat`, `pa_startdate`, `pa_enddate`, `pa_buy_price`, `pa_price`, `pa_discount`, `pa_vat`, `date_created`, `date_modified`) VALUES
(9, 3, 'price2', '2014-05-17 20:21:28', '2014-05-17 22:43:24', '77.0000', '66.0000', '88.0000', NULL, '2014-05-17 15:51:28', '2014-05-17 18:13:24'),
(10, 3, 'price1', '2014-05-17 20:25:19', NULL, '100.0000', '500.0000', NULL, NULL, '2014-05-17 15:55:19', '2014-05-17 17:11:54'),
(11, 2, 'price_white', '2014-05-17 21:42:17', '2014-05-17 22:43:57', '3.0000', '1.0000', NULL, NULL, '2014-05-17 17:12:17', '2014-05-17 18:13:57'),
(12, 1, 'price_black', '2014-05-17 21:43:31', NULL, NULL, '11.0000', '999.0000', NULL, '2014-05-17 17:13:31', '2014-05-17 17:13:58'),
(13, 3, 'price_aa', '2014-05-17 22:13:47', NULL, '44.0000', '3300.0000', NULL, NULL, '2014-05-17 17:43:47', '2014-05-17 17:44:47'),
(15, 3, 'price1', '2014-05-17 22:14:51', NULL, '20000.0000', NULL, NULL, NULL, '2014-05-17 17:44:51', '2014-05-17 17:44:57'),
(16, 3, 'price2', '2014-05-17 22:29:20', '2014-05-17 22:43:24', '999.0000', '69.0000', '99.0000', NULL, '2014-05-17 17:59:20', '2014-05-17 18:13:24'),
(22, 3, 'price2', '2014-05-17 22:43:24', '2014-05-17 23:28:33', NULL, NULL, '500.0000', NULL, '2014-05-17 18:13:24', '2014-05-17 18:58:33'),
(23, 2, 'price_white', '2014-05-17 22:43:57', '2014-05-17 22:59:00', '500.0000', '600.0000', NULL, NULL, '2014-05-17 18:13:57', '2014-05-17 18:29:00'),
(24, 2, 'price_white', '2014-05-17 22:59:00', '2014-05-17 23:28:59', '5000.0000', '600000.0000', NULL, NULL, '2014-05-17 18:29:00', '2014-05-17 18:58:59'),
(25, 2, 'price_white2', '2014-05-17 22:59:16', NULL, NULL, '600.0000', NULL, NULL, '2014-05-17 18:29:16', '2014-05-17 18:29:16'),
(26, 3, 'price2', '2014-05-17 23:28:33', NULL, '200.0000', NULL, '600.0000', NULL, '2014-05-17 18:58:33', '2014-05-17 18:58:49'),
(27, 2, 'price_white', '2014-05-17 23:28:59', NULL, NULL, '600.0000', NULL, NULL, '2014-05-17 18:58:59', '2014-05-17 18:58:59'),
(28, 4, NULL, '2014-05-17 23:29:57', '2014-05-17 23:36:34', '90.0000', '100.0000', '10.0000', NULL, '2014-05-17 18:59:57', '2014-05-17 19:06:34'),
(29, 5, NULL, '2014-05-17 23:31:04', NULL, '100.0000', '120.0000', '5.0000', NULL, '2014-05-17 19:01:04', '0000-00-00 00:00:00'),
(30, 4, NULL, '2014-05-17 23:36:34', NULL, '90.0000', '200.0000', '10.0000', NULL, '2014-05-17 19:06:34', '0000-00-00 00:00:00'),
(31, 3, NULL, '2014-06-12 13:26:18', NULL, NULL, '0.0000', '0.0000', '1.0000', '2014-06-12 08:56:18', '2014-06-12 08:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_code` varchar(30) DEFAULT NULL,
  `receipt_price` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `cheque_id` smallint(5) unsigned DEFAULT NULL,
  `receipt_cheque_date` datetime DEFAULT NULL,
  `receipt_cheque_status` enum('pass','back_recovery','back_fail','lost','block','delete','inprogress') DEFAULT NULL,
  `receipt_desc` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `fund_id` smallint(5) unsigned DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipts_cheques_chequeid` (`cheque_id`) USING BTREE,
  KEY `receipts_transactions_transaction_id` (`transaction_id`) USING BTREE,
  KEY `receipts_funds_fundid` (`fund_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_code`, `receipt_price`, `cheque_id`, `receipt_cheque_date`, `receipt_cheque_status`, `receipt_desc`, `transaction_id`, `fund_id`, `date_created`, `date_modified`) VALUES
(1, NULL, '100.0000', 4, '2014-05-16 22:41:56', NULL, NULL, 2, NULL, '2014-05-29 17:53:27', '2014-05-30 14:00:49');

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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`term_slug`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_name`, `term_slug`, `term_desc`, `term_father`, `term_type`, `date_created`, `date_modified`) VALUES
(1, 'اخبار اصلی', 'news', 'این توضیح دسته اول است', NULL, 'cat', '2014-05-09 19:05:26', '0000-00-00 00:00:00'),
(2, 'رویداد', 'events', 'این توضیح دسته دوم است', NULL, 'cat', '2014-05-09 19:05:26', '0000-00-00 00:00:00'),
(3, 'تگ اول', 'tag1', 'این برای تگ اول است', NULL, 'tag', '2014-05-09 19:05:26', '0000-00-00 00:00:00'),
(4, 'مقالات', 'article', 'مقالات علمی منتشر شده در سامانه', NULL, 'cat', '2014-05-09 19:05:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `term_usages`
--

CREATE TABLE IF NOT EXISTS `term_usages` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` smallint(5) unsigned NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `term+post_unique` (`term_id`,`post_id`) USING BTREE,
  KEY `termusages_posts_postid` (`post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `term_usages`
--
DROP TRIGGER IF EXISTS `TermUsage_AD_outline_update`;
DELIMITER //
CREATE TRIGGER `TermUsage_AD_outline_update` AFTER DELETE ON `term_usages`
 FOR EACH ROW Update posts SET post_slug_cat = 
  (
  Select term_slug from terms 
    Join term_usages on terms.term_id = term_usages.term_id
    Where term_usages.post_id = 5
    ORDER BY term_usages.term_usage_id ASC LIMIT 1
  )

  Where post_id = OLD.post_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TermUsage_AI_outline_update`;
DELIMITER //
CREATE TRIGGER `TermUsage_AI_outline_update` AFTER INSERT ON `term_usages`
 FOR EACH ROW Update posts SET post_slug_cat = 
  (
  Select term_slug from terms 
    Join term_usages on terms.term_id = term_usages.term_id
    Where term_usages.post_id = 5
    ORDER BY term_usages.term_usage_id ASC LIMIT 1
  )

  Where post_id = NEW.post_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TermUsage_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `TermUsage_AU_outline_update` AFTER UPDATE ON `term_usages`
 FOR EACH ROW Update posts SET post_slug_cat = 
  (
  Select term_slug from terms 
    Join term_usages on terms.term_id = term_usages.term_id
    Where term_usages.post_id = 5
    ORDER BY term_usages.term_usage_id ASC LIMIT 1
  )

  Where post_id = NEW.post_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` enum('sale','purchase','customer_to_store','store_to_company','anbargardani','install','repair','chqeue_back_fail') DEFAULT 'sale',
  `user_id_employee` smallint(5) unsigned DEFAULT NULL,
  `user_id_customer` smallint(5) unsigned DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `transaction_sum` decimal(13,4) DEFAULT NULL,
  `transaction_discount` decimal(13,4) DEFAULT NULL,
  `transaction_initial_received` decimal(13,4) DEFAULT NULL,
  `transaction_received` decimal(13,4) DEFAULT NULL,
  `transaction_remained` decimal(13,4) DEFAULT NULL,
  `transaction_pre` enum('yes','no') DEFAULT NULL,
  `transaction_desc` varchar(200) DEFAULT NULL,
  `transaction_transport` decimal(13,4) DEFAULT NULL,
  `transaction_vat` enum('yes','yes_nocalc','no') DEFAULT NULL COMMENT 'in percent',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transactions_users_useridcustomer` (`user_id_customer`),
  KEY `transactions_users_useridemployee` (`user_id_employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `user_id_employee`, `user_id_customer`, `transaction_date`, `transaction_sum`, `transaction_discount`, `transaction_initial_received`, `transaction_received`, `transaction_remained`, `transaction_pre`, `transaction_desc`, `transaction_transport`, `transaction_vat`, `date_created`, `date_modified`) VALUES
(2, 'sale', 15, 15, NULL, '50.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-28 18:33:27', '2014-05-30 21:42:55'),
(3, 'sale', 15, 16, NULL, '240.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-28 18:33:48', '2014-05-30 21:41:20'),
(5, 'sale', 15, 14, NULL, '10000.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-31 10:25:29', '0000-00-00 00:00:00');

--
-- Triggers `transactions`
--
DROP TRIGGER IF EXISTS `Transactions_AI_outline_update`;
DELIMITER //
CREATE TRIGGER `Transactions_AI_outline_update` AFTER INSERT ON `transactions`
 FOR EACH ROW IF NEW.transaction_type = 'sale' 
THEN

  UPDATE users
    SET user_total_income = coalesce(user_total_income , 0) + NEW.transaction_sum
    WHERE user_id in(NEW.user_id_employee, NEW.user_id_customer);

#--------------------------------------------------------------
ELSE 
IF NEW.transaction_type = 'purchase' 
THEN

  UPDATE users
    SET user_total_outcome = coalesce(user_total_outcome , 0) + NEW.transaction_sum
    WHERE user_id in(NEW.user_id_employee, NEW.user_id_customer);


End if;
End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Transactions_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `Transactions_AU_outline_update` AFTER UPDATE ON `transactions`
 FOR EACH ROW IF NEW.transaction_type = 'sale' 
THEN

  UPDATE users
    SET user_total_income = coalesce(user_total_income , 0) + (NEW.transaction_sum - OLD.transaction_sum)
    WHERE user_id in(NEW.user_id_employee, NEW.user_id_customer);

#--------------------------------------------------------------
ELSE 
IF NEW.transaction_type = 'purchase' 
THEN

  UPDATE users
    SET user_total_outcome = coalesce(user_total_outcome , 0) + (NEW.transaction_sum - OLD.transaction_sum)
    WHERE user_id in(NEW.user_id_employee, NEW.user_id_customer);


End if;
End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Transactions_BD_outline_update`;
DELIMITER //
CREATE TRIGGER `Transactions_BD_outline_update` BEFORE DELETE ON `transactions`
 FOR EACH ROW IF OLD.transaction_type = 'sale' 
THEN

  UPDATE users
    SET user_total_income = coalesce(user_total_income , 0) - OLD.transaction_sum
    WHERE user_id in(OLD.user_id_employee, OLD.user_id_customer);

#--------------------------------------------------------------
ELSE 
IF OLD.transaction_type = 'purchase' 
THEN

  UPDATE users
    SET user_total_outcome = coalesce(user_total_outcome , 0) - OLD.transaction_sum
    WHERE user_id in(OLD.user_id_employee, OLD.user_id_customer);


End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE IF NOT EXISTS `transaction_details` (
  `td_row` smallint(5) unsigned DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` smallint(5) unsigned NOT NULL,
  `td_quantity` int(9) NOT NULL DEFAULT '0',
  `td_price` decimal(13,4) NOT NULL,
  `td_discount` decimal(13,4) DEFAULT NULL,
  UNIQUE KEY `sale+product_unique` (`transaction_id`,`product_id`),
  KEY `transactiondetails_products_productid` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`td_row`, `transaction_id`, `product_id`, `td_quantity`, `td_price`, `td_discount`) VALUES
(NULL, 2, 1, 20, '0.0000', NULL),
(NULL, 2, 2, 20, '0.0000', NULL),
(NULL, 2, 5, 1, '50.0000', NULL),
(NULL, 3, 2, 1, '100.0000', NULL);

--
-- Triggers `transaction_details`
--
DROP TRIGGER IF EXISTS `TransactionDetails_AI_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_AI_outline_update` AFTER INSERT ON `transaction_details`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold , 0) + NEW.td_quantity),
  product_stock = (coalesce(product_stock, 0) - NEW.td_quantity)
Where
  product_id = NEW.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((td_price-coalesce(td_discount,0))*td_quantity) from transaction_details where transaction_id = new.transaction_id)
Where
  transaction_id = new.transaction_id;


End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TransactionDetails_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_AU_outline_update` AFTER UPDATE ON `transaction_details`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold , 0) + (NEW.td_quantity - OLD.td_quantity) ),
  product_stock = (coalesce(product_stock, 0) - (NEW.td_quantity - OLD.td_quantity) )
Where
  product_id = NEW.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((td_price-coalesce(td_discount,0))*td_quantity) from transaction_details where transaction_id = new.transaction_id)
Where
  transaction_id = new.transaction_id;


End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TransactionDetails_BD_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_BD_outline_update` BEFORE DELETE ON `transaction_details`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold, 0) -OLD.td_quantity),
  product_stock = (coalesce(product_stock, 0) + OLD.td_quantity)
Where
  product_id = OLD.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((td_price-coalesce(td_discount,0))*td_quantity) from transaction_details where transaction_id = OLD.transaction_id)
Where
  transaction_id = OLD.transaction_id;


End if
//
DELIMITER ;

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
  `user_total_income` bigint(11) DEFAULT NULL,
  `user_total_outcome` bigint(11) DEFAULT NULL,
  `user_credit` enum('yes','no') DEFAULT 'no',
  `user_question` varchar(100) DEFAULT NULL,
  `user_answer` varchar(100) DEFAULT NULL,
  `permission_name` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_uniques` (`user_email`) USING BTREE,
  UNIQUE KEY `mobile_unique` (`user_mobile`) USING BTREE,
  KEY `users_permissions_permissionid` (`permission_name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_pass`, `user_email`, `user_gender`, `user_married`, `user_firstname`, `user_lastname`, `user_nickname`, `user_tel`, `user_mobile`, `user_birthday`, `user_country`, `user_state`, `user_city`, `user_address`, `user_postcode`, `user_newsletter`, `user_refer`, `user_nationalcode`, `user_website`, `user_status`, `user_degree`, `user_activity`, `user_total_income`, `user_total_outcome`, `user_credit`, `user_question`, `user_answer`, `permission_name`, `date_created`, `date_modified`) VALUES
(14, NULL, 'eee1', 'eee2', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'active', NULL, NULL, 9010, NULL, 'no', NULL, NULL, NULL, '2014-05-04 09:10:41', '2014-06-12 09:07:22'),
(15, NULL, 'fff1', NULL, NULL, NULL, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, 9032, NULL, 'no', NULL, NULL, NULL, '2014-05-04 09:11:25', '2014-06-12 09:07:29'),
(16, NULL, 'aaa1', 'aaa2', NULL, NULL, NULL, 'Test last', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-05-04 11:52:11', '2014-06-12 09:07:34'),
(17, NULL, 'a', 'a', NULL, NULL, NULL, NULL, 'Nick', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-05-05 14:59:56', '2014-06-12 09:07:39'),
(18, NULL, 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-05-07 06:53:29', '2014-06-12 09:07:47'),
(21, NULL, 'c', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-05-07 06:54:29', '0000-00-00 00:00:00'),
(22, 'customer', '7fa8282ad93047a4d6fe6111c93b308a', '09123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-06-09 21:19:40', '0000-00-00 00:00:00'),
(23, 'customer', '96e79218965eb72c92a549dd5a330112', '09124567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-06-10 09:19:06', '0000-00-00 00:00:00'),
(26, 'customer', '96e79218965eb72c92a549dd5a330112', 'a@b.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-06-10 19:38:16', '0000-00-00 00:00:00'),
(27, 'customer', '96e79218965eb72c92a549dd5a330112', 'aa@b.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, 'awaiting', NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, '2014-06-10 20:51:22', '0000-00-00 00:00:00');

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
				md5(New.id & New.date_created),
				New.id
 )
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ul_title` varchar(50) DEFAULT NULL,
  `ul_desc` varchar(999) DEFAULT NULL,
  `ul_priority` enum('high','medium','low') NOT NULL DEFAULT 'medium',
  `ul_type` enum('forget_password') DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transactions_users_userid` (`user_id`),
  KEY `priority_index` (`ul_priority`),
  KEY `type_index` (`ul_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) unsigned DEFAULT NULL,
  `usermeta_cat` varchar(50) DEFAULT NULL,
  `usermeta_name` varchar(100) DEFAULT NULL,
  `usermeta_value` varchar(999) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usermeta_users_userid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `verification_type` enum('register_by_email','register_by_mobile','forget','change_email','change_mobile') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `verification_verified` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'no',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_unique` (`verification_code`),
  KEY `verifications_users_userid` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `verification_type`, `verification_email`, `verification_code`, `user_id`, `verification_verified`, `date_created`, `date_modified`) VALUES
(1, 'register_by_email', '09123456789', '98f13708210194c475687be6106a3b84', 22, 'no', '2014-06-09 21:19:40', '0000-00-00 00:00:00'),
(2, 'register_by_email', '09124567890', '6f4922f45568161a8cdf4ad2299f6d23', 23, 'no', '2014-06-10 09:19:06', '0000-00-00 00:00:00'),
(3, 'register_by_email', 'a@b.com', 'c74d97b01eae257e44aa9d5bade97baf', 26, 'no', '2014-06-10 19:38:16', '0000-00-00 00:00:00'),
(4, 'register_by_email', 'aa@b.com', '4e732ced3463d06de0ca9a15b6153677', 27, 'no', '2014-06-10 20:51:22', '0000-00-00 00:00:00'),
(8, 'register_by_email', '26', '6ace548181c0d09054db1b8cd98075c0', 26, 'no', '2014-06-10 21:58:08', '0000-00-00 00:00:00'),
(12, 'forget', '26', '77d17d6cdf8f6b8fc97414d5dfbd35a3', 26, 'no', '2014-06-10 22:06:13', '0000-00-00 00:00:00');

--
-- Triggers `verifications`
--
DROP TRIGGER IF EXISTS `verification_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `verification_AU_outline_update` AFTER UPDATE ON `verifications`
 FOR EACH ROW IF NEW.verification_verified <> OLD.verification_verified THEN
   if new.verification_verified = 'yes' then
       UPDATE users SET user_status = 'active' WHERE user_id = New.user_id;
   END IF;
END IF
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_banks_bankid` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `accounts_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cheques`
--
ALTER TABLE `cheques`
  ADD CONSTRAINT `cheques_banks_bankid` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `cheques_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_posts_postid` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_products_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_accounts_accountid` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `costs_costcategories_ccid` FOREIGN KEY (`cc_id`) REFERENCES `cost_categories` (`id`);

--
-- Constraints for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD CONSTRAINT `errorlogs_errors_edid` FOREIGN KEY (`ed_id`) REFERENCES `errors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `errorlogs_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `funds`
--
ALTER TABLE `funds`
  ADD CONSTRAINT `funds_locations_locationid` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_users_useridreciever` FOREIGN KEY (`user_id_reciever`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_users_useridsender` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_attachments_attachmentid` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_meta`
--
ALTER TABLE `post_meta`
  ADD CONSTRAINT `postmeta_posts_postid` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_attachments_attachmentid` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_productcategories_pcatid` FOREIGN KEY (`pcat_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `productcategories_attachments_attachmentid` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_meta`
--
ALTER TABLE `product_meta`
  ADD CONSTRAINT `productmeta_product_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `productprices_products_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_cheques_chequeid` FOREIGN KEY (`cheque_id`) REFERENCES `cheques` (`id`),
  ADD CONSTRAINT `receipts_funds_fundid` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`),
  ADD CONSTRAINT `receipts_transactions_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `term_usages`
--
ALTER TABLE `term_usages`
  ADD CONSTRAINT `termusages_posts_postid` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `termusages_terms_termid` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_users_useridcustomer` FOREIGN KEY (`user_id_customer`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_users_useridemployee` FOREIGN KEY (`user_id_employee`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transactiondetails_products_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transactiondetails_transactions_transactionid` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_permissions_permission_name` FOREIGN KEY (`permission_name`) REFERENCES `permissions` (`permission_name`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `transactions_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD CONSTRAINT `usermeta_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
