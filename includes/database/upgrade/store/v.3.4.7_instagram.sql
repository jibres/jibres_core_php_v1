CREATE TABLE jibres_XXXXXXX.instagram (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`token` varchar(50) NULL DEFAULT NULL,
`type` varchar(200) DEFAULT NULL,
`username` varchar(200) DEFAULT NULL,
`code` text DEFAULT NULL,
`status` enum('enable', 'disable', 'expire', 'used', 'deleted') DEFAULT NULL,
`send` mediumtext DEFAULT NULL,
`receive` mediumtext DEFAULT NULL,
`meta` mediumtext DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`expiredate` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `index_search_instagram_token` (`token`),
KEY `index_search_instagram_status` (`status`),
KEY `index_search_instagram_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;