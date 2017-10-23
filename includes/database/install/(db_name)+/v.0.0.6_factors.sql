CREATE TABLE `factors` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`customer` int(10) UNSIGNED NOT NULL,
`seller` int(10) UNSIGNED NOT NULL,
`date` datetime NOT NULL,
`title` varchar(500) NULL,
`temp` bit(1) DEFAULT NULL,
`total` bigint(20) DEFAULT NULL,
`totaldiscount` int(10) DEFAULT NULL,
`discount` int(10) DEFAULT NULL,
`status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
`vat` bit(1) NULL DEFAULT NULL,
`vatpay` int(10) DEFAULT NULL,
`finaltotal` bigint(20) DEFAULT NULL,
`countdetail` smallint(5) UNSIGNED DEFAULT NULL,
`datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`desc` text CHARACTER SET utf8mb4,
PRIMARY KEY (`id`),
CONSTRAINT `factors_user_id` FOREIGN KEY (`seller`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factors_user_id_seller` FOREIGN KEY (`customer`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

