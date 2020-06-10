ALTER TABLE jibres_XXXXXXX.cart ADD `price` bigint(20) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.cart CHANGE `date` `datecreated` timestamp NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.cart ADD `datemodified` timestamp NULL DEFAULT NULL AFTER `datecreated`;

ALTER TABLE jibres_XXXXXXX.cart ADD `productprice_id` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.cart ADD CONSTRAINT `cart_productprice_id` FOREIGN KEY (`productprice_id`) REFERENCES `productprices` (`id`) ON UPDATE CASCADE;