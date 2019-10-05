CREATE TABLE `producttag` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`slug` varchar(100) CHARACTER SET utf8mb4 NULL,
`url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`status` enum('enable','disable','delete') NULL DEFAULT 'enable',
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `producttag_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `producttagusage` (
  `producttag_id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
