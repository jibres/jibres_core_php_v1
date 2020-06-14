
ALTER TABLE jibres_XXXXXXX.productcomment ADD `factor_id` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productcomment ADD CONSTRAINT `productcomment_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE;