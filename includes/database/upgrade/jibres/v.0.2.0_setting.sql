CREATE TABLE IF NOT EXISTS jibres.setting (
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
