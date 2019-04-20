ALTER TABLE `products` ADD `cat_id` int(10) unsigned NULL DEFAULT NULL AFTER `cat`;
ALTER TABLE `products` ADD CONSTRAINT `products_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `productterms` (`id`) ON UPDATE CASCADE;
ALTER TABLE `products` ADD INDEX `products_cat_id_search_index` (`cat_id`);