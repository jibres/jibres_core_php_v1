ALTER TABLE jibres_XXXXXXX.inventory CHANGE `id` `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.productinventory (
`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`inventory_id` SMALLINT(5) UNSIGNED NULL,
`product_id` INT(10) UNSIGNED NOT NULL,
`datecreated` timestamp NULL ,
`count` bigint(20) NULL,
`stock` bigint(20) NULL,
`thisstock` bigint(20) NULL,
`action` enum('initial','manual','move_to_inventory','move_from_inventory','warehouse_handling','sale','edit_sale','buy','edit_buy','presell','edit_presell','lending','edit_lending','backbuy','edit_backbuy','backsell','edit_backsell','waste','edit_waste','saleorder','edit_saleorder','reject_order','cancel_order') DEFAULT NULL,
`factor_id` bigint(20) UNSIGNED NOT NULL,
`user_id` INT(10) UNSIGNED NULL DEFAULT NULL,
`other_inventory_id` SMALLINT(5) UNSIGNED NULL,
PRIMARY KEY (`id`),
KEY `productinventory_search_index_count` (`count`),
KEY `productinventory_search_index_action` (`action`),
CONSTRAINT `productinventory_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productinventory_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productinventory_inventory_id` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productinventory_other_inventory_id` FOREIGN KEY (`other_inventory_id`) REFERENCES `inventory` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productinventory_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
