ALTER TABLE `products` ADD `variants` mediumtext CHARACTER SET utf8mb4 NULL DEFAULT NULL;

ALTER TABLE `products` ADD `optionname1` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE `products` ADD `optionname2` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE `products` ADD `optionname3` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE `products` ADD `optionvalue1` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE `products` ADD `optionvalue2` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE `products` ADD `optionvalue3` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL;

ALTER TABLE `products` ADD `parent` int(10) unsigned NULL DEFAULT NULL;


ALTER TABLE `products` ADD INDEX `products_optionname1_search_index` (`optionname1`);
ALTER TABLE `products` ADD INDEX `products_optionname2_search_index` (`optionname2`);
ALTER TABLE `products` ADD INDEX `products_optionname3_search_index` (`optionname3`);
ALTER TABLE `products` ADD INDEX `products_optionvalue1_search_index` (`optionvalue1`);
ALTER TABLE `products` ADD INDEX `products_optionvalue2_search_index` (`optionvalue2`);
ALTER TABLE `products` ADD INDEX `products_optionvalue3_search_index` (`optionvalue3`);

ALTER TABLE `products` ADD INDEX `products_parent_search_index` (`parent`);
