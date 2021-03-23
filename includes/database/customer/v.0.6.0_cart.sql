CREATE TABLE `jibres_XXXXXXX`.`cart` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`product_id` int(10) UNSIGNED NULL,
`price` DECIMAL(22, 4) NULL DEFAULT NULL,
`count` DECIMAL(13, 4) NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
`productprice_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
`guestid` varchar(50) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`view` bit(1)  NULL DEFAULT NULL,
`ip_id` BIGINT UNSIGNED NULL,
`agent_id` INT UNSIGNED NULL,
PRIMARY KEY (`id`),
INDEX `cart_search_index_ip_id` (`ip_id`),
INDEX `cart_search_index_agent_id` (`agent_id`),
CONSTRAINT `cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `cart_productprice_id` FOREIGN KEY (`productprice_id`) REFERENCES `productprices` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

