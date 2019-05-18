CREATE TABLE `productunit` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`title` varchar(100)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`int` bit(1) NULL DEFAULT NULL,
`isdefault` bit(1) NULL DEFAULT NULL,
`maxsale` int(10) UNSIGNED NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `productunit_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `products` ADD `unit_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `unit`;
ALTER TABLE `products` ADD CONSTRAINT `products_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `productunit` (`id`) ON UPDATE CASCADE;


CREATE TABLE `productcompany` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`title` varchar(100)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `productcompany_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `products` ADD `company_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `company`;
ALTER TABLE `products` ADD CONSTRAINT `products_company_id` FOREIGN KEY (`company_id`) REFERENCES `productcompany` (`id`) ON UPDATE CASCADE;


ALTER TABLE `productunit` ADD INDEX `productunit_store_id_search_index` (`store_id`);
ALTER TABLE `productcompany` ADD INDEX `productcompany_store_id_search_index` (`store_id`);
ALTER TABLE `products` ADD INDEX `products_unit_id_search_index` (`unit_id`);
ALTER TABLE `products` ADD INDEX `products_company_id_search_index` (`company_id`);
