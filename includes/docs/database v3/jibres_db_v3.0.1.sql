-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2014 at 05:02 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ermile`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` smallint(5) unsigned NOT NULL COMMENT 'test comment',
  `account_title` varchar(50) NOT NULL,
  `account_slug` varchar(50) NOT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `account_branch` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_card` varchar(30) DEFAULT NULL,
  `account_primarybalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `account_desc` varchar(200) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

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
`id` smallint(5) unsigned NOT NULL,
  `addon_name` varchar(50) NOT NULL,
  `addon_slug` varchar(50) NOT NULL,
  `addon_desc` varchar(999) DEFAULT NULL,
  `addon_status` enum('enable','disable','expire','goingtoexpire') NOT NULL DEFAULT 'enable',
  `addon_expire` datetime DEFAULT NULL,
  `addon_installdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
`id` int(10) unsigned NOT NULL,
  `attachment_title` varchar(100) DEFAULT NULL,
  `attachment_model` enum('productcategory','product','admin','banklogo','post','system','other') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `attachment_addr` varchar(100) NOT NULL,
  `attachment_name` varchar(50) NOT NULL,
  `attachment_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `attachment_size` float(12,0) NOT NULL,
  `attachment_desc` varchar(200) DEFAULT NULL,
  `attachment_server` int(10) unsigned DEFAULT NULL,
  `attachment_folder` int(10) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
`id` smallint(5) unsigned NOT NULL,
  `bank_title` varchar(50) NOT NULL,
  `bank_slug` varchar(50) NOT NULL,
  `bank_website` varchar(50) DEFAULT NULL,
  `bank_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_title`, `bank_slug`, `bank_website`, `bank_status`, `date_modified`) VALUES
(1, 'پارسیان', 'parsian', 'http://parsian-bank.com', '', '2014-11-24 12:43:55'),
(2, 'ملی', 'melli', NULL, '', '2014-11-07 17:37:14'),
(3, 'ملت', 'mellat', NULL, '', '0000-00-00 00:00:00'),
(4, 'پاسارگاد', 'pasargad', NULL, '', '0000-00-00 00:00:00'),
(5, 'تجارت', 'tejarat', NULL, '', '0000-00-00 00:00:00'),
(6, 'انصار', 'ansar', NULL, '', '0000-00-00 00:00:00'),
(7, 'آینده', 'ayandeh', NULL, '', '0000-00-00 00:00:00'),
(8, 'صادرات', 'saderat', NULL, '', '0000-00-00 00:00:00'),
(9, 'سینا', 'sina', NULL, '', '0000-00-00 00:00:00'),
(10, 'اقتصاد نوین', 'eghtesad', NULL, '', '0000-00-00 00:00:00'),
(50, 'test', 'tt', '3', '', '0000-00-00 00:00:00'),
(55, 'test2', 't2', 'www', '', '0000-00-00 00:00:00'),
(56, 'test312', 't3', 'wwwwwwwq', '', '2014-11-10 17:36:12'),
(57, '', '', NULL, '', '0000-00-00 00:00:00'),
(60, 'fsadfsda', 'fwefwqe', NULL, '', '0000-00-00 00:00:00'),
(61, 'retew', 'tewtewt', NULL, '', '0000-00-00 00:00:00'),
(64, 'wrr325', '34tweate', NULL, '', '0000-00-00 00:00:00'),
(65, 'rewqr', 'rwerq', NULL, '', '0000-00-00 00:00:00'),
(66, 'reqare', 'rwqrw', NULL, '', '0000-00-00 00:00:00'),
(68, 'rwer', 'wqerqer', NULL, '', '0000-00-00 00:00:00'),
(70, 'test', 'test2', NULL, '', '0000-00-00 00:00:00'),
(71, 'wrqwrqwr', 'rwerwe', NULL, '', '0000-00-00 00:00:00'),
(72, 'fsfewf', 'ewrweq', NULL, '', '0000-00-00 00:00:00'),
(91, 'salam khobi', 'bale', NULL, '', '2014-11-24 08:02:51'),
(100, 'reba', 'reba', NULL, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` smallint(5) unsigned NOT NULL,
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
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `costcats`
--

CREATE TABLE IF NOT EXISTS `costcats` (
`id` smallint(5) unsigned NOT NULL,
  `costcat_title` varchar(50) NOT NULL,
  `costcat_slug` varchar(50) NOT NULL,
  `costcat_desc` varchar(200) DEFAULT NULL,
  `costcat_father` smallint(5) DEFAULT NULL,
  `costcat_row` smallint(5) DEFAULT NULL,
  `costcat_type` enum('income','outcome') DEFAULT NULL,
  `costcat_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `costcats`
--

INSERT INTO `costcats` (`id`, `costcat_title`, `costcat_slug`, `costcat_desc`, `costcat_father`, `costcat_row`, `costcat_type`, `costcat_status`, `date_modified`) VALUES
(3, 'test', 'tt', 'eee', NULL, NULL, 'outcome', 'enable', '0000-00-00 00:00:00'),
(4, 'test2', 'tt2', 'tt2', NULL, NULL, 'income', 'enable', '0000-00-00 00:00:00'),
(5, 'test3', 't3', 'tt3', 3, 4, 'income', 'enable', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
`id` smallint(5) unsigned NOT NULL,
  `cost_title` varchar(50) NOT NULL,
  `cost_price` decimal(13,4) NOT NULL,
  `costcat_id` smallint(5) unsigned NOT NULL,
  `account_id` smallint(5) unsigned NOT NULL,
  `cost_date` datetime NOT NULL,
  `cost_desc` varchar(200) DEFAULT NULL,
  `cost_type` enum('income','outcome') NOT NULL DEFAULT 'outcome',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `errorlogs`
--

CREATE TABLE IF NOT EXISTS `errorlogs` (
`id` int(10) unsigned NOT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `errorlog_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` smallint(5) unsigned NOT NULL,
  `error_title` varchar(100) NOT NULL,
  `error_solution` varchar(999) DEFAULT NULL,
  `error_priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE IF NOT EXISTS `funds` (
`id` smallint(5) unsigned NOT NULL,
  `fund_title` varchar(100) NOT NULL,
  `fund_slug` varchar(100) NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `fund_initialbalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `fund_desc` varchar(200) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fund_title`, `fund_slug`, `location_id`, `fund_initialbalance`, `fund_desc`, `date_modified`) VALUES
(2, 'Main', 'main', 1, '0.0000', NULL, '0000-00-00 00:00:00'),
(3, 'werew', 'wqrwer', 1, '9999999999.9999', NULL, '0000-00-00 00:00:00');

--
-- Triggers `funds`
--
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
`id` smallint(5) unsigned NOT NULL,
  `location_title` varchar(100) NOT NULL,
  `location_slug` varchar(100) NOT NULL,
  `location_desc` varchar(200) DEFAULT NULL,
  `location_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_title`, `location_slug`, `location_desc`, `location_status`, `date_modified`) VALUES
(1, 'Main Location', 'main', NULL, 'enable', '2014-11-07 18:21:17'),
(2, 'test', 't', NULL, 'enable', '0000-00-00 00:00:00');

--
-- Triggers `locations`
--
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
`id` int(10) unsigned NOT NULL,
  `user_id_sender` smallint(5) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `notification_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `notification_content` varchar(200) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `notification_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `notification_status` enum('read','unread') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'unread',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`id` smallint(5) unsigned NOT NULL,
  `option_cat` varchar(50) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_value` varchar(200) DEFAULT NULL,
  `option_extra` varchar(400) DEFAULT NULL,
  `option_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_cat`, `option_name`, `option_value`, `option_extra`, `option_status`, `date_modified`) VALUES
(1, 'global', 'language', 'fa', NULL, '', '2014-05-01 08:18:41'),
(2, 'global', 'language', 'en', NULL, '', '2014-05-01 08:18:42'),
(3, 'global', 'title', 'Jibres', NULL, '', '2014-11-07 17:29:37'),
(4, 'global', 'desc', 'Jibres for all', NULL, '', '2014-11-07 17:29:46'),
(5, 'global', 'keyword', 'Jibres, store, online store', NULL, '', '2014-11-07 17:30:07'),
(6, 'global', 'url', 'http://jibres.ir', NULL, '', '2014-11-07 17:30:18'),
(7, 'global', 'email', 'info@jibres.ir', NULL, '', '2014-11-07 17:30:22'),
(8, 'global', 'auto_mail', 'no-reply@jibres.ir', NULL, '', '2014-11-07 17:30:27'),
(9, 'users', 'user_degree', 'under diploma', NULL, '', '0000-00-00 00:00:00'),
(10, 'users', 'user_degree', 'diploma', NULL, '', '0000-00-00 00:00:00'),
(11, 'users', 'user_degree', '2-year collage', NULL, '', '0000-00-00 00:00:00'),
(12, 'users', 'user_degree', 'bachelor', NULL, '', '0000-00-00 00:00:00'),
(13, 'users', 'user_degree', 'master', NULL, '', '0000-00-00 00:00:00'),
(14, 'users', 'user_degree', 'doctorate', NULL, '', '0000-00-00 00:00:00'),
(15, 'users', 'user_degree', 'religious', NULL, '', '0000-00-00 00:00:00'),
(16, 'users', 'user_activity', 'employee', NULL, '', '0000-00-00 00:00:00'),
(17, 'users', 'user_activity', 'housekeeper ', NULL, '', '0000-00-00 00:00:00'),
(18, 'users', 'user_activity', 'free lance', NULL, '', '0000-00-00 00:00:00'),
(19, 'users', 'user_activity', 'retired', NULL, '', '0000-00-00 00:00:00'),
(20, 'users', 'user_activity', 'student', NULL, '', '0000-00-00 00:00:00'),
(21, 'users', 'user_activity', 'unemployed', NULL, '', '0000-00-00 00:00:00'),
(22, 'users', 'user_activity', 'seminary student', NULL, '', '0000-00-00 00:00:00'),
(23, 'permissions', 'permission_name', 'admin', NULL, '', '2014-11-07 17:30:55'),
(24, 'permissions', 'permission_name', 'reseller', NULL, '', '2014-11-07 17:30:56'),
(26, 'ships', 'post', '1', NULL, '', '2014-11-07 17:30:56'),
(27, 'ships', 'tipax', '2', NULL, '', '2014-11-07 17:30:57'),
(28, 'units', 'money_unit', 'toman', NULL, '', '2014-11-07 17:31:08'),
(29, 'units', 'product_unit', 'adad', NULL, '', '2014-11-07 17:31:29'),
(30, 'permissions', 'permission_name', 'viewer', NULL, '', '2014-05-17 21:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE IF NOT EXISTS `papers` (
`id` smallint(5) unsigned NOT NULL,
  `paper_type` varchar(50) DEFAULT NULL,
  `paper_number` varchar(20) DEFAULT NULL,
  `paper_date` datetime DEFAULT NULL,
  `paper_price` decimal(13,4) DEFAULT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `paper_holder` varchar(100) DEFAULT NULL,
  `paper_desc` varchar(200) DEFAULT NULL,
  `paper_status` enum('pass','recovery','fail','lost','block','delete','inprogress') DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `paper_type`, `paper_number`, `paper_date`, `paper_price`, `bank_id`, `paper_holder`, `paper_desc`, `paper_status`, `date_modified`) VALUES
(1, NULL, '123', NULL, '500.0000', 1, NULL, NULL, NULL, '0000-00-00 00:00:00');

--
-- Triggers `papers`
--
DELIMITER //
CREATE TRIGGER `cheques_AU_outline_copy` BEFORE UPDATE ON `papers`
 FOR EACH ROW IF coalesce(OLD.paper_date , '') <> coalesce(NEW.paper_date , '') or
    coalesce(OLD.paper_price , '') <> coalesce(NEW.paper_price , '') or
    coalesce(OLD.paper_status , '') <> coalesce(NEW.paper_status , '')
THEN

  Update receipts 
    SET receipt_paperdate = NEW.paper_date, receipt_price = NEW.paper_price, receipt_paperstatus = NEW.paper_status
    WHERE paper_id = NEW.id;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` smallint(5) unsigned NOT NULL,
  `permission_title` varchar(50) NOT NULL,
  `Permission_module` varchar(50) NOT NULL,
  `permission_view` enum('yes','no') NOT NULL DEFAULT 'yes',
  `permission_add` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_title`, `Permission_module`, `permission_view`, `permission_add`, `permission_edit`, `permission_delete`, `permission_status`, `date_modified`) VALUES
(1, 'admin', 'banks', 'yes', 'yes', 'yes', 'yes', '', '2014-11-08 14:08:16'),
(2, 'reseller', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 'admin2', '', 'yes', 'no', 'no', 'no', '', '2014-11-08 09:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `postmetas`
--

CREATE TABLE IF NOT EXISTS `postmetas` (
  `id` smallint(5) NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `postmeta_cat` varchar(50) NOT NULL,
  `postmeta_name` varchar(100) NOT NULL,
  `postmeta_value` varchar(999) DEFAULT NULL,
  `postmeta_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` smallint(5) unsigned NOT NULL,
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
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productcats`
--

CREATE TABLE IF NOT EXISTS `productcats` (
`id` smallint(5) unsigned NOT NULL,
  `productcat_title` varchar(50) NOT NULL,
  `productcat_slug` varchar(50) NOT NULL,
  `productcat_desc` varchar(200) DEFAULT NULL,
  `productcat_father` smallint(5) unsigned DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `productcat_row` smallint(5) unsigned DEFAULT '0',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productcats`
--

INSERT INTO `productcats` (`id`, `productcat_title`, `productcat_slug`, `productcat_desc`, `productcat_father`, `attachment_id`, `productcat_row`, `date_modified`) VALUES
(1, 'general', 'general', NULL, NULL, NULL, 0, '2014-11-07 18:11:58');

--
-- Triggers `productcats`
--
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
`id` int(10) unsigned NOT NULL,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_cat` varchar(50) NOT NULL,
  `productmeta_name` varchar(100) NOT NULL,
  `productmeta_value` varchar(999) DEFAULT NULL,
  `productmeta_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productmetas`
--

INSERT INTO `productmetas` (`id`, `product_id`, `productmeta_cat`, `productmeta_name`, `productmeta_value`, `productmeta_status`, `date_modified`) VALUES
(21, 1, 'price_white', 'product_price', '600', 'enable', '2014-11-07 16:49:50'),
(22, 1, 'price_white', 'product_buy_price', '5000', 'enable', '2014-11-07 16:49:51'),
(39, 1, 'price1', 'product_vat', '11', 'enable', '2014-11-07 16:33:34'),
(73, 1, 'price1', 'product_discount', '20', 'enable', '2014-11-07 16:49:52');

--
-- Triggers `productmetas`
--
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
`id` int(10) unsigned NOT NULL,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_id` int(10) unsigned DEFAULT NULL,
  `productprice_cat` varchar(50) DEFAULT NULL,
  `productprice_startdate` datetime NOT NULL,
  `productprice_enddate` datetime DEFAULT NULL,
  `productprice_buyprice` decimal(13,4) DEFAULT NULL,
  `productprice_price` decimal(13,4) DEFAULT NULL,
  `productprice_discount` decimal(13,4) DEFAULT NULL,
  `productprice_vat` decimal(6,4) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` smallint(5) unsigned NOT NULL,
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
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
DELIMITER //
CREATE TRIGGER `products_AI_outline_copy` AFTER INSERT ON `products`
 FOR EACH ROW INSERT INTO productprices
    (product_id, productprice_startdate, productprice_buyprice, productprice_price,  productprice_discount, productprice_vat) 
    
    VALUES(NEW.id,  NOW(), NEW.product_buyprice, new.product_price, new.product_discount, new.product_vat)
//
DELIMITER ;
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
`id` int(10) unsigned NOT NULL,
  `receipt_code` varchar(30) DEFAULT NULL,
  `receipt_type` enum('income','outcome') DEFAULT 'income',
  `receipt_price` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `receipt_date` datetime NOT NULL,
  `paper_id` smallint(5) unsigned DEFAULT NULL,
  `receipt_paperdate` datetime DEFAULT NULL,
  `receipt_paperstatus` enum('pass','recovery','fail','lost','block','delete','inprogress') DEFAULT NULL,
  `receipt_desc` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `fund_id` smallint(5) unsigned NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `user_id_customer` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_code`, `receipt_type`, `receipt_price`, `receipt_date`, `paper_id`, `receipt_paperdate`, `receipt_paperstatus`, `receipt_desc`, `transaction_id`, `fund_id`, `user_id`, `user_id_customer`, `date_modified`) VALUES
(6, '123', 'income', '0.0000', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 2, 14, 15, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `smss`
--

CREATE TABLE IF NOT EXISTS `smss` (
`id` int(10) unsigned NOT NULL,
  `sms_from` varchar(15) DEFAULT NULL,
  `sms_to` varchar(15) DEFAULT NULL,
  `sms_message` varchar(255) DEFAULT NULL,
  `sms_messageid` int(10) unsigned DEFAULT NULL,
  `sms_status` tinyint(4) unsigned DEFAULT NULL,
  `sms_method` enum('post','get') NOT NULL DEFAULT 'post',
  `sms_type` enum('receive','delivery') DEFAULT 'delivery',
  `sms_date` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smss`
--

INSERT INTO `smss` (`id`, `sms_from`, `sms_to`, `sms_message`, `sms_messageid`, `sms_status`, `sms_method`, `sms_type`, `sms_date`, `date_modified`) VALUES
(70, NULL, NULL, NULL, 30221993, 4, 'get', 'delivery', '2014-12-29 22:05:24', NULL),
(71, NULL, NULL, NULL, 777, 0, 'post', 'delivery', '2014-12-30 10:53:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
`id` smallint(5) unsigned NOT NULL,
  `term_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `term_slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `term_desc` varchar(200) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `term_father` smallint(5) unsigned DEFAULT NULL,
  `term_type` enum('cat','tag') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'cat',
  `term_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_name`, `term_slug`, `term_desc`, `term_father`, `term_type`, `term_status`, `date_modified`) VALUES
(1, 'news', 'news', '', NULL, 'cat', 'enable', '0000-00-00 00:00:00'),
(5, 'test', 't', 't', 1, 'tag', 'enable', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--

CREATE TABLE IF NOT EXISTS `termusages` (
`id` smallint(5) unsigned NOT NULL,
  `term_id` smallint(5) unsigned NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `transactiondetail_discount` decimal(13,4) DEFAULT NULL
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
-- Table structure for table `transactionmetas`
--

CREATE TABLE IF NOT EXISTS `transactionmetas` (
`id` smallint(6) unsigned NOT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `transactionmeta_cat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `transactionmeta_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `transactionmeta_value` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `transactionmeta_status` enum('enable','disable') CHARACTER SET utf8 NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
`id` int(10) unsigned NOT NULL,
  `transaction_type` enum('sale','purchase','customertostore','storetocompany','anbargardani','install','repair','chqeuebackfail') NOT NULL DEFAULT 'sale',
  `user_id` smallint(5) unsigned NOT NULL,
  `user_id_customer` smallint(5) unsigned NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_sum` decimal(13,4) NOT NULL,
  `transaction_remained` decimal(13,4) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `user_id`, `user_id_customer`, `transaction_date`, `transaction_sum`, `transaction_remained`, `date_modified`) VALUES
(2, 'sale', 15, 15, '0000-00-00 00:00:00', '50.0000', NULL, '2014-05-30 21:42:55'),
(3, 'sale', 15, 16, '0000-00-00 00:00:00', '240.0000', NULL, '2014-05-30 21:41:20'),
(5, 'sale', 15, 14, '0000-00-00 00:00:00', '10000.0000', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE IF NOT EXISTS `userlogs` (
`id` int(10) unsigned NOT NULL,
  `userlog_title` varchar(50) DEFAULT NULL,
  `userlog_desc` varchar(999) DEFAULT NULL,
  `userlog_priority` enum('high','medium','low') NOT NULL DEFAULT 'medium',
  `userlog_type` enum('forgetpassword') DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`id`, `userlog_title`, `userlog_desc`, `userlog_priority`, `userlog_type`, `user_id`, `date_modified`) VALUES
(1, NULL, ' |status:قصضقصثق', 'medium', NULL, NULL, NULL),
(2, '235235', ' |status:wq4wrqw', 'low', NULL, NULL, NULL),
(5, NULL, ' |status:', 'low', NULL, NULL, NULL),
(6, NULL, ' |status:', 'low', NULL, NULL, NULL),
(7, NULL, ' |status:', 'low', NULL, NULL, NULL),
(8, NULL, ' |status:', 'low', NULL, NULL, NULL),
(9, NULL, ' |status:', 'low', NULL, NULL, NULL),
(10, 'from: 123 | to: 456', ' |message:test-javad |msgid: 678', 'medium', NULL, NULL, NULL),
(11, '364264', ' |status:364264', 'low', NULL, NULL, NULL),
(12, NULL, ' |status:', 'low', NULL, NULL, NULL),
(13, NULL, ' |status:', 'low', NULL, NULL, NULL),
(14, '343215132', 'msgid: 343215132 |status:ثصضقثص', 'low', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usermetas`
--

CREATE TABLE IF NOT EXISTS `usermetas` (
`id` smallint(6) unsigned NOT NULL,
  `user_id` smallint(6) unsigned DEFAULT NULL,
  `usermeta_cat` varchar(50) DEFAULT NULL,
  `usermeta_name` varchar(100) DEFAULT NULL,
  `usermeta_value` varchar(500) DEFAULT NULL,
  `usermeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` smallint(5) unsigned NOT NULL COMMENT 'use char(36) if i want use uuid',
  `user_type` enum('storeadmin','storeemployee','storesupplier','storecustomer','admin','user') DEFAULT 'user',
  `user_mobile` varchar(15) NOT NULL COMMENT 'Mobile',
  `user_pass` char(32) NOT NULL COMMENT 'Password',
  `user_email` varchar(50) DEFAULT NULL,
  `user_gender` enum('male','female') DEFAULT NULL COMMENT 'Gender',
  `user_nickname` varchar(50) DEFAULT NULL,
  `user_firstname` varchar(50) DEFAULT NULL COMMENT 'First Name',
  `user_lastname` varchar(50) DEFAULT NULL COMMENT 'Last Name',
  `user_birthday` datetime DEFAULT NULL,
  `user_status` enum('active','awaiting','deactive','removed') DEFAULT 'awaiting' COMMENT 'Status',
  `user_credit` enum('yes','no') DEFAULT 'no',
  `permission_id` smallint(5) unsigned DEFAULT NULL,
  `user_createdate` datetime NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_mobile`, `user_pass`, `user_email`, `user_gender`, `user_nickname`, `user_firstname`, `user_lastname`, `user_birthday`, `user_status`, `user_credit`, `permission_id`, `user_createdate`, `date_modified`) VALUES
(14, 'storeadmin', '+989357269758', '96e79218965eb72c92a549dd5a330112', 'eee2', 'male', 'J.Evazzadeh', 'Javad', 'Evazzadeh', NULL, 'active', 'no', 1, '0000-00-00 00:00:00', '2014-12-30 12:45:59'),
(15, 'storeadmin', '+989113334444', '96e79218965eb72c92a549dd5a330112', NULL, NULL, 'Test1', 'Test', NULL, NULL, 'awaiting', 'no', 1, '0000-00-00 00:00:00', '2014-12-30 12:46:00'),
(16, 'storeadmin', '+989357269750', '96e79218965eb72c92a549dd5a330112', 'aaa2', NULL, 'Test3', NULL, 'Test last', NULL, 'active', 'no', 1, '0000-00-00 00:00:00', '2014-12-30 12:46:01'),
(28, 'storeadmin', '+989363334444', '96e79218965eb72c92a549dd5a330112', 'aaa', NULL, 'Javad', 'Javad', 'Evazzadeh', NULL, 'active', 'yes', NULL, '0000-00-00 00:00:00', '2014-12-30 12:46:01'),
(74, 'storeadmin', '+989389105350', '96e79218965eb72c92a549dd5a330112', NULL, NULL, NULL, NULL, NULL, NULL, 'active', 'no', NULL, '0000-00-00 00:00:00', '2014-12-30 12:46:01'),
(150, 'storeadmin', '+989357269759', '111111', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '0000-00-00 00:00:00', '2014-12-30 12:46:02'),
(151, 'storeadmin', '+989357269475', '111111', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '0000-00-00 00:00:00', '2014-12-30 12:46:02'),
(152, 'storeadmin', '+989357269752', '111111', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '2014-12-30 13:24:11', '2014-12-30 12:46:02'),
(153, 'storeadmin', '+989357269742', '111111', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '2014-12-30 13:58:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
`id` smallint(5) unsigned NOT NULL,
  `verification_type` enum('emailregister','emailchange','emailforget','mobileregister','mobilechange','mobileforget') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_value` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `verification_url` varchar(100) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `verification_verified` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'no',
  `verification_createdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=370 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `verification_type`, `verification_value`, `verification_code`, `verification_url`, `user_id`, `verification_verified`, `verification_createdate`, `date_modified`) VALUES
(27, 'mobileforget', '+989357269759', '4543', NULL, 16, 'no', NULL, '0000-00-00 00:00:00'),
(28, 'mobileregister', '+9811112222', '2625', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(29, 'mobileregister', '+989112225555', '8785', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(30, 'mobileregister', '+989123124112', '4338', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(31, 'mobileregister', '+989111941061', '8686', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(32, 'mobileregister', '+98124124124', '2423', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(33, 'mobileregister', '+9812412412', '6454', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(34, 'mobileregister', '+98214124124', '8765', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(35, 'mobileregister', '+98235352135', '3233', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(36, 'mobileregister', '+98432432423', '5483', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(37, 'mobileregister', '+98253253215', '3857', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(38, 'mobileregister', '+983535315', '9456', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(39, 'mobileregister', '+984325235', '6674', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(42, 'mobileforget', '+989113334444', '8484', NULL, 14, 'yes', NULL, '2014-11-22 23:54:38'),
(43, 'mobileforget', '+989113334444', '4893', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(44, 'mobileforget', '+989113334444', '3483', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(45, 'mobileforget', '+989113334444', '9468', NULL, 14, 'yes', NULL, '2014-11-22 23:53:33'),
(46, 'mobileforget', '+989113334444', '4388', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(62, 'mobileforget', '+989357269759', '8249', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(65, 'mobileforget', '+989357269759', '5768', NULL, 14, 'no', '2014-12-28 21:47:42', '2014-12-28 18:17:44'),
(66, 'mobileforget', '+989357269759', '4526', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(82, 'mobileforget', '+989357269759', '3536', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(103, 'mobileforget', '+989357269759', '7737', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(104, 'mobileforget', '+989357269759', '3795', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(105, 'mobileforget', '+989357269759', '2253', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(106, 'mobileforget', '+989357269759', '2997', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(107, 'mobileforget', '+989357269759', '9269', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(108, 'mobileforget', '+989357269759', '8682', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(111, 'mobileforget', '+989357269759', '8796', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(112, 'mobileforget', '+989357269759', '6325', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(115, 'mobileforget', '+989357269759', '5526', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(116, 'mobileforget', '+989357269759', '2592', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(117, 'mobileforget', '+989357269759', '2595', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(118, 'mobileforget', '+989357269759', '9994', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(119, 'mobileforget', '+989357269759', '3274', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(120, 'mobileforget', '+989357269759', '9553', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(121, 'mobileforget', '+989357269759', '9954', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(122, 'mobileforget', '+989357269759', '2665', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(123, 'mobileforget', '+989357269759', '9242', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(124, 'mobileforget', '+989357269759', '6634', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(125, 'mobileforget', '+989357269759', '2296', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(126, 'mobileforget', '+989357269759', '4834', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(127, 'mobileforget', '+989357269759', '5676', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(128, 'mobileforget', '+989357269759', '9882', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(129, 'mobileforget', '+989357269759', '7849', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(131, 'mobileforget', '+989357269759', '2947', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(132, 'mobileforget', '+989357269759', '5467', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(133, 'mobileforget', '+989357269759', '7548', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(134, 'mobileforget', '+989357269759', '6982', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(135, 'mobileforget', '+989357269759', '7258', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(136, 'mobileforget', '+989357269759', '7554', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(137, 'mobileforget', '+989357269759', '9349', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(138, 'mobileforget', '+989357269759', '9453', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(139, 'mobileforget', '+989357269759', '8252', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(140, 'mobileforget', '+989357269759', '8437', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(141, 'mobileforget', '+989357269759', '7279', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(142, 'mobileforget', '+989357269759', '3739', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(143, 'mobileforget', '+989357269759', '6467', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(144, 'mobileforget', '+989357269759', '8467', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(145, 'mobileforget', '+989357269759', '5247', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(146, 'mobileforget', '+989357269759', '4955', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(147, 'mobileforget', '+989113334444', '3298', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(149, 'mobileforget', '+989357269759', '3653', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(150, 'mobileforget', '+989357269759', '4652', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(151, 'mobileforget', '+989357269759', '5379', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(155, 'mobileforget', '+989113334444', '3575', NULL, 15, 'no', NULL, '0000-00-00 00:00:00'),
(156, 'mobileforget', '+989357269759', '2539', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(161, 'mobileforget', '+989357269759', '6575', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(225, 'mobileforget', '+989357269759', '5284', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(226, 'mobileforget', '+989357269759', '9544', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(227, 'mobileforget', '+989357269759', '9758', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(228, 'mobileforget', '+989357269759', '8763', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(261, 'mobileforget', '+989357269759', '2879', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(262, 'mobileforget', '+989357269759', '6733', NULL, 14, 'yes', NULL, '2014-11-26 15:35:18'),
(266, 'mobileregister', '+989389105350', '5457', NULL, 74, 'yes', NULL, '2014-11-26 15:46:37'),
(267, 'mobileforget', '+989389105350', '5282', NULL, 74, 'yes', NULL, '2014-11-26 15:48:00'),
(274, 'mobileforget', '+989357269759', '6635', NULL, 14, 'no', NULL, '0000-00-00 00:00:00'),
(275, 'mobileforget', '+989357269759', '6276', NULL, 14, 'yes', NULL, '2014-12-28 13:49:21'),
(276, 'mobileforget', '+989357269759', '2945', NULL, 14, 'yes', NULL, '2014-12-28 13:49:50'),
(365, 'mobileregister', '+989357269759', '9285', NULL, 150, 'no', '2014-12-30 12:17:28', NULL),
(366, 'mobileregister', '+989357269475', '8335', NULL, 151, 'no', '2014-12-30 12:26:49', NULL),
(367, 'mobileregister', '+989357269752', '5355', NULL, 152, 'no', '2014-12-30 13:24:12', NULL),
(368, 'mobileregister', '+989357269742', '9928', NULL, 153, 'no', '2014-12-30 13:58:16', NULL),
(369, 'mobileforget', '+989357269759', '5453', NULL, 150, 'no', NULL, NULL);

--
-- Triggers `verifications`
--
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
`id` int(10) unsigned NOT NULL,
  `visitor_ip` int(10) unsigned NOT NULL COMMENT 'use the INET_ATON() and INET_NTOA() functions to return the IP address from its numeric value, and vice versa.',
  `visitor_url` varchar(255) NOT NULL,
  `visitor_agent` varchar(255) NOT NULL,
  `visitor_referer` varchar(255) DEFAULT NULL,
  `visitor_robot` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `visitor_createdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=404 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`account_slug`), ADD UNIQUE KEY `cardnumber_unique` (`account_card`), ADD UNIQUE KEY `accountnumber_unique` (`account_number`), ADD KEY `bank_id` (`bank_id`), ADD KEY `accounts_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`addon_slug`) USING BTREE;

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name+type_unique` (`attachment_name`,`attachment_type`), ADD KEY `attachments_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`bank_slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `comments_posts_id` (`post_id`) USING BTREE, ADD KEY `comments_users_id` (`user_id`) USING BTREE, ADD KEY `comments_products_id` (`product_id`) USING BTREE, ADD KEY `comments_visitors_id` (`Visitor_id`);

--
-- Indexes for table `costcats`
--
ALTER TABLE `costcats`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`costcat_slug`), ADD KEY `type` (`costcat_type`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
 ADD PRIMARY KEY (`id`), ADD KEY `type_index` (`cost_type`) USING BTREE, ADD KEY `costs_costcats_id` (`costcat_id`) USING BTREE, ADD KEY `costs_accounts_id` (`account_id`) USING BTREE;

--
-- Indexes for table `errorlogs`
--
ALTER TABLE `errorlogs`
 ADD PRIMARY KEY (`id`), ADD KEY `errorlogs_users_id` (`user_id`) USING BTREE, ADD KEY `errorlogs_errors_id` (`errorlog_id`) USING BTREE;

--
-- Indexes for table `errors`
--
ALTER TABLE `errors`
 ADD PRIMARY KEY (`id`), ADD KEY `priotity_index` (`error_priority`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`fund_slug`), ADD KEY `funds_locations_id` (`location_id`) USING BTREE;

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`location_slug`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`), ADD KEY `status_index` (`notification_status`), ADD KEY `notifications_users_idsender` (`user_id_sender`) USING BTREE, ADD KEY `notifications_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cat+name+value` (`option_cat`,`option_name`,`option_value`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id+bankid_unique` (`id`,`bank_id`) USING BTREE, ADD KEY `bank_id` (`bank_id`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name+module_unique` (`permission_title`,`Permission_module`) USING BTREE;

--
-- Indexes for table `postmetas`
--
ALTER TABLE `postmetas`
 ADD PRIMARY KEY (`id`), ADD KEY `postmeta_posts_id` (`post_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug+catslug_unique` (`post_cat`,`post_slug`), ADD KEY `posts_users_id` (`user_id`) USING BTREE, ADD KEY `posts_attachments_id` (`attachment_id`) USING BTREE;

--
-- Indexes for table `productcats`
--
ALTER TABLE `productcats`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`productcat_slug`) USING BTREE, ADD KEY `productcats_attachments_id` (`attachment_id`) USING BTREE;

--
-- Indexes for table `productmetas`
--
ALTER TABLE `productmetas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `product+cat+name_unique` (`product_id`,`productmeta_cat`,`productmeta_name`) USING BTREE;

--
-- Indexes for table `productprices`
--
ALTER TABLE `productprices`
 ADD PRIMARY KEY (`id`), ADD KEY `startdate` (`productprice_startdate`), ADD KEY `enddate` (`productprice_enddate`), ADD KEY `productprices_products_id` (`product_id`) USING BTREE, ADD KEY `productprices_productmetas_id` (`productmeta_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`product_slug`) USING BTREE, ADD UNIQUE KEY `barcode_unique` (`product_barcode`) USING BTREE, ADD UNIQUE KEY `barcode2_unique` (`product_barcode2`) USING BTREE, ADD KEY `products_attachments_id` (`attachment_id`) USING BTREE, ADD KEY `products_productcats_id` (`productcat_id`) USING BTREE;

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `receipts_papers_id` (`paper_id`) USING BTREE, ADD KEY `receipts_transactions_id` (`transaction_id`) USING BTREE, ADD KEY `receipts_funds_id` (`fund_id`) USING BTREE, ADD KEY `receipts_users_id` (`user_id`), ADD KEY `receipts_users_idcustomer` (`user_id_customer`);

--
-- Indexes for table `smss`
--
ALTER TABLE `smss`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`term_slug`) USING BTREE;

--
-- Indexes for table `termusages`
--
ALTER TABLE `termusages`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `term+post_unique` (`term_id`,`post_id`) USING BTREE, ADD KEY `termusages_posts_id` (`post_id`) USING BTREE;

--
-- Indexes for table `transactiondetails`
--
ALTER TABLE `transactiondetails`
 ADD UNIQUE KEY `sale+product_unique` (`transaction_id`,`product_id`), ADD KEY `transactiondetails_products_id` (`product_id`) USING BTREE;

--
-- Indexes for table `transactionmetas`
--
ALTER TABLE `transactionmetas`
 ADD PRIMARY KEY (`id`), ADD KEY `transactionmetas_transactions_id` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`id`), ADD KEY `transactions_users_id` (`user_id`) USING BTREE, ADD KEY `transactions_users_idcustomer` (`user_id_customer`) USING BTREE;

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
 ADD PRIMARY KEY (`id`), ADD KEY `priority_index` (`userlog_priority`), ADD KEY `type_index` (`userlog_type`), ADD KEY `userlogs_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `usermetas`
--
ALTER TABLE `usermetas`
 ADD PRIMARY KEY (`id`), ADD KEY `usermeta_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mobile_unique` (`user_mobile`) USING BTREE, ADD UNIQUE KEY `email_unique` (`user_email`) USING BTREE, ADD KEY `users_permissions_id` (`permission_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code_unique` (`verification_url`,`verification_value`) USING BTREE, ADD KEY `verifications_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
 ADD PRIMARY KEY (`id`), ADD KEY `visitors_users_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'test comment',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `costcats`
--
ALTER TABLE `costcats`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `errorlogs`
--
ALTER TABLE `errorlogs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productcats`
--
ALTER TABLE `productcats`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productmetas`
--
ALTER TABLE `productmetas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `productprices`
--
ALTER TABLE `productprices`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `smss`
--
ALTER TABLE `smss`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `termusages`
--
ALTER TABLE `termusages`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactionmetas`
--
ALTER TABLE `transactionmetas`
MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `usermetas`
--
ALTER TABLE `usermetas`
MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'use char(36) if i want use uuid',AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=370;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=404;
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
-- Constraints for table `papers`
--
ALTER TABLE `papers`
ADD CONSTRAINT `papers_banks_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`);

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
ADD CONSTRAINT `receipts_funds_id` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`),
ADD CONSTRAINT `receipts_papers_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`),
ADD CONSTRAINT `receipts_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
ADD CONSTRAINT `receipts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `receipts_users_idcustomer` FOREIGN KEY (`user_id_customer`) REFERENCES `users` (`id`);

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
-- Constraints for table `transactionmetas`
--
ALTER TABLE `transactionmetas`
ADD CONSTRAINT `transactionmetas_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `usermetas`
--
ALTER TABLE `usermetas`
ADD CONSTRAINT `usermetas_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
ADD CONSTRAINT `visitors_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
