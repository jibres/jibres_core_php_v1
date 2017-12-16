ALTER TABLE `products` CHANGE `stock` `stock` FLOAT(20) NULL DEFAULT NULL;
ALTER TABLE `products` ADD `buylock`  bit(1) NULL DEFAULT NULL;
ALTER TABLE `factors` ADD `type` ENUM('sell','buy','presell','lending','backbuy','backsell','waste') NOT NULL;
ALTER TABLE `factors` ADD `discount2` int(10) DEFAULT NULL;
