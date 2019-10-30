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


