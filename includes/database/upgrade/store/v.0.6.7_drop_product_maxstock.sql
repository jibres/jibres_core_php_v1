ALTER TABLE jibres_XXXXXXX.products ADD `minstock` INT(10) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.products ADD `maxstock` INT(10) NULL DEFAULT NULL;

UPDATE jibres_XXXXXXX.products SET products.minstock = (SELECT productstock.minstock FROM jibres_XXXXXXX.productstock WHERE productstock.product_id = products.id);
UPDATE jibres_XXXXXXX.products SET products.maxstock = (SELECT productstock.maxstock FROM jibres_XXXXXXX.productstock WHERE productstock.product_id = products.id);


DROP TABLE jibres_XXXXXXX.productstock;