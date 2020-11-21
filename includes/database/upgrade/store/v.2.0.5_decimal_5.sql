ALTER TABLE jibres_XXXXXXX.factordetails ADD `price2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factordetails ADD `discount2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factordetails ADD `vat2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factordetails ADD `finalprice2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factordetails ADD `count2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.factordetails ADD `sum2` DECIMAL(31, 4) NULL DEFAULT NULL;


UPDATE jibres_XXXXXXX.factordetails SET factordetails.price2      = CAST((factordetails.price / 100)  AS DECIMAL(22, 4)) WHERE factordetails.price IS NOT NULL;
UPDATE jibres_XXXXXXX.factordetails SET factordetails.discount2   = CAST((factordetails.discount / 100)  AS DECIMAL(22, 4)) WHERE factordetails.discount IS NOT NULL;
UPDATE jibres_XXXXXXX.factordetails SET factordetails.vat2        = CAST((factordetails.vat / 100)  AS DECIMAL(22, 4)) WHERE factordetails.vat IS NOT NULL;
UPDATE jibres_XXXXXXX.factordetails SET factordetails.finalprice2 = CAST((factordetails.finalprice / 100)  AS DECIMAL(22, 4)) WHERE factordetails.finalprice IS NOT NULL;
UPDATE jibres_XXXXXXX.factordetails SET factordetails.count2      = CAST((factordetails.count / 1000)  AS DECIMAL(13, 4)) WHERE factordetails.count IS NOT NULL;
UPDATE jibres_XXXXXXX.factordetails SET factordetails.sum2        = CAST((factordetails.sum / 100000)  AS DECIMAL(31, 4)) WHERE factordetails.sum IS NOT NULL;


ALTER TABLE jibres_XXXXXXX.factordetails DROP `price`;
ALTER TABLE jibres_XXXXXXX.factordetails DROP `discount`;
ALTER TABLE jibres_XXXXXXX.factordetails DROP `vat`;
ALTER TABLE jibres_XXXXXXX.factordetails DROP `finalprice`;
ALTER TABLE jibres_XXXXXXX.factordetails DROP `count`;
ALTER TABLE jibres_XXXXXXX.factordetails DROP `sum`;



ALTER TABLE jibres_XXXXXXX.factordetails CHANGE `sum2` `sum` DECIMAL(31, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.factordetails CHANGE `count2` `count` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.factordetails CHANGE `finalprice2` `finalprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.factordetails CHANGE `vat2` `vat` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.factordetails CHANGE `discount2` `discount` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.factordetails CHANGE `price2` `price` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `product_id`;
