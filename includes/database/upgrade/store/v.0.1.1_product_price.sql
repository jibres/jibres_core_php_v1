ALTER TABLE `jibres_XXXXXXX`.`products` ADD `buyprice` bigint(20) UNSIGNED DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `price` bigint(20) UNSIGNED DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `compareatprice` bigint(20) UNSIGNED DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `discount` bigint(20) DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `discountpercent` int(10) DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `vatprice` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE `jibres_XXXXXXX`.`products` ADD `finalprice` bigint(20) DEFAULT NULL AFTER `slug`;


