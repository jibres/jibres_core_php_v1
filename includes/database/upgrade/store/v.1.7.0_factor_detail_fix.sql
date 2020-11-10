ALTER TABLE jibres_XXXXXXX.factordetails DROP CONSTRAINT `factordetails_factor_id`;
ALTER TABLE jibres_XXXXXXX.factordetails DROP CONSTRAINT `factordetails_product_id`;

ALTER TABLE jibres_XXXXXXX.factordetails DROP PRIMARY KEY ;
ALTER TABLE jibres_XXXXXXX.factordetails ADD PRIMARY KEY (`id`) ;
ALTER TABLE jibres_XXXXXXX.factordetails DROP INDEX `id` ;

ALTER TABLE jibres_XXXXXXX.factordetails ADD CONSTRAINT `factordetails_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE;
ALTER TABLE jibres_XXXXXXX.factordetails ADD CONSTRAINT `factordetails_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;