ALTER TABLE `products` DROP FOREIGN KEY `products_creator`;
ALTER TABLE `products` DROP INDEX `products_creator`;
ALTER TABLE `products` DROP `creator`;

ALTER TABLE `products` DROP `cat`;
ALTER TABLE `products` DROP `seourl`;
ALTER TABLE `products` DROP `company`;


ALTER TABLE `products` DROP FOREIGN KEY `products_guarantee_id`;
ALTER TABLE `products` DROP INDEX `products_guarantee_id_search_index`;
ALTER TABLE `products` DROP `guarantee_id`;
ALTER TABLE `products` DROP `guarantee`;


ALTER TABLE `products` ADD `code` int(10) UNSIGNED NULL DEFAULT NULL AFTER `store_id`;
ALTER TABLE `products` ADD INDEX `products_code_search_index` (`code`);



ALTER TABLE `products` DROP INDEX `index_search_quickcode`;
ALTER TABLE `products` DROP `quickcode`;
ALTER TABLE `products` DROP `shortcode`;


ALTER TABLE `products` DROP `unit`;
ALTER TABLE `products` DROP `taxable`;
ALTER TABLE `products` DROP `initialbalance`;

ALTER TABLE `products` DROP INDEX `index_search_sold`;
ALTER TABLE `products` DROP INDEX `index_search_stock`;
ALTER TABLE `products` DROP `sold`;
ALTER TABLE `products` DROP `stock`;



ALTER TABLE `products` DROP `service`;


ALTER TABLE `products` DROP INDEX `products_salesite_search_index`;
ALTER TABLE `products` DROP `salesite`;

ALTER TABLE `products` DROP INDEX `products_salephysical_search_index`;
ALTER TABLE `products` DROP `salephysical`;




ALTER TABLE `productcompany` CHANGE `store_id` `store_id` int(10) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `productunit` CHANGE `store_id` `store_id` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `productunit` DROP `isdefault`;
ALTER TABLE `productunit` DROP `maxsale`;



ALTER TABLE `products` DROP INDEX `index_search_buyprice`;
ALTER TABLE `products` DROP INDEX `index_search_price`;
ALTER TABLE `products` DROP INDEX `index_search_discount`;
ALTER TABLE `products` DROP INDEX `products_saletelegram_search_index`;
ALTER TABLE `products` DROP INDEX `products_saleapp_search_index`;

ALTER TABLE `products` DROP FOREIGN KEY `products_cat_id`;
ALTER TABLE `products` DROP FOREIGN KEY `products_company_id`;
ALTER TABLE `products` DROP FOREIGN KEY `products_unit_id`;
ALTER TABLE `products` DROP INDEX `products_cat_id_search_index`;
ALTER TABLE `products` DROP INDEX `products_unit_id_search_index`;
ALTER TABLE `products` DROP INDEX `products_company_id_search_index`;

ALTER TABLE `products` ADD CONSTRAINT `products_company_id` FOREIGN KEY (`company_id`) REFERENCES `productcompany` (`id`) ON UPDATE CASCADE;
ALTER TABLE `products` ADD CONSTRAINT `products_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `productunit` (`id`) ON UPDATE CASCADE;
-- ALTER TABLE `products` ADD CONSTRAINT `products_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `productcategory` (`id`) ON UPDATE CASCADE;


ALTER TABLE `products` ADD `step` int(10) UNSIGNED NULL DEFAULT NULL AFTER `maxstock`;
ALTER TABLE `products` ADD `minsale` int(10) UNSIGNED NULL DEFAULT NULL AFTER `step`;
ALTER TABLE `products` ADD `maxsale` int(10) UNSIGNED NULL DEFAULT NULL AFTER `minsale`;
ALTER TABLE `products` ADD `thumbid` int(10) UNSIGNED NULL DEFAULT NULL AFTER `thumb`;
ALTER TABLE `products` ADD `weightunit` enum('lb', 'oz', 'kg', 'g') NULL DEFAULT NULL AFTER `weight`;






CREATE TABLE `productcategory` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
`title` varchar(500) DEFAULT NULL,
`slug` varchar(200) DEFAULT NULL,
`language` char(2) DEFAULT NULL,
`properties` text CHARACTER SET utf8mb4,
`desc` text CHARACTER SET utf8mb4,
`seotitle` varchar(300) DEFAULT NULL,
`seodesc` varchar(500) DEFAULT NULL,
`file_id` int(10) UNSIGNED NULL,
`parent` int(10) UNSIGNED NULL,
`status` enum('enable','disable','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `productcategory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productcategory_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productcategory_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `productcategory` ADD INDEX `productcategory_parent_search_index` (`parent`);


