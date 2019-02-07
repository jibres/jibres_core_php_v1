ALTER TABLE `products` ADD `scalecode` int(10) DEFAULT NULL;
ALTER TABLE `products` ADD INDEX `	index_search_scalecode` (`scalecode`);