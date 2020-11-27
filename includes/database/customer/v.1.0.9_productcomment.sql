CREATE TABLE `jibres_XXXXXXX`.`productcomment` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`product_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`content` mediumtext,
`title` VARCHAR(300) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`parent` bigint(20) UNSIGNED DEFAULT NULL,
`star` smallint(5) UNSIGNED DEFAULT NULL,
`status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
`ip` bigint(20) DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`factor_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `productcomment_star_search_index` (`star`),
CONSTRAINT `productcomment_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productcomment_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productcomment_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
