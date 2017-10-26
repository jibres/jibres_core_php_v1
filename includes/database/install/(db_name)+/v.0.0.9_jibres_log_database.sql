CREATE DATABASE `jibres_log` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `jibres_log`.`logitems` (
`id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
`type` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`caller` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`desc` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`meta` mediumtext CHARACTER SET utf8mb4,
`count` int(10) UNSIGNED NOT NULL DEFAULT '0',
`priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `jibres_log`.`logs` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`logitem_id` smallint(5) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`data` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`meta` mediumtext CHARACTER SET utf8mb4,
`status` enum('enable','disable','expire','deliver') DEFAULT NULL,
`desc` varchar(250) DEFAULT NULL,
`createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `logs_logitems_id` FOREIGN KEY (`logitem_id`) REFERENCES `logitems` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

