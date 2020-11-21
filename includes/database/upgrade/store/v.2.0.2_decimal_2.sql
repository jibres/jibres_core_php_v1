ALTER TABLE jibres_XXXXXXX.productprices ADD `finalprice2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productprices ADD `vatprice2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productprices ADD `discountpercent2` DECIMAL(5, 2) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productprices ADD `discount2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productprices ADD `price2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productprices ADD `buyprice2` DECIMAL(22, 4) NULL DEFAULT NULL;


UPDATE jibres_XXXXXXX.productprices SET productprices.finalprice2      = (CAST(productprices.finalprice AS DECIMAL(22, 4)) / 100) WHERE productprices.finalprice IS NOT NULL;
UPDATE jibres_XXXXXXX.productprices SET productprices.vatprice2        = (CAST(productprices.vatprice AS DECIMAL(22, 4)) / 100) WHERE productprices.vatprice IS NOT NULL;
UPDATE jibres_XXXXXXX.productprices SET productprices.discountpercent2 = (CAST(productprices.discountpercent AS DECIMAL(5, 2)) / 100) WHERE productprices.discountpercent IS NOT NULL;
UPDATE jibres_XXXXXXX.productprices SET productprices.discount2        = (CAST(productprices.discount AS DECIMAL(22, 4)) / 100) WHERE productprices.discount IS NOT NULL;
UPDATE jibres_XXXXXXX.productprices SET productprices.price2           = (CAST(productprices.price AS DECIMAL(22, 4)) / 100) WHERE productprices.price IS NOT NULL;
UPDATE jibres_XXXXXXX.productprices SET productprices.buyprice2        = (CAST(productprices.buyprice AS DECIMAL(22, 4)) / 100) WHERE productprices.buyprice IS NOT NULL;

ALTER TABLE jibres_XXXXXXX.productprices DROP `finalprice`;
ALTER TABLE jibres_XXXXXXX.productprices DROP `vatprice`;
ALTER TABLE jibres_XXXXXXX.productprices DROP `discountpercent`;
ALTER TABLE jibres_XXXXXXX.productprices DROP `discount`;
ALTER TABLE jibres_XXXXXXX.productprices DROP `price`;
ALTER TABLE jibres_XXXXXXX.productprices DROP `buyprice`;


ALTER TABLE jibres_XXXXXXX.productprices CHANGE `finalprice2` `finalprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `enddate`;
ALTER TABLE jibres_XXXXXXX.productprices CHANGE `vatprice2` `vatprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `enddate`;
ALTER TABLE jibres_XXXXXXX.productprices CHANGE `discountpercent2` `discountpercent` DECIMAL(5, 2) NULL DEFAULT NULL AFTER `enddate`;
ALTER TABLE jibres_XXXXXXX.productprices CHANGE `discount2` `discount` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `enddate`;
ALTER TABLE jibres_XXXXXXX.productprices CHANGE `price2` `price` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `enddate`;
ALTER TABLE jibres_XXXXXXX.productprices CHANGE `buyprice2` `buyprice` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `enddate`;
