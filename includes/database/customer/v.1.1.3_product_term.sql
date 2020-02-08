CREATE TABLE `jibres_XXXXXXX`.`producttag` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
`language` CHAR(2) DEFAULT NULL,
`desc` mediumtext CHARACTER SET utf8mb4,
`creator` int(10) UNSIGNED DEFAULT NULL,
`status` enum('enable','disable','delete') NOT NULL DEFAULT 'enable',
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `tag_title_search_index` (`title`),
 CONSTRAINT `producttags_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;