ALTER TABLE `factors` CHANGE `type` `type` ENUM('sell', 'sale','buy','presell','lending','backbuy','backsell','waste') NOT NULL;
UPDATE factors SET factors.type = 'sale' WHERE factors.type = 'sell';
ALTER TABLE `factors` CHANGE `type` `type` ENUM('sale','buy','presell','lending','backbuy','backsell','waste') NOT NULL;
ALTER TABLE `products` CHANGE `sellonline` `saleonline` BIT(1) NULL DEFAULT NULL;
ALTER TABLE `products` CHANGE `sellstore` `salestore` BIT(1) NULL DEFAULT NULL;