CREATE TABLE `productprices` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`product_id` int(10) UNSIGNED NOT NULL,
`creator` int(10) UNSIGNED NOT NULL,
`startdate` datetime NOT NULL,
`startshamsidate` int(10) UNSIGNED NOT NULL,
`enddate` datetime NOT NULL,
`endshamsidate` int(10) UNSIGNED NOT NULL,
`buyprice` bigint(20) UNSIGNED NULL DEFAULT NULL,
`price` bigint(20) UNSIGNED NULL DEFAULT NULL,
`discount` bigint(20) NULL DEFAULT NULL,
`datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `productprices_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productprices_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

