CREATE TABLE `jibres_XXXXXXX`.`cart` (
`user_id` int(10) UNSIGNED DEFAULT NULL,
`product_id` int(10) UNSIGNED NULL,
`count` int(10) UNSIGNED NULL,
`date` datetime NOT NULL,
CONSTRAINT `cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

