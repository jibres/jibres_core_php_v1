ALTER TABLE `stores` ADD `socialnetwork` text CHARACTER SET utf8mb4;
ALTER TABLE `products` ADD `salesite` bit(1) NULL DEFAULT b'1';
ALTER TABLE `products` ADD `saletelegram` bit(1) NULL DEFAULT b'1';
ALTER TABLE `products` ADD `saleapp` bit(1) NULL DEFAULT b'1';
ALTER TABLE `products` ADD `salephysical` bit(1) NULL DEFAULT b'1';

ALTER TABLE `products` ADD INDEX `products_salesite_search_index` (`salesite`);
ALTER TABLE `products` ADD INDEX `products_saletelegram_search_index` (`saletelegram`);
ALTER TABLE `products` ADD INDEX `products_saleapp_search_index` (`saleapp`);
ALTER TABLE `products` ADD INDEX `products_salephysical_search_index` (`salephysical`);

ALTER TABLE `products` ADD `infinite` bit(1) NULL DEFAULT NULL;




ALTER TABLE `stores` ADD `fav` VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `logo`;
ALTER TABLE `stores` ADD `payment` text CHARACTER SET utf8mb4;


