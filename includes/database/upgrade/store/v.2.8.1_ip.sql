CREATE TABLE jibres_XXXXXXX.ip (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`ipv4` varchar(100) DEFAULT NULL,
`ipv6` varchar(100) DEFAULT NULL,
`ipv4long` bigint DEFAULT NULL,
`block` enum('block','unblock','unknown','new') DEFAULT NULL,
`countblock` int DEFAULT NULL,
`datecreated` datetime DEFAULT NULL,
`datemodified` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `search_index_ipv4` (`ipv4`),
 KEY `search_index_ipv6` (`ipv6`),
 KEY `search_index_ipv4long` (`ipv4long`),
 KEY `search_index_block` (`block`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;