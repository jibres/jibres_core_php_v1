CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`files` (
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
`ip` bigint(20) NULL DEFAULT NULL,
`domain` varchar(200) NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `files_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
KEY `files_md5_search` (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`fileusage` (
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

