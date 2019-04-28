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



ALTER TABLE `productterms` ADD INDEX `terms_type_search_index` (`type`);
ALTER TABLE `productterms` ADD INDEX `terms_store_id_search_index` (`store_id`);





ALTER TABLE `terms` CHANGE `type` `type` ENUM('cat','tag','code','other','term','support_tag','mag','mag_tag','help','help_tag', 'thirdparty_tag') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `termusages` CHANGE `type` `type` ENUM('cat','tag','term','code','other','support_tag','mag','mag_tag','help','help_tag','thirdparty_tag','barcode1','barcode2','barcode3','qrcode1','qrcode2','qrcode3','rfid1','rfid2','rfid3','fingerprint1','fingerprint2','fingerprint3','fingerprint4','fingerprint5','fingerprint6','fingerprint7','fingerprint8','fingerprint9','fingerprint10') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;


ALTER TABLE `producttermusages` CHANGE `pruductterm_id` `productterm_id` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `producttermusages` ADD INDEX `producttermusages_product_id_search_index` (`product_id`);
ALTER TABLE `producttermusages` ADD INDEX `producttermusages_productterm_id_search_index` (`productterm_id`);