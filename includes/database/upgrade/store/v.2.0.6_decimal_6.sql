

ALTER TABLE jibres_XXXXXXX.factors ADD `qty2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `subprice2` DECIMAL(31, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `subdiscount2` DECIMAL(31, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `subtotal2` DECIMAL(31, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `subvat2` DECIMAL(31, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `discount23` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `discount22` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `shipping2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `shippingvat2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factors ADD `total2` DECIMAL(31, 4) NULL DEFAULT NULL;


UPDATE jibres_XXXXXXX.factors SET factors.qty2         = CAST((factors.qty / 1000) AS DECIMAL(13, 4)) WHERE factors.qty IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.subprice2    = CAST((factors.subprice / 100000) AS DECIMAL(31, 4)) WHERE factors.subprice IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.subdiscount2 = CAST((factors.subdiscount / 100000) AS DECIMAL(31, 4)) WHERE factors.subdiscount IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.subtotal2    = CAST((factors.subtotal / 100000) AS DECIMAL(31, 4)) WHERE factors.subtotal IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.subvat2      = CAST((factors.subvat / 100000) AS DECIMAL(31, 4)) WHERE factors.subvat IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.discount23   = CAST((factors.discount / 100) AS DECIMAL(22, 4)) WHERE factors.discount IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.discount22   = CAST((factors.discount2 / 100) AS DECIMAL(22, 4)) WHERE factors.discount2 IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.shipping2    = CAST((factors.shipping / 100) AS DECIMAL(13, 4)) WHERE factors.shipping IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.shippingvat2 = CAST((factors.shippingvat / 100) AS DECIMAL(13, 4)) WHERE factors.shippingvat IS NOT NULL;
UPDATE jibres_XXXXXXX.factors SET factors.total2       = CAST((factors.total / 100000) AS DECIMAL(31, 4)) WHERE factors.total IS NOT NULL;


ALTER TABLE jibres_XXXXXXX.factors DROP `qty`;
ALTER TABLE jibres_XXXXXXX.factors DROP `subprice`;
ALTER TABLE jibres_XXXXXXX.factors DROP `subdiscount`;
ALTER TABLE jibres_XXXXXXX.factors DROP `subtotal`;
ALTER TABLE jibres_XXXXXXX.factors DROP `subvat`;
ALTER TABLE jibres_XXXXXXX.factors DROP `discount`;
ALTER TABLE jibres_XXXXXXX.factors DROP `discount2`;
ALTER TABLE jibres_XXXXXXX.factors DROP `shipping`;
ALTER TABLE jibres_XXXXXXX.factors DROP `shippingvat`;
ALTER TABLE jibres_XXXXXXX.factors DROP `total`;



ALTER TABLE jibres_XXXXXXX.factors CHANGE `total2` `total` DECIMAL(31, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `shippingvat2` `shippingvat` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `shipping2` `shipping` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `discount22` `discount2` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `discount23` `discount` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `subdiscount2` `subdiscount` DECIMAL(31, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `subvat2` `subvat` DECIMAL(31, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `subtotal2` `subtotal` DECIMAL(31, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `subprice2` `subprice` DECIMAL(31, 4) NULL DEFAULT NULL AFTER `date`;
ALTER TABLE jibres_XXXXXXX.factors CHANGE `qty2` `qty` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `date`;
