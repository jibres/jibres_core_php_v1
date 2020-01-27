CREATE TABLE `jibres_XXXXXXX`.`factordetails` (
`factor_id` bigint(20) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
`price` bigint(20) UNSIGNED DEFAULT NULL,
`discount` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
`vat` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
`finalprice` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
`count` int(10) UNSIGNED DEFAULT NULL,
`sum` bigint(20) UNSIGNED DEFAULT NULL,
PRIMARY KEY (`factor_id`,`product_id`),
CONSTRAINT `factordetails_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factordetails_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;