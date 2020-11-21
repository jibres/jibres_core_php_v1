ALTER TABLE jibres_XXXXXXX.factordetails ADD INDEX `factordetails_index_count` (`count`);
ALTER TABLE jibres_XXXXXXX.factordetails ADD INDEX `factordetails_index_sum` (`sum`);

ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_qty` (`qty`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_subprice` (`subprice`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_subdiscount` (`subdiscount`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_subtotal` (`subtotal`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_discount` (`discount`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_discount2` (`discount2`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_shipping` (`shipping`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_subvat` (`subvat`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_total` (`total`);

ALTER TABLE jibres_XXXXXXX.productinventory ADD INDEX `productinventory_index_count` (`count`);
