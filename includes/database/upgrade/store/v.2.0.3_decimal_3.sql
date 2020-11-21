ALTER TABLE jibres_XXXXXXX.productinventory ADD `count2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory ADD `stock2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory ADD `thisstock2` DECIMAL(13, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory ADD `manualcount2` DECIMAL(13, 4) NULL DEFAULT NULL;



UPDATE jibres_XXXXXXX.productinventory SET productinventory.count2       = CAST((productinventory.count /  1000)  AS DECIMAL(13, 4)) WHERE productinventory.count IS NOT NULL;
UPDATE jibres_XXXXXXX.productinventory SET productinventory.stock2       = CAST((productinventory.stock /  1000)  AS DECIMAL(13, 4)) WHERE productinventory.stock IS NOT NULL;
UPDATE jibres_XXXXXXX.productinventory SET productinventory.thisstock2   = CAST((productinventory.thisstock /  1000)  AS DECIMAL(13, 4)) WHERE productinventory.thisstock IS NOT NULL;
UPDATE jibres_XXXXXXX.productinventory SET productinventory.manualcount2 = CAST((productinventory.manualcount /  1000)  AS DECIMAL(13, 4)) WHERE productinventory.manualcount IS NOT NULL;


ALTER TABLE jibres_XXXXXXX.productinventory DROP `count`;
ALTER TABLE jibres_XXXXXXX.productinventory DROP `stock`;
ALTER TABLE jibres_XXXXXXX.productinventory DROP `thisstock`;
ALTER TABLE jibres_XXXXXXX.productinventory DROP `manualcount`;



ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `count2` `count` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `stock2` `stock` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `thisstock2` `thisstock` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `manualcount2` `manualcount` DECIMAL(13, 4) NULL DEFAULT NULL AFTER `product_id`;
