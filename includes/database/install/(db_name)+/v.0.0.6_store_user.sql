CREATE TABLE `store_user` (
`id` bigint(20) UNSIGNED NOT NULL,
`store_id` int(10) UNSIGNED NULL,
`creator` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`customer` enum('yes','no') DEFAULT NULL,
`staff` enum('yes','no') DEFAULT NULL,
`supplier` enum('yes','no') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `store_user_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_user_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
