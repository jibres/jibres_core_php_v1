ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `vat` `detailvat` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factordetails` CHANGE `vat` `vat` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`productcategory` CHANGE `file_id` `file` varchar(500)  NULL DEFAULT NULL;


-- ALTER TABLE `jibres_XXXXXXX`.`factordetails` ADD `productprice_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
-- ALTER TABLE `jibres_XXXXXXX`.`factordetails` ADD CONSTRAINT `factordetails_productprice_id` FOREIGN KEY (`productprice_id`) REFERENCES `productprices` (`id`) ON UPDATE CASCADE;

ALTER TABLE `jibres_XXXXXXX`.`factordetails` CHANGE `discount` `discount` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `price`;
ALTER TABLE `jibres_XXXXXXX`.`factordetails` CHANGE `vat` `vat` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `discount`;
ALTER TABLE `jibres_XXXXXXX`.`factordetails` ADD `finalprice` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `vat`;
ALTER TABLE `jibres_XXXXXXX`.`factordetails` CHANGE `count` `count` int(10) UNSIGNED NULL DEFAULT NULL AFTER `finalprice`;




ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `sum` `total` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `detailsum` `subprice` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `detaildiscount` `subdiscount` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `detailvat` `subvat` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `detailtotalsum` `subtotal` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `transport` `shipping` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factors` ADD `shippingvat` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `shipping`;


