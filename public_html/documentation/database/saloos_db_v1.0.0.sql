-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2014 at 12:37 AM
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
-- Table structure for table `addons`
--

CREATE TABLE IF NOT EXISTS `addons` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(50) NOT NULL,
  `addon_slug` varchar(50) NOT NULL,
  `addon_desc` varchar(999) DEFAULT NULL,
  `addon_status` enum('active','deactive','expire','goingtoexpire') NOT NULL DEFAULT 'deactive',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` smallint(5) unsigned DEFAULT NULL COMMENT 'if comment for post',
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
  KEY `comments_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visitors_users_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_visitors_id` FOREIGN KEY (`Visitor_id`) REFERENCES `visitors` (`id`);

--
-- Constraints for table `errorlogs`
--
ALTER TABLE `errorlogs`
  ADD CONSTRAINT `errorlogs_errors_id` FOREIGN KEY (`errorlog_id`) REFERENCES `errors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `errorlogs_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `termusages`
--
ALTER TABLE `termusages`
  ADD CONSTRAINT `termusages_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `termusages_terms_id` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
