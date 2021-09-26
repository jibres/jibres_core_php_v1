ALTER TABLE jibres_XXXXXXX.factors DROP KEY `factors_index_shippingapply`;
ALTER TABLE jibres_XXXXXXX.factors DROP `shippingapply`;

ALTER TABLE jibres_XXXXXXX.factors ADD `realshipping` decimal(13,4) NULL DEFAULT NULL AFTER `shippingvat`;
ALTER TABLE jibres_XXXXXXX.factors ADD  KEY `factors_index_realshipping` (`realshipping`);
