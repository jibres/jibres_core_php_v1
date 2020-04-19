CREATE DATABASE IF NOT EXISTS `jibres` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres`;

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`username` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`displayname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`gender` enum('male','female','company','rather not say') DEFAULT NULL,
`title` varchar(100) DEFAULT NULL,
`password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
`mobile` varchar(15) DEFAULT NULL,
`verifymobile` bit(1) DEFAULT NULL,
`email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`verifyemail` bit(1) DEFAULT NULL,
`status` enum('active','awaiting','deactive','removed','filter','unreachable') DEFAULT 'awaiting',
`avatar` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
`parent` int(10) UNSIGNED DEFAULT NULL,
`permission` varchar(200) DEFAULT NULL,
`type` varchar(100) DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`pin` smallint(4) UNSIGNED DEFAULT NULL,
`ref` int(10) UNSIGNED DEFAULT NULL,
`twostep` bit(1) DEFAULT NULL,
`subscribe` bit(1) DEFAULT NULL,
`birthday` varchar(50) DEFAULT NULL,
`unit_id` smallint(5) DEFAULT NULL,
`language` char(2) DEFAULT NULL,
`meta` mediumtext CHARACTER SET utf8mb4,
`website` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`facebook` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`twitter` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`instagram` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`linkedin` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`gmail` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`sidebar` bit(1) DEFAULT NULL,
`theme` varchar(100) DEFAULT NULL,
`firstname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`lastname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`bio` text CHARACTER SET utf8mb4,
`forceremember` bit(1) DEFAULT NULL,
`signature` text CHARACTER SET utf8mb4,
`father` varchar(100) DEFAULT NULL,
`nationalcode` varchar(50) DEFAULT NULL,
`nationality` varchar(5) DEFAULT NULL,
`pasportcode` varchar(50) DEFAULT NULL,
`pasportdate` varchar(20) DEFAULT NULL,
`marital` enum('single','married') DEFAULT NULL,
`foreign` bit(1) DEFAULT NULL,
`phone` varchar(100) DEFAULT NULL,
`detail` text CHARACTER SET utf8mb4,
PRIMARY KEY (`id`),
KEY `index_search_mobile` (`mobile`),
KEY `index_search_nationalcode` (`nationalcode`),
KEY `index_search_pasportcode` (`pasportcode`),
KEY `index_search_email` (`email`),
KEY `index_search_username` (`username`),
KEY `index_search_permission` (`permission`),
KEY `index_search_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `store` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`subdomain` varchar(50) NULL,
`fuel` varchar(150) NULL,
`creator` int(10) UNSIGNED NULL,
`ip` varchar(50) NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
KEY `store_subdomain` (`subdomain`)
) ENGINE=InnoDB AUTO_INCREMENT = 1000000 DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `store_data` (
`id` int(10) UNSIGNED NOT NULL,
`title` varchar(200) CHARACTER SET utf8mb4 NULL,
`owner` int(10) UNSIGNED NULL,
`description` text CHARACTER SET utf8mb4,
`lang` char(2) DEFAULT NULL,
`unit` varchar(50) DEFAULT NULL,
`country` varchar(50) DEFAULT NULL,
`domain1` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`domain2` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`domain3` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`status` enum('enable','disable','deleted','lock','awaiting','block','filter','close') NULL DEFAULT NULL,
`logo` varchar(2000) DEFAULT NULL,
`plan` varchar(50) DEFAULT NULL,
`startplan` timestamp NULL,
`expireplan` timestamp  NULL DEFAULT NULL,
`lastactivity` timestamp NULL DEFAULT NULL,
`dbversion` varchar(50) NULL,
`dbversiondate` datetime NULL,
`province` varchar(200) NULL DEFAULT NULL,
`city` varchar(200) NULL DEFAULT NULL,
`address` varchar(200) NULL DEFAULT NULL,
`mobile` varchar(200) NULL DEFAULT NULL,
`postcode` varchar(200) NULL DEFAULT NULL,
`phone` varchar(200) NULL DEFAULT NULL,
`fax` varchar(200) NULL DEFAULT NULL,
`companyeconomiccode` varchar(200) NULL DEFAULT NULL,
`companynationalid` varchar(200) NULL DEFAULT NULL,
`companyregisternumber` varchar(200) NULL DEFAULT NULL,
`ceonationalcode` varchar(200) NULL DEFAULT NULL,
`companyname` varchar(200) NULL DEFAULT NULL,
`currency` varchar(200) NULL DEFAULT NULL,
`length_unit` varchar(200) NULL DEFAULT NULL,
`mass_unit` varchar(200) NULL DEFAULT NULL,
`barcode` varchar(200) NULL DEFAULT NULL,
`scale` varchar(200) NULL DEFAULT NULL,
`tax_status` varchar(200) NULL DEFAULT NULL,
`tax_calc` varchar(200) NULL DEFAULT NULL,
`tax_calc_all_price` varchar(200) NULL DEFAULT NULL,
`tax_shipping` varchar(200) NULL DEFAULT NULL,
`shipping_status` varchar(200) NULL DEFAULT NULL,
`shipping_current_country` varchar(200) NULL DEFAULT NULL,
`shipping_current_country_value` varchar(200) NULL DEFAULT NULL,
`shipping_other_country` varchar(200) NULL DEFAULT NULL,
`shipping_other_country_value` varchar(200) NULL DEFAULT NULL,
`payment_online` varchar(200) NULL DEFAULT NULL,
`payment_check` varchar(200) NULL DEFAULT NULL,
`payment_bank` varchar(200) NULL DEFAULT NULL,
`payment_on_deliver` varchar(200) NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_data_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_data_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `store_analytics` (
`id` int(10) UNSIGNED NOT NULL,
`question1` smallint(3) UNSIGNED DEFAULT NULL,
`question2` smallint(3) UNSIGNED DEFAULT NULL,
`question3` smallint(3) UNSIGNED DEFAULT NULL,
`lastactivity` timestamp NULL DEFAULT NULL,
`lastchangesetting` timestamp NULL DEFAULT NULL,
`lastadminlogin` timestamp NULL DEFAULT NULL,
`laststafflogin` timestamp NULL DEFAULT NULL,
`lastsale` timestamp NULL DEFAULT NULL,
`lastbuy` timestamp NULL DEFAULT NULL,

`dbtrafic` bigint(20) UNSIGNED DEFAULT NULL,
`dbsize` bigint(20) UNSIGNED DEFAULT NULL,

`users` int(10) UNSIGNED DEFAULT NULL,
`customer` int(10) UNSIGNED DEFAULT NULL,
`staff` int(10) UNSIGNED DEFAULT NULL,

`agent` int(10) UNSIGNED DEFAULT NULL,
`session` int(10) UNSIGNED DEFAULT NULL,
`ticket` int(10) UNSIGNED DEFAULT NULL,
`ticket_message` int(10) UNSIGNED DEFAULT NULL,
`comment` int(10) UNSIGNED DEFAULT NULL,
`address` int(10) UNSIGNED DEFAULT NULL,
`news` int(10) UNSIGNED DEFAULT NULL,
`page` int(10) UNSIGNED DEFAULT NULL,
`post` int(10) UNSIGNED DEFAULT NULL,
`transaction` int(10) UNSIGNED DEFAULT NULL,
`term` int(10) UNSIGNED DEFAULT NULL,
`termusages` int(10) UNSIGNED DEFAULT NULL,
`sumplustransaction` bigint(20) UNSIGNED DEFAULT NULL,
`summinustransaction` bigint(20) UNSIGNED DEFAULT NULL,
`product` int(10) UNSIGNED DEFAULT NULL,
`factor` bigint(20) UNSIGNED DEFAULT NULL,
`factorbuy` bigint(20) UNSIGNED DEFAULT NULL,
`factorsale` bigint(20) UNSIGNED DEFAULT NULL,
`factordetail` bigint(20) UNSIGNED DEFAULT NULL,
`sumfactor` bigint(20) UNSIGNED DEFAULT NULL,
`planhistory` int(10) UNSIGNED DEFAULT NULL,
`help` int(10) UNSIGNED DEFAULT NULL,
`attachment` int(10) UNSIGNED DEFAULT NULL,
`tag` int(10) UNSIGNED DEFAULT NULL,
`cat` int(10) UNSIGNED DEFAULT NULL,
`support_tag` int(10) UNSIGNED DEFAULT NULL,
`help_tag` int(10) UNSIGNED DEFAULT NULL,
`user_mobile` int(10) UNSIGNED DEFAULT NULL,
`user_email` int(10) UNSIGNED DEFAULT NULL,
`user_chatid` int(10) UNSIGNED DEFAULT NULL,
`user_username` int(10) UNSIGNED DEFAULT NULL,
`user_android` int(10) UNSIGNED DEFAULT NULL,
`user_awaiting` int(10) UNSIGNED DEFAULT NULL,
`user_removed` int(10) UNSIGNED DEFAULT NULL,
`user_filter` int(10) UNSIGNED DEFAULT NULL,
`user_unreachabl` int(10) UNSIGNED DEFAULT NULL,
`user_permission` int(10) UNSIGNED DEFAULT NULL,

`log` bigint(20) UNSIGNED NULL DEFAULT NULL,
`cart` bigint(20) UNSIGNED NULL DEFAULT NULL,
`sync` bigint(20) UNSIGNED NULL DEFAULT NULL,
`apilog` bigint(20) UNSIGNED NULL DEFAULT NULL,

`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_analytics_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `store_plan` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`plan` varchar(100) DEFAULT NULL,
`start` timestamp NULL DEFAULT NULL,
`end` timestamp NULL DEFAULT NULL,
`type` enum('change','continuation','upgrade','downgrade','set','auto') DEFAULT NULL,
`description` varchar(500) NULL DEFAULT NULL,
`status` enum('enable','disable','deleted') DEFAULT NULL,
`price` int(10) UNSIGNED DEFAULT NULL,
`discount` int(10) UNSIGNED DEFAULT NULL,
`promo` varchar(100) DEFAULT NULL,
`period` enum('monthly','yearly') DEFAULT NULL,
`expireplan` timestamp NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `store_plan_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_plan_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `store_user` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NULL,
`creator` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`customer` enum('yes','no') DEFAULT NULL,
`staff` enum('yes','no') DEFAULT NULL,
`supplier` enum('yes','no') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `store_user_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_user_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `store_file` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED DEFAULT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`md5` char(32) DEFAULT NULL,
`filename` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
`type` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`mime` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`ext` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`folder` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`path` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
`size` int(10) UNSIGNED DEFAULT NULL,
`status` enum('draft','awaiting','publish','block','filter','removed', 'spam') DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `store_files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
KEY `files_md5_search` (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `store_app` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED  NULL DEFAULT NULL,
`version` smallint(5) UNSIGNED NULL DEFAULT NULL,
`status` enum('queue','inprogress','done','failed', 'disable', 'expire', 'cancel', 'delete', 'enable') DEFAULT NULL,
`daterequest` timestamp NULL DEFAULT NULL,
`datequeue` timestamp NULL DEFAULT NULL,
`datedone` timestamp NULL DEFAULT NULL,
`file`  varchar(500)   NULL DEFAULT NULL,
`build`  int(10) unsigned   NULL DEFAULT NULL,
`meta`  text   NULL DEFAULT NULL,
`versiontitle`  varchar(50)     NULL DEFAULT NULL,
`versionnumber` int(10) unsigned   NULL DEFAULT NULL,
`packagename`   varchar(200)    NULL DEFAULT NULL,
`keystore`     varchar(50)      NULL DEFAULT NULL,
`path`   varchar(200)     NULL DEFAULT NULL,
`datedownload` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `index_search_store_app_status` (`status`),
CONSTRAINT `store_app_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `store_domain` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`domain` varchar(100) DEFAULT NULL,
`subdomain` varchar(100) DEFAULT NULL,
`root` varchar(100) DEFAULT NULL,
`tld` varchar(100) DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `index_search_domain` (`domain`),
CONSTRAINT `store_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_domain_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `setting` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`platform` enum('android','ios','telegram','website') DEFAULT NULL,
`lang` char(2) DEFAULT NULL,
`cat` varchar(50) DEFAULT NULL,
`key` varchar(50) DEFAULT NULL,
`value` text,
PRIMARY KEY (`id`),
KEY `setting_index_search_cat` (`cat`),
KEY `setting_index_search_key` (`key`),
KEY `setting_index_search_lang` (`lang`),
KEY `setting_index_search_platform` (`platform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `address` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
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
  CONSTRAINT `address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `seotitle` varchar(500) DEFAULT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `url` varchar(190) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4,
  `subtitle` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `excerpt` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `type` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'post',
  `subtype` varchar(100) CHARACTER SET utf8mb4 NULL,
  `special` varchar(100) DEFAULT NULL,
  `comment` enum('open','closed') DEFAULT NULL,
  `status` enum('publish','draft','schedule','deleted','expire') NOT NULL DEFAULT 'draft',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  UNIQUE KEY `url_unique` (`url`,`language`) USING BTREE,
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`),
  KEY `index_search_language` (`language`),
  KEY `index_search_publishdate` (`publishdate`),
  KEY `index_search_url` (`url`),
  KEY `index_search_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `terms_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `terms_type_search_index` (`type`),
  KEY `index_search_slug` (`slug`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `termusages` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `related_id` bigint(20) UNSIGNED NOT NULL,
  `related` enum('posts','products','attachments','files','comments','users','tickets') DEFAULT NULL,
  `order` smallint(5) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other','deleted') NOT NULL DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('cat','tag','term','code','other','support_tag','mag','mag_tag','help','help_tag','barcode1','barcode2','barcode3','qrcode1','qrcode2','qrcode3','rfid1','rfid2','rfid3','fingerprint1','fingerprint2','fingerprint3','fingerprint4','fingerprint5','fingerprint6','fingerprint7','fingerprint8','fingerprint9','fingerprint10') DEFAULT NULL,
  KEY `termusages_related_id` (`related_id`),
  KEY `termusages_related` (`related`),
  KEY `termusages_status` (`status`),
  KEY `termusages_related_id_search_index` (`related_id`),
  KEY `termusages_related_search_index` (`related`),
  KEY `termusages_type_search_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







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
  CONSTRAINT `newtransactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  KEY `transactions_index_token` (`token`),
  KEY `transactions_index_banktoken` (`banktoken`),
  KEY `transactions_index_payment` (`payment`),
  KEY `transactions_index_dateverify` (`dateverify`),
  KEY `transactions_index_verify` (`verify`),
  KEY `transactions_index_plus` (`plus`),
  KEY `transactions_index_minus` (`minus`),
  KEY `index_search_condition` (`condition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `minus` int(10) UNSIGNED DEFAULT NULL,
  `plus` int(10) UNSIGNED DEFAULT NULL,
  `star` smallint(5) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `index_search_star` (`star`),
  KEY `index_search_minus` (`minus`),
  KEY `index_search_plus` (`plus`),
  KEY `index_search_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `user_android` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `uniquecode` char(32) NOT NULL,
  `osversion` varchar(200) DEFAULT NULL,
  `version` varchar(200) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `language` char(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting') DEFAULT NULL,
  `meta` text CHARACTER SET utf8mb4,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_android_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `user_auth` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `auth` char(32) NOT NULL,
  `status` enum('enable','disable','expire','used') DEFAULT NULL,
  `gateway` enum('android','ios','api') DEFAULT NULL,
  `type` enum('guest','member','appkey') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gateway_id` int(10) UNSIGNED DEFAULT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  KEY `index_search_auth` (`auth`),
  KEY `index_search_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `user_telegram` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `chatid` bigint(20) NOT NULL,
  `firstname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lastname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `language` char(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting','inline','callback') DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_tg_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  KEY `index_search_chatid` (`chatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `plus` int(10) UNSIGNED DEFAULT NULL,
  `answertime` int(10) UNSIGNED DEFAULT NULL,
  `solved` bit(1) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  `see` bit(1) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `tickets_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `files` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`creator` int(10) UNSIGNED DEFAULT NULL,
`md5` char(32) DEFAULT NULL,
`filename` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
`type` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`mime` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`ext` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`folder` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`path` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
`size` int(10) UNSIGNED DEFAULT NULL,
`status` enum('awaiting','publish','block','filter','removed', 'spam') DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `files_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
KEY `files_md5_search` (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `fileusage` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`file_id` int(10) UNSIGNED DEFAULT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`title` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
`alt` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`related` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`related_id` int(10) UNSIGNED DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `fileuseage_related_search` (`related`),
KEY `fileuseage_related_id_search` (`related_id`),
CONSTRAINT `fileusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fileusage_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `sync` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(200) DEFAULT NULL,
`query` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`fuel` varchar(100) DEFAULT NULL,
`database` varchar(100) DEFAULT NULL,
`status` enum('pending','awaiting','success','fail','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `index_search_sync_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `store_timeline` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NULL,

`login` datetime NULL,
`login_diff` int(10) UNSIGNED NULL,

`start` datetime NULL,
`start_diff` int(10) UNSIGNED NULL,

`ask` datetime NULL,
`ask_diff` int(10) UNSIGNED NULL,

`subdomain` datetime NULL,
`subdomain_diff` int(10) UNSIGNED NULL,

`creating` datetime NULL,
`creating_diff` int(10) UNSIGNED NULL,

`startcreate` datetime NULL,
`startcreate_diff` int(10) UNSIGNED NULL,

`endcreate` datetime NULL,
`endcreate_diff` int(10) UNSIGNED NULL,

`opening` datetime NULL,
`opening_diff` int(10) UNSIGNED NULL,

`loadstore` datetime NULL,
`loadstore_diff` int(10) UNSIGNED NULL,

`users` datetime NULL,
`productcompany` datetime NULL,
`productunit` datetime NULL,
`products` datetime NULL,
`factors` datetime NULL,
`factordetails` datetime NULL,
`funds` datetime NULL,
`inventory` datetime NULL,
`productcategory` datetime NULL,
`productcomment` datetime NULL,
`productprices` datetime NULL,
`productproperties` datetime NULL,
`producttag` datetime NULL,
`producttagusage` datetime NULL,
`files` datetime NULL,
`fileusage` datetime NULL,
`agents` datetime NULL,
`apilog` datetime NULL,

PRIMARY KEY (`id`),
CONSTRAINT `store_timeline_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `userdetail` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`creator` int(10) UNSIGNED NULL,
`status` enum('enable','disable','filter','spam','delete') NULL DEFAULT 'enable',
`text` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datecreated` timestamp DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `userdetail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `userdetail_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `apilog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `apikey` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `appkey` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `zoneid` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `method` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `header` mediumtext CHARACTER SET utf8mb4,
  `headerlen` int(10) UNSIGNED DEFAULT NULL,
  `body` mediumtext CHARACTER SET utf8mb4,
  `bodylen` int(10) UNSIGNED DEFAULT NULL,
  `datesend` timestamp NULL DEFAULT NULL,
  `pagestatus` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `resultstatus` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `responseheader` mediumtext CHARACTER SET utf8mb4,
  `responsebody` mediumtext CHARACTER SET utf8mb4,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `responselen` int(10) UNSIGNED DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `urlmd5` char(32) DEFAULT NULL,
  `notif` mediumtext CHARACTER SET utf8mb4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `dayevent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `countcalc` int(10) UNSIGNED DEFAULT NULL,
  `dbtrafic` int(10) UNSIGNED DEFAULT NULL,
  `dbsize` int(10) UNSIGNED DEFAULT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `activeuser` int(10) UNSIGNED DEFAULT NULL,
  `deactiveuser` int(10) UNSIGNED DEFAULT NULL,
  `log` int(10) UNSIGNED DEFAULT NULL,
  `visitor` int(10) UNSIGNED DEFAULT NULL,
  `agent` int(10) UNSIGNED DEFAULT NULL,
  `session` int(10) UNSIGNED DEFAULT NULL,
  `urls` int(10) UNSIGNED DEFAULT NULL,
  `ticket` int(10) UNSIGNED DEFAULT NULL,
  `comment` int(10) UNSIGNED DEFAULT NULL,
  `address` int(10) UNSIGNED DEFAULT NULL,
  `news` int(10) UNSIGNED DEFAULT NULL,
  `page` int(10) UNSIGNED DEFAULT NULL,
  `post` int(10) UNSIGNED DEFAULT NULL,
  `transaction` int(10) UNSIGNED DEFAULT NULL,
  `term` int(10) UNSIGNED DEFAULT NULL,
  `termusages` int(10) UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `help` int(10) UNSIGNED DEFAULT NULL,
  `attachment` int(10) UNSIGNED DEFAULT NULL,
  `tag` int(10) UNSIGNED DEFAULT NULL,
  `cat` int(10) UNSIGNED DEFAULT NULL,
  `support_tag` int(10) UNSIGNED DEFAULT NULL,
  `help_tag` int(10) UNSIGNED DEFAULT NULL,
  `user_mobile` int(10) UNSIGNED DEFAULT NULL,
  `user_email` int(10) UNSIGNED DEFAULT NULL,
  `user_chatid` int(10) UNSIGNED DEFAULT NULL,
  `user_username` int(10) UNSIGNED DEFAULT NULL,
  `user_android` int(10) UNSIGNED DEFAULT NULL,
  `user_awaiting` int(10) UNSIGNED DEFAULT NULL,
  `user_removed` int(10) UNSIGNED DEFAULT NULL,
  `user_filter` int(10) UNSIGNED DEFAULT NULL,
  `user_unreachabl` int(10) UNSIGNED DEFAULT NULL,
  `user_permission` int(10) UNSIGNED DEFAULT NULL,
  `ticket_message` int(10) UNSIGNED DEFAULT NULL,
  `userdetail` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caller` varchar(200) DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `send` bit(1) DEFAULT NULL,
  `to` int(10) UNSIGNED DEFAULT NULL,
  `notif` bit(1) DEFAULT NULL,
  `from` int(10) UNSIGNED DEFAULT NULL,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `readdate` timestamp NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4,
  `status` enum('enable','disable','expire','deliver','awaiting','deleted','cancel','block','notif','notifread','notifexpire') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `sms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `telegram` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `expiredate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','terminate','expire','disable','changed','logout') NOT NULL DEFAULT 'active',
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `count` int(10) UNSIGNED DEFAULT '1',
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_seen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `telegrams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chatid` bigint(20) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `step` text CHARACTER SET utf8mb4,
  `hook` mediumtext CHARACTER SET utf8mb4,
  `hooktext` text CHARACTER SET utf8mb4,
  `hookdate` datetime DEFAULT NULL,
  `hookmessageid` text CHARACTER SET utf8mb4,
  `send` mediumtext CHARACTER SET utf8mb4,
  `senddate` datetime DEFAULT NULL,
  `sendtext` text CHARACTER SET utf8mb4,
  `sendmesageid` text CHARACTER SET utf8mb4,
  `sendmethod` text CHARACTER SET utf8mb4,
  `sendkeyboard` text CHARACTER SET utf8mb4,
  `response` mediumtext CHARACTER SET utf8mb4,
  `responsedate` datetime DEFAULT NULL,
  `status` enum('enable','disable','ok','failed','other') DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `send2` mediumtext CHARACTER SET utf8mb4,
  `response2` mediumtext CHARACTER SET utf8mb4,
  `send3` mediumtext CHARACTER SET utf8mb4,
  `response3` mediumtext CHARACTER SET utf8mb4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `urlmd5` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `domain` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `subdomain` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `path` text CHARACTER SET utf8mb4,
  `query` text CHARACTER SET utf8mb4,
  `pwd` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `statuscode` int(5) DEFAULT NULL,
  `visitor_ip` int(10) UNSIGNED DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `url_id` int(10) UNSIGNED NOT NULL,
  `url_idreferer` int(10) UNSIGNED DEFAULT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` timestamp NOT NULL,
  `avgtime` int(10) UNSIGNED DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_agentmd5` (`agentmd5`);


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


ALTER TABLE `dayevent`
  ADD PRIMARY KEY (`id`);



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
  ADD KEY `index_search_datecreated` (`datecreated`);


ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`code`) USING BTREE,
  ADD KEY `sessions_user_id` (`user_id`),
  ADD KEY `index_search_code` (`code`),
  ADD KEY `index_search_user_id` (`user_id`),
  ADD KEY `index_search_status` (`status`),
  ADD KEY `index_search_agent_id` (`agent_id`);


ALTER TABLE `telegrams`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urlmd5_index` (`urlmd5`);


ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_agents` (`agent_id`),
  ADD KEY `visitors_urls` (`url_id`),
  ADD KEY `visitors_urls_referer` (`url_idreferer`);




ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `apilog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `dayevent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `telegrams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `urls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;




ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE;


ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_agents` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_urls` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_urls_referer` FOREIGN KEY (`url_idreferer`) REFERENCES `urls` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;


  CREATE TABLE IF NOT EXISTS `pardakhtyar_request` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`trackingNumber`			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`trackingNumberPsp`			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestRejectionReasons`	mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`success`					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`sendmd5`					char(32) NULL DEFAULT NULL,
`responsemd5`				char(32) NULL DEFAULT NULL,
`send`						mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`response`					mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`url`						text CHARACTER SET utf8mb4 DEFAULT NULL,
`sendtime`					int(10) unsigned NULL DEFAULT NULL,
`responsetime`				int(10) unsigned NULL DEFAULT NULL,
`diff`						int(10) unsigned NULL DEFAULT NULL,
CONSTRAINT `request_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `pardakhtyar_check` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`request_id`				bigint(20) unsigned  NULL,
`user_id`					int(10) unsigned DEFAULT NULL,
`sendmd5`					char(32) NULL DEFAULT NULL,
`responsemd5`				char(32) NULL DEFAULT NULL,
`trackingNumber` 			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`trackingNumberPsp` 		varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestDate` 				varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`description` 				varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestType` 				varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`merchant` 					mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`relatedMerchants` 			varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`requestRejectionReasons` 	mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`requestDetails` 			mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`status` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`send`						mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`response`					mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
`url`						text CHARACTER SET utf8mb4 DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`sendtime`					int(10) unsigned NULL DEFAULT NULL,
`responsetime`				int(10) unsigned NULL DEFAULT NULL,
`diff`						int(10) unsigned NULL DEFAULT NULL,
CONSTRAINT `check_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `check_request_id` FOREIGN KEY (`request_id`) REFERENCES `pardakhtyar_request` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `pardakhtyar_customer` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`trackingNumber`			varchar(50) NULL DEFAULT NULL,
`trackingNumberPsp`			varchar(50) NULL DEFAULT NULL,
`requestType`				varchar(50) NULL DEFAULT NULL,
`status`					varchar(50) NULL DEFAULT NULL,
`createby` 					varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`firstNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`lastNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`fatherNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`firstNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`lastNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`fatherNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`gender` 					smallint(2) NULL DEFAULT NULL,
`birthDate`					date NULL DEFAULT NULL,
`registerDate` 				date NULL DEFAULT NULL,
`nationalCode` 				char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`registerNumber` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`comNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`comNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`merchantType` 				smallint(2) NULL DEFAULT NULL,
`residencyType` 			smallint(2) NULL DEFAULT NULL,
`vitalStatus` 				smallint(2) NULL DEFAULT NULL,
`birthCrtfctNumber` 		varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`birthCrtfctSerial` 		char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`birthCrtfctSeriesLetter` 	smallint(2) NULL DEFAULT NULL,
`birthCrtfctSeriesNumber` 	smallint(2) NULL DEFAULT NULL,
`nationalLegalCode` 		char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`commercialCode` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`countryCode` 				char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`foreignPervasiveCode` 		varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`passportNumber` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`passportExpireDate` 		date NULL DEFAULT NULL,
`Description` 				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`telephoneNumber` 			varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`cellPhoneNumber` 			char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`emailAddress` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`webSite` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`fax` 						varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `customer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `customer_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


ALTER TABLE `pardakhtyar_check` ADD `table` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;


CREATE TABLE IF NOT EXISTS `pardakhtyar_shop` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`customer_id`				bigint(20) unsigned DEFAULT NULL,
`farsiName`					varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`englishName`				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`telephoneNumber`			varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`postalCode`				char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessCertificateNumber`	varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`certificateIssueDate`		datetime NULL DEFAULT NULL,
`certificateExpiryDate`		datetime NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessCategoryCode`		char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessSubCategoryCode`	varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`ownershipType`				smallint(2) NULL DEFAULT NULL,
`rentalContractNumber`		varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`rentalExpiryDate`			datetime NULL DEFAULT NULL,
`Address`					varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`countryCode`				char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`provinceCode`				char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`cityCode`					char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessType`				smallint(2) NULL DEFAULT NULL,
`etrustCertificateType`		smallint(2) NULL DEFAULT NULL,
`etrustCertificateIssueDate` datetime NULL DEFAULT NULL,
`etrustCertificateExpiryDate` datetime NULL DEFAULT NULL,
`emailAddress`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`websiteAddress`			varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `shop_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `shop_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `shop_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `pardakhtyar_customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `pardakhtyar_acceptor` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`customer_id`				bigint(20) unsigned DEFAULT NULL,
`iin`						varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`acceptorCode`				char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`acceptorType`				smallint(2) NULL DEFAULT NULL,
`facilitatorAcceptorCode`	char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`cancelable`				bit(1) NULL DEFAULT NULL,
`refundable`				bit(1) NULL DEFAULT NULL,
`blockable`					bit(1) NULL DEFAULT NULL,
`chargeBackable`			bit(1) NULL DEFAULT NULL,
`settledSeparately`			bit(1) NULL DEFAULT NULL,
`allowScatteredSettlement`	smallint(2) NULL DEFAULT NULL,
`acceptCreditCardTransaction` bit(1) NULL DEFAULT NULL,
`allowIranianProductsTrx`	bit(1) NULL DEFAULT NULL,
`allowKaraCardTrx`			bit(1) NULL DEFAULT NULL,
`allowGoodsBasketTrx`		bit(1) NULL DEFAULT NULL,
`allowFoodSecurityTrx`		bit(1) NULL DEFAULT NULL,
`allowJcbCardTrx`			bit(1) NULL DEFAULT NULL,
`allowUpiCardTrx`			bit(1) NULL DEFAULT NULL,
`allowVisaCardTrx`			bit(1) NULL DEFAULT NULL,
`allowMasterCardTrx`		bit(1) NULL DEFAULT NULL,
`allowAmericanExpressTrx`	bit(1) NULL DEFAULT NULL,
`allowOtherInternationaCardsTrx` bit(1) NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `acceptor_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `acceptor_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `acceptor_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `pardakhtyar_customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `pardakhtyar_terminal` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`customer_id`				bigint(20) unsigned DEFAULT NULL,
`sequence` 					bigint(20) NULL DEFAULT NULL,
`terminalNumber` 			char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`terminalType` 				smallint(2) NULL DEFAULT NULL,
`serialNumber` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`setupDate` 				datetime NULL DEFAULT NULL,
`hardwareBrand` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`hardwareModel` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`accessAddress` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`accessPort` 				int(5) NULL DEFAULT NULL,
`callbackAddress` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`callbackPort` 				int(5) NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `terminal_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `terminal_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `terminal_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `pardakhtyar_customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS `pardakhtyar_merchantIbans` (
`id`				bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`			int(10) unsigned DEFAULT NULL,
`creator`			int(10) unsigned DEFAULT NULL,
`customer_id`		bigint(20) unsigned DEFAULT NULL,
`merchantIban` 		varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`Description`		varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`		timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`		timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `merchantIbans_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `merchantIbans_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `merchantIbans_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `pardakhtyar_customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS jibres.gift (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`giftpercent` smallint(5) UNSIGNED NULL,
`giftamount` bigint(20) UNSIGNED NULL,
`giftmax` bigint(20) UNSIGNED NULL,
`pricefloor` bigint(20) UNSIGNED NULL,
`desc` text NULL DEFAULT NULL,
`creator` int(10) UNSIGNED NULL,
`usagetotal` int(10) UNSIGNED NULL,
`usageperuser` smallint(5) UNSIGNED NULL,
`code` varchar(100) NULL DEFAULT NULL,
`category` varchar(100) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`datefirstuse` timestamp NULL DEFAULT NULL,
`datefinish` timestamp NULL DEFAULT NULL,
`status` enum('draft', 'enable', 'disable', 'deleted', 'expire', 'blocked') NULL DEFAULT NULL,
`usagestatus` enum('used', 'full') NULL DEFAULT NULL,
`forusein` enum('any', 'domain', 'store', 'sms', 'ipg') NULL DEFAULT NULL,
`emailto` text NULL DEFAULT NULL,
`emailtemplate` varchar(100) NULL DEFAULT NULL,
`msgsuccess` text NULL DEFAULT NULL,
`forfirstorder` bit(1) NULL DEFAULT NULL,
`dedicated` text NULL DEFAULT NULL,
`physical` bit(1) NULL,
`chap` bit(1) NULL,
PRIMARY KEY (`id`),
KEY `gift_index_search_code` (`code`),
KEY `gift_index_search_status` (`status`),
CONSTRAINT `gift_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres.giftusage (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`gift_id` bigint(20) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`transaction_id` bigint(20) UNSIGNED NULL,
`price` bigint(20) UNSIGNED NULL,
`discount` bigint(20) UNSIGNED NULL,
`discountpercent` smallint(5) UNSIGNED NULL,
`finalprice` bigint(20) UNSIGNED NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `giftusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `giftusage_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE,
CONSTRAINT `giftusage_gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
