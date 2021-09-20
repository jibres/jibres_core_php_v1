ALTER TABLE jibres_XXXXXXX.factors ADD `discount_id` bigint UNSIGNED NULL DEFAULT NULL AFTER `address_id`;
ALTER TABLE jibres_XXXXXXX.factors ADD  KEY `factors_index_discount_id` (`discount_id`);

ALTER TABLE jibres_XXXXXXX.factors ADD `shippingapply` decimal(13,4) NULL DEFAULT NULL AFTER `shippingvat`;
ALTER TABLE jibres_XXXXXXX.factors ADD  KEY `factors_index_shippingapply` (`shippingapply`);

ALTER TABLE jibres_XXXXXXX.factordetails ADD `discount2` decimal(22,4) NULL DEFAULT NULL AFTER `discount`;
