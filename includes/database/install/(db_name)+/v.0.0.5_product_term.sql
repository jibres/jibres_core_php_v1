CREATE TABLE `productterms` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`type` enum('cat','tag','code','other','term') DEFAULT NULL,
`title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
`order` smallint(5) UNSIGNED DEFAULT NULL,
`desc` mediumtext CHARACTER SET utf8mb4,
`meta` mediumtext CHARACTER SET utf8mb4,
`parent` int(10) UNSIGNED DEFAULT NULL,
`creator` int(10) UNSIGNED DEFAULT NULL,
`status` enum('enable','disable', 'delete') NOT NULL DEFAULT 'enable',
`count` int(10) UNSIGNED DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`datecreated` timestamp DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `productterms_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `producttermusages` (
`pruductterm_id` int(10) UNSIGNED NOT NULL,
`product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
