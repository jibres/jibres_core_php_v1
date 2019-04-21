ALTER TABLE `products` ADD `cat_id` int(10) unsigned NULL DEFAULT NULL AFTER `cat`;
ALTER TABLE `products` ADD CONSTRAINT `products_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `productterms` (`id`) ON UPDATE CASCADE;
ALTER TABLE `products` ADD INDEX `products_cat_id_search_index` (`cat_id`);
ALTER TABLE `productproperties` ADD INDEX `productproperties_cat_search_index` (`cat`);
ALTER TABLE `productproperties` ADD INDEX `productproperties_key_search_index` (`key`);
ALTER TABLE `productproperties` ADD INDEX `productproperties_value_search_index` (`value`);
ALTER TABLE `productproperties` ADD INDEX `productproperties_product_id_search_index` (`product_id`);
ALTER TABLE `productproperties` ADD INDEX `productproperties_store_id_search_index` (`store_id`);

ALTER TABLE `productterms` ADD `defaultproperty` text CHARACTER SET utf8mb4;

