ALTER TABLE `products` CHANGE `stock` `stock` FLOAT(20) NULL DEFAULT NULL;
ALTER TABLE `products` ADD `buylock`  bit(1) NULL DEFAULT NULL;