CREATE TABLE IF NOT EXISTS `address` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subdomain` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `company` bit(1) DEFAULT NULL,
  `companyname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jobtitle` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `country` char(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  `province` varchar(6) CHARACTER SET utf8mb4 DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `address2` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `postcode` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('enable','disable','filter','leave','spam','delete') DEFAULT 'enable',
  `favorite` bit(1) DEFAULT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `latitude` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `longitude` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `map` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `address_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--


CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `minus` int(10) UNSIGNED DEFAULT NULL,
  `plus` int(10) UNSIGNED DEFAULT NULL,
  `star` smallint(5) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `answertime` int(10) UNSIGNED DEFAULT NULL,
  `subdomain` varchar(200) DEFAULT NULL,
  `solved` bit(1) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_posts_id` (`post_id`) USING BTREE,
  KEY `comments_users_id` (`user_id`) USING BTREE,
  KEY `comments_visitors_id` (`visitor_id`),
  KEY `index_search_subdomain` (`subdomain`),
  KEY `index_search_star` (`star`),
  KEY `index_search_minus` (`minus`),
  KEY `index_search_plus` (`plus`),
  KEY `index_search_post_id` (`post_id`),
  KEY `index_search_user_id` (`user_id`),
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--


CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `md5` char(32) DEFAULT NULL,
  `filename` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4,
  `useage` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `type` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `mime` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ext` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `folder` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `path` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('draft','awaiting','publish','block','filter','removed') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `files_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--


CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `user_id_seller` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `temp` bit(1) DEFAULT NULL,
  `title` varchar(500) NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  `total_discount` int(10) DEFAULT NULL,
  `status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_pay` datetime DEFAULT NULL,
  `transaction_bank` varchar(255) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `vat` int(10) DEFAULT NULL,
  `vat_pay` int(10) DEFAULT NULL,
  `final_total` bigint(20) DEFAULT NULL,
  `count_detail` smallint(5) UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `desc` text CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  PRIMARY KEY (`id`),
  KEY `inovoices_user_id` (`user_id`),
  KEY `inovoices_user_id_seller` (`user_id_seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--


CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(500) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `count` smallint(5) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `discount` smallint(5) DEFAULT NULL,
  `status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `desc` text CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  PRIMARY KEY (`id`),
  KEY `inovoices_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--


CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cat` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `key` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `value` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_cat` (`key`) USING BTREE,
  KEY `options_users_id` (`user_id`),
  KEY `options_posts_id` (`post_id`),
  KEY `options_parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--


CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `seotitle` varchar(500) DEFAULT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `type` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'post',
  `special` varchar(100) DEFAULT NULL,
  `comment` enum('open','closed') DEFAULT NULL,
  `count` smallint(5) UNSIGNED DEFAULT NULL,
  `order` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('publish','draft','schedule','deleted','expire') NOT NULL DEFAULT 'draft',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subtitle` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `excerpt` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_unique` (`url`,`language`) USING BTREE,
  KEY `posts_users_id` (`user_id`) USING BTREE,
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`),
  KEY `index_search_language` (`language`),
  KEY `index_search_publishdate` (`publishdate`),
  KEY `index_search_url` (`url`),
  KEY `index_search_slug` (`slug`),
  KEY `index_search_subdomain` (`subdomain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--


CREATE TABLE IF NOT EXISTS `terms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `type` enum('cat','tag','code','other','term','support_tag','mag','mag_tag','help','help_tag') DEFAULT NULL,
  `caller` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `desc` mediumtext CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other') NOT NULL DEFAULT 'awaiting',
  `count` int(10) UNSIGNED DEFAULT NULL,
  `usercount` int(10) UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excerpt` varchar(300) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `terms_users_id` (`user_id`),
  KEY `terms_type_search_index` (`type`),
  KEY `index_search_slug` (`slug`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--


CREATE TABLE IF NOT EXISTS `termusages` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `related_id` bigint(20) UNSIGNED NOT NULL,
  `related` enum('posts','products','attachments','files','comments','users','tickets') DEFAULT NULL,
  `order` smallint(5) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other','deleted') NOT NULL DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('cat','tag','term','code','other','support_tag','mag','mag_tag','help','help_tag','barcode1','barcode2','barcode3','qrcode1','qrcode2','qrcode3','rfid1','rfid2','rfid3','fingerprint1','fingerprint2','fingerprint3','fingerprint4','fingerprint5','fingerprint6','fingerprint7','fingerprint8','fingerprint9','fingerprint10') DEFAULT NULL,
  KEY `term_id` (`term_id`),
  KEY `related_id` (`related_id`),
  KEY `related` (`related`),
  KEY `status` (`status`),
  KEY `termusages_term_id_search_index` (`term_id`),
  KEY `termusages_related_id_search_index` (`related_id`),
  KEY `termusages_related_search_index` (`related`),
  KEY `termusages_type_search_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--


CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `minus` int(10) UNSIGNED DEFAULT NULL,
  `plus` int(10) UNSIGNED DEFAULT NULL,
  `star` smallint(5) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `answertime` int(10) UNSIGNED DEFAULT NULL,
  `subdomain` varchar(200) DEFAULT NULL,
  `solved` bit(1) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  `see` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_posts_id` (`post_id`) USING BTREE,
  KEY `tickets_users_id` (`user_id`) USING BTREE,
  KEY `tickets_visitors_id` (`visitor_id`),
  KEY `index_search_subdomain` (`subdomain`),
  KEY `index_search_star` (`star`),
  KEY `index_search_minus` (`minus`),
  KEY `index_search_plus` (`plus`),
  KEY `index_search_post_id` (`post_id`),
  KEY `index_search_user_id` (`user_id`),
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--


CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `code` smallint(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caller` varchar(100) DEFAULT NULL,
  `type` enum('gift','prize','transfer','promo','money') NOT NULL,
  `unit_id` smallint(3) NOT NULL,
  `amount_request` bigint(20) DEFAULT NULL,
  `amount_end` bigint(20) DEFAULT NULL,
  `plus` bigint(20) UNSIGNED DEFAULT NULL,
  `minus` bigint(20) UNSIGNED DEFAULT NULL,
  `budget_before` bigint(20) DEFAULT NULL,
  `budget` bigint(20) DEFAULT NULL,
  `status` enum('enable','disable','deleted','expired','awaiting','filtered','blocked','spam') NOT NULL DEFAULT 'enable',
  `condition` enum('request','redirect','cancel','pending','error','verify_request','verify_error','ok') DEFAULT NULL,
  `verify` bit(1) NOT NULL DEFAULT b'0',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `related_user_id` int(10) UNSIGNED DEFAULT NULL,
  `related_foreign` varchar(50) DEFAULT NULL,
  `related_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `payment_response` text CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `desc` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dateverify` int(10) UNSIGNED DEFAULT NULL,
  `payment_response1` text CHARACTER SET utf8mb4,
  `payment_response2` text CHARACTER SET utf8mb4,
  `payment_response3` text CHARACTER SET utf8mb4,
  `payment_response4` text CHARACTER SET utf8mb4,
  `token` varchar(32) DEFAULT NULL,
  `banktoken` varchar(100) DEFAULT NULL,
  `finalmsg` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `newtransactions_user_id` (`user_id`),
  KEY `transactions_index_token` (`token`),
  KEY `transactions_index_banktoken` (`banktoken`),
  KEY `transactions_index_payment` (`payment`),
  KEY `transactions_index_dateverify` (`dateverify`),
  KEY `transactions_index_verify` (`verify`),
  KEY `transactions_index_plus` (`plus`),
  KEY `transactions_index_minus` (`minus`),
  KEY `index_search_condition` (`condition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `inovoices_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inovoices_user_id_seller` FOREIGN KEY (`user_id_seller`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `inovoices_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `options` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `options_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
  ADD CONSTRAINT `terms_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `newtransactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
