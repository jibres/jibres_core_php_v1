CREATE TABLE `jibres_XXXXXXX`.`productproperties` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`product_id` int(10) UNSIGNED NOT NULL,
`cat` varchar(100) DEFAULT NULL,
`key` varchar(200) DEFAULT NULL,
`value` varchar(1000) DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`sort` smallint(5) NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`outstanding` bit(1) NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `productproperties_cat_search_index` (`cat`),
KEY `productproperties_key_search_index` (`key`),
CONSTRAINT `productpropreries_prudeuct_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;