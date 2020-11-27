CREATE TABLE `jibres_XXXXXXX`.`factordetails` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`factor_id` bigint(20) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
`price` DECIMAL(22, 4)  DEFAULT NULL,
`discount` DECIMAL(22, 4)  NULL DEFAULT NULL,
`vat` DECIMAL(22, 4)  NULL DEFAULT NULL,
`finalprice` DECIMAL(22, 4)  NULL DEFAULT NULL,
`count` DECIMAL(13, 4)  DEFAULT NULL,
`sum` DECIMAL(31, 4)  DEFAULT NULL,
`productprice_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
`status` enum('enable','disable','draft','order','expire','cancel','pending_pay','pending_verify','pending_prepare','pending_send','sending','deliver','reject','spam','deleted') DEFAULT 'enable',
PRIMARY KEY (`id`),
KEY `factordetails_index_count` (`count`),
KEY `factordetails_search_index_status` (`status`),
KEY `factordetails_index_sum` (`sum`),
CONSTRAINT `factordetails_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factordetails_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factordetails_productprice_id` FOREIGN KEY (`productprice_id`) REFERENCES `productprices` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


