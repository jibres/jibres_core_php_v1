CREATE TABLE `store` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subdomain` varchar(50) NOT NULL,
  `dbname` varchar(15) NULL,
  `dbip` int(10) UNSIGNED NULL,
  `creator` int(10) UNSIGNED NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `store_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `owner` int(10) UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8mb4,
  `lang` char(2) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `domain1` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
  `domain2` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
  `domain3` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
  `status` enum('enable','disable','expire','deleted','lock','awaiting','block','filter','close') NOT NULL DEFAULT 'enable',
  `logo` varchar(2000) DEFAULT NULL,
  `plan` varchar(50) DEFAULT NULL,
  `startplan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expireplan` datetime DEFAULT NULL,
  `lastactivity` datetime DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE `store_analytics` (
  `id` int(10) UNSIGNED NOT NULL,
  `lastactivity` date DEFAULT NULL,
  `dbtrafic` int(10) UNSIGNED DEFAULT NULL,
  `dbsize` int(10) UNSIGNED DEFAULT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `activeuser` int(10) UNSIGNED DEFAULT NULL,
  `deactiveuser` int(10) UNSIGNED DEFAULT NULL,
  `log` int(10) UNSIGNED DEFAULT NULL,
  `visitor` int(10) UNSIGNED DEFAULT NULL,
  `agent` int(10) UNSIGNED DEFAULT NULL,
  `session` int(10) UNSIGNED DEFAULT NULL,
  `ticket` int(10) UNSIGNED DEFAULT NULL,
  `comment` int(10) UNSIGNED DEFAULT NULL,
  `address` int(10) UNSIGNED DEFAULT NULL,
  `news` int(10) UNSIGNED DEFAULT NULL,
  `page` int(10) UNSIGNED DEFAULT NULL,
  `post` int(10) UNSIGNED DEFAULT NULL,
  `transaction` int(10) UNSIGNED DEFAULT NULL,
  `term` int(10) UNSIGNED DEFAULT NULL,
  `termusages` int(10) UNSIGNED DEFAULT NULL,
  `storetransaction` int(10) UNSIGNED DEFAULT NULL,
  `sumplustransaction` int(10) UNSIGNED DEFAULT NULL,
  `summinustransaction` int(10) UNSIGNED DEFAULT NULL,
  `userstore` int(10) UNSIGNED DEFAULT NULL,
  `product` int(10) UNSIGNED DEFAULT NULL,
  `factordetail` int(10) UNSIGNED DEFAULT NULL,
  `factor` int(10) UNSIGNED DEFAULT NULL,
  `sumfactor` int(10) UNSIGNED DEFAULT NULL,
  `fund` int(10) UNSIGNED DEFAULT NULL,
  `inventory` int(10) UNSIGNED DEFAULT NULL,
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
  `ticket_message` int(10) UNSIGNED DEFAULT NULL,
  `userdetail` int(10) UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `store_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `creator` int(10) UNSIGNED DEFAULT NULL,
  `plan` varchar(100) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `type` enum('change','continuation','upgrade','downgrade','first_year','set','auto') DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `discount` int(10) UNSIGNED DEFAULT NULL,
  `promo` varchar(100) DEFAULT NULL,
  `period` enum('monthly','yearly') DEFAULT NULL
  `expireplan` datetime DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



