CREATE TABLE `factordetails` (
`factor_id` bigint(20) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
`title` varchar(500) NOT NULL,
`price` int(10) DEFAULT NULL,
`count` smallint(5) DEFAULT NULL,
`total` int(10) DEFAULT NULL,
`discount` smallint(5) DEFAULT NULL,
`status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
`datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`desc` text CHARACTER SET utf8mb4,
CONSTRAINT `factordetails_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
