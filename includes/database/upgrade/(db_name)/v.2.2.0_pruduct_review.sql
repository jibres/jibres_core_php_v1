
ALTER TABLE `products` DROP `name`;
ALTER TABLE `products` DROP `buylock`;

ALTER TABLE `products` CHANGE `code` `quickcode`  varchar(100) NULL DEFAULT NULL;
ALTER TABLE `products` CHANGE `checkstock` `oversale`  bit(1) NULL DEFAULT NULL;

ALTER TABLE `products` ADD `taxable` bit(1) NULL DEFAULT NULL;

ALTER TABLE `products` ADD `type` enum('product', 'file', 'service') NOT NULL DEFAULT 'product';

ALTER TABLE `products` ADD `seotitle` varchar(300) NULL DEFAULT NULL;
ALTER TABLE `products` ADD `seodesc` varchar(500) NULL DEFAULT NULL;
ALTER TABLE `products` ADD `seourl` varchar(1000) NULL DEFAULT NULL;

ALTER TABLE `products` ADD `gallery` text NULL DEFAULT NULL;

ALTER TABLE `products` ADD `weight` float(10) NULL DEFAULT NULL;

ALTER TABLE `products` CHANGE `sold` `sold` float(20) NULL DEFAULT NULL;
ALTER TABLE `products` CHANGE `stock` `stock` float(20) NULL DEFAULT NULL;

CREATE TABLE `inventory` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`name` varchar(200) NULL DEFAULT NULL,
`address_id` bigint(20) UNSIGNED NULL,
`default` bit(1) DEFAULT NULL,
`online` bit(1) DEFAULT NULL,
`sale` bit(1) DEFAULT NULL,
`sort` smallint(3) DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted') NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `inventory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE `productinventory` (
`id`           bigint(10) 	UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id`     int(10) 		UNSIGNED NOT NULL,
`inventory_id` bigint(20) 	UNSIGNED NOT NULL,
`product_id`   int(10) 		UNSIGNED NOT NULL,
`stock`		   float(20) NULL DEFAULT NULL,
`sold`		   float(20) NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `productinventory_inventory_id` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productinventory_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `prudoctinventory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

