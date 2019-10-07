
CREATE TABLE `servers` (
`id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(200) NULL,
`ip` int(10) UNSIGNED NULL,
`cpu` varchar(50) NULL,
`ram` varchar(50) NULL,
`hard` varchar(50) NULL,
`isp` varchar(50) NULL,
`datacenter` varchar(50) NULL,
`type` enum('code','db','file','other') NULL DEFAULT NULL,
`first` enum('yes','no') NULL DEFAULT NULL,
`status` enum('enable','disable','deleted','lock') NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `store` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`subdomain` varchar(50) NULL,
`dbname` varchar(15) NULL,
`server_id` smallint(5) UNSIGNED NULL,
`creator` int(10) UNSIGNED NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_server_id` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON UPDATE CASCADE,
KEY `store_subdomain` (`subdomain`)
) ENGINE=InnoDB AUTO_INCREMENT = 1000000 DEFAULT CHARSET=utf8mb4;


DELIMITER $$
CREATE TRIGGER `set_dbname` BEFORE INSERT ON `store` FOR EACH ROW BEGIN
DECLARE next_id INT;
SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'store');
SET NEW.dbname= CONCAT('jibres_', next_id);
END
$$
DELIMITER ;



CREATE TABLE `store_data` (
`id` int(10) UNSIGNED NOT NULL,
`title` varchar(200) CHARACTER SET utf8mb4 NULL,
`owner` int(10) UNSIGNED NOT NULL,
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
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_data_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `store_analytics` (
`id` int(10) UNSIGNED NOT NULL,
`lastactivity` timestamp NULL DEFAULT NULL,
`dbtrafic` int(10) UNSIGNED DEFAULT NULL,
`dbsize` int(10) UNSIGNED DEFAULT NULL,
`users` int(10) UNSIGNED DEFAULT NULL,
`activeuser` int(10) UNSIGNED DEFAULT NULL,
`deactiveuser` int(10) UNSIGNED DEFAULT NULL,
`log` int(10) UNSIGNED DEFAULT NULL,
`visitor` int(10) UNSIGNED DEFAULT NULL,
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
`storetransaction` int(10) UNSIGNED DEFAULT NULL,
`sumplustransaction` int(10) UNSIGNED DEFAULT NULL,
`summinustransaction` int(10) UNSIGNED DEFAULT NULL,
`product` int(10) UNSIGNED DEFAULT NULL,
`factor` int(10) UNSIGNED DEFAULT NULL,
`factordetail` int(10) UNSIGNED DEFAULT NULL,
`sumfactor` int(10) UNSIGNED DEFAULT NULL,
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
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_analytics_data_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `store_plan` (
`id` bigint(20) UNSIGNED NOT NULL,
`store_id` int(10) UNSIGNED NOT NULL,
`creator` int(10) UNSIGNED DEFAULT NULL,
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
CONSTRAINT `storeplans_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



