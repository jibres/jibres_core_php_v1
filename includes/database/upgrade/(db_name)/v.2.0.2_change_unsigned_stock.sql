ALTER TABLE `products` CHANGE `stock` `stock` FLOAT(20) NULL DEFAULT NULL;
ALTER TABLE `products` ADD `buylock`  bit(1) NULL DEFAULT NULL;
ALTER TABLE `factors` ADD `type` ENUM('sell','buy','presell','lending','backbuy','backsell','waste') NOT NULL;
ALTER TABLE `factors` ADD `discount2` int(10) DEFAULT NULL;
ALTER TABLE `productprices` ADD `factor_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `productprices` ADD CONSTRAINT `productprices_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE;

