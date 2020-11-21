ALTER TABLE jibres_XXXXXXX.products ADD `finalprice2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products ADD `vatprice2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products ADD `discountpercent2` DECIMAL(5, 2) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products ADD `discount2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products ADD `price2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products ADD `buyprice2` DECIMAL(22, 4) NULL DEFAULT NULL;


UPDATE jibres_XXXXXXX.products SET products.finalprice2      = (CAST(products.finalprice AS DECIMAL(22, 4)) / 100) WHERE products.finalprice IS NOT NULL;
UPDATE jibres_XXXXXXX.products SET products.vatprice2        = (CAST(products.vatprice AS DECIMAL(22, 4)) / 100) WHERE products.vatprice IS NOT NULL;
UPDATE jibres_XXXXXXX.products SET products.discountpercent2 = (CAST(products.discountpercent AS DECIMAL(5, 2)) / 100) WHERE products.discountpercent IS NOT NULL;
UPDATE jibres_XXXXXXX.products SET products.discount2        = (CAST(products.discount AS DECIMAL(22, 4)) / 100) WHERE products.discount IS NOT NULL;
UPDATE jibres_XXXXXXX.products SET products.price2           = (CAST(products.price AS DECIMAL(22, 4)) / 100) WHERE products.price IS NOT NULL;
UPDATE jibres_XXXXXXX.products SET products.buyprice2        = (CAST(products.buyprice AS DECIMAL(22, 4)) / 100) WHERE products.buyprice IS NOT NULL;

ALTER TABLE jibres_XXXXXXX.products DROP `finalprice`;
ALTER TABLE jibres_XXXXXXX.products DROP `vatprice`;
ALTER TABLE jibres_XXXXXXX.products DROP `discountpercent`;
ALTER TABLE jibres_XXXXXXX.products DROP `discount`;
ALTER TABLE jibres_XXXXXXX.products DROP `price`;
ALTER TABLE jibres_XXXXXXX.products DROP `buyprice`;


ALTER TABLE jibres_XXXXXXX.products CHANGE `finalprice2` `finalprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE jibres_XXXXXXX.products CHANGE `vatprice2` `vatprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE jibres_XXXXXXX.products CHANGE `discountpercent2` `discountpercent` DECIMAL(5, 2) NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE jibres_XXXXXXX.products CHANGE `discount2` `discount` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE jibres_XXXXXXX.products CHANGE `price2` `price` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `slug`;
ALTER TABLE jibres_XXXXXXX.products CHANGE `buyprice2` `buyprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `slug`;
