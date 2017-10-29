CREATE TABLE `factordetails` (
`factor_id` bigint(20) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
`price` bigint(20) UNSIGNED DEFAULT NULL,
`count` float(10) UNSIGNED DEFAULT NULL,
`discount` int(10) DEFAULT NULL,
`sum` bigint(20) UNSIGNED DEFAULT NULL,
CONSTRAINT `factordetails_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factordetails_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
