ALTER TABLE jibres_XXXXXXX.factordetails ADD `productprice_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factordetails ADD CONSTRAINT `factordetails_productprice_id` FOREIGN KEY (`productprice_id`) REFERENCES jibres_XXXXXXX.productprices (`id`) ON UPDATE CASCADE;
