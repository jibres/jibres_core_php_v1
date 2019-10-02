
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


ALTER TABLE `productprices` ADD `last` enum('yes') NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE `productprices` ADD INDEX `productprices_last_search_index` (`last`);

ALTER TABLE `productcompany` CHANGE `store_id` `store_id` int(10) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `productunit` CHANGE `store_id` `store_id` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `productunit` DROP `isdefault`;
ALTER TABLE `productunit` DROP `maxsale`;


CREATE TABLE `products2` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`store_id` int(10) UNSIGNED NOT NULL,
`code` int(10) UNSIGNED DEFAULT NULL,
`sku` varchar(20) DEFAULT NULL,

`title` varchar(500) DEFAULT NULL,
`seotitle` varchar(300) DEFAULT NULL,
`slug` varchar(200) DEFAULT NULL,
`seodesc` varchar(500) DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,

`barcode` varchar(100) DEFAULT NULL,
`barcode2` varchar(100) DEFAULT NULL,

`cat_id` int(10) UNSIGNED DEFAULT NULL,
`unit_id` int(10) UNSIGNED DEFAULT NULL,
`company_id` int(10) UNSIGNED DEFAULT NULL,

`salestep` int(10) UNSIGNED DEFAULT NULL,
`minstock` int(10) UNSIGNED DEFAULT NULL,
`maxstock` int(10) UNSIGNED DEFAULT NULL,
`minsale` int(10) UNSIGNED DEFAULT NULL,
`maxsale` int(10) UNSIGNED DEFAULT NULL,
`carton` int(10) UNSIGNED DEFAULT NULL,
`scalecode` int(10) DEFAULT NULL,

`weight` int(10) DEFAULT NULL,
`weightunit` enum('lb','oz','kg','g') DEFAULT NULL,

`type` enum('product','file','service') NOT NULL DEFAULT 'product',
`status` enum('unset','available','unavailable','soon','discountinued', 'deleted') DEFAULT NULL,

`thumbid` int(10) UNSIGNED DEFAULT NULL,
`gallery` text,

`vat` enum('yes') DEFAULT NULL,
`infinite` enum('yes') DEFAULT NULL,
`oversale` enum('yes') DEFAULT NULL,

`saleonline` enum('no') DEFAULT NULL,
`saletelegram` enum('no') DEFAULT NULL,
`saleapp` enum('no') DEFAULT NULL,


`variants` mediumtext CHARACTER SET utf8mb4,
`optionname1` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`optionname2` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`optionname3` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`optionvalue1` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`optionvalue2` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`optionvalue3` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,

`parent` int(10) UNSIGNED DEFAULT NULL,

`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `products_field_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `productunit` (`id`) ON UPDATE CASCADE,
CONSTRAINT `products_field_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE,
CONSTRAINT `products_field_company_id` FOREIGN KEY (`company_id`) REFERENCES `productcompany` (`id`) ON UPDATE CASCADE,
KEY `index_search_products_sku` (`sku`),
KEY `index_search_products_code` (`code`),
KEY `index_search_products_title` (`title`),
KEY `index_search_products_parent` (`parent`),
KEY `index_search_products_status` (`status`),
KEY `index_search_products_barcode` (`barcode`),
KEY `index_search_products_saleapp` (`saleapp`),
KEY `index_search_products_barcode2` (`barcode2`),
KEY `index_search_products_scalecode` (`scalecode`),
KEY `index_search_products_saleonline` (`saleonline`),
KEY `index_search_products_optionname1` (`optionname1`),
KEY `index_search_products_optionname2` (`optionname2`),
KEY `index_search_products_optionname3` (`optionname3`),
KEY `index_search_products_optionvalue1` (`optionvalue1`),
KEY `index_search_products_optionvalue2` (`optionvalue2`),
KEY `index_search_products_optionvalue3` (`optionvalue3`),
KEY `index_search_products_saletelegram` (`saletelegram`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


