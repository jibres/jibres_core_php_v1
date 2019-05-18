CREATE TABLE `productcomment` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
`userstore_id` bigint(20) UNSIGNED NULL,
`content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
`parent` bigint(20) UNSIGNED DEFAULT NULL,
`star` smallint(5) UNSIGNED DEFAULT NULL,
`status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
`ip` int(10) UNSIGNED DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `productcomment_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productcomment_userstore_id` FOREIGN KEY (`userstore_id`) REFERENCES `userstores` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productcomment_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `productcomment` ADD INDEX `productcomment_store_id_search_index` (`store_id`);
ALTER TABLE `productcomment` ADD INDEX `productcomment_product_id_search_index` (`product_id`);
ALTER TABLE `productcomment` ADD INDEX `productcomment_star_search_index` (`star`);
