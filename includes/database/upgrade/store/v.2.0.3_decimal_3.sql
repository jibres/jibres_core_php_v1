ALTER TABLE jibres_XXXXXXX.productinventory ADD `count2` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory ADD `stock2` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory ADD `thisstock2` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory ADD `manualcount2` DECIMAL(20, 4) NULL DEFAULT NULL;



UPDATE jibres_XXXXXXX.productinventory SET productinventory.count2      = (CAST(productinventory.count AS DECIMAL(20, 4)) / 1000) WHERE productinventory.count IS NOT NULL;
UPDATE jibres_XXXXXXX.productinventory SET productinventory.stock2        = (CAST(productinventory.stock AS DECIMAL(20, 4)) / 1000) WHERE productinventory.stock IS NOT NULL;
UPDATE jibres_XXXXXXX.productinventory SET productinventory.thisstock2 = (CAST(productinventory.thisstock AS DECIMAL(20, 4)) / 1000) WHERE productinventory.thisstock IS NOT NULL;
UPDATE jibres_XXXXXXX.productinventory SET productinventory.manualcount2 = (CAST(productinventory.manualcount AS DECIMAL(20, 4)) / 1000) WHERE productinventory.manualcount IS NOT NULL;


ALTER TABLE jibres_XXXXXXX.productinventory DROP `count`;
ALTER TABLE jibres_XXXXXXX.productinventory DROP `stock`;
ALTER TABLE jibres_XXXXXXX.productinventory DROP `thisstock`;
ALTER TABLE jibres_XXXXXXX.productinventory DROP `manualcount`;



ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `count2` `count` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `stock2` `stock` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `thisstock2` `thisstock` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `manualcount2` `manualcount` DECIMAL(20, 4) NULL DEFAULT NULL;
