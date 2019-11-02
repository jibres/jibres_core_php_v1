CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`setting` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`userstore_id` int(10) UNSIGNED DEFAULT NULL,
`lang` char(2) DEFAULT NULL,
`cat` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
`key` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
`value` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`json` mediumtext CHARACTER SET utf8mb4,
PRIMARY KEY (`id`),
KEY `setting_index_search_cat` (`cat`),
KEY `setting_index_search_key` (`key`),
KEY `setting_index_search_lang` (`lang`),
CONSTRAINT `files_userstore_id` FOREIGN KEY (`userstore_id`) REFERENCES `userstore` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
