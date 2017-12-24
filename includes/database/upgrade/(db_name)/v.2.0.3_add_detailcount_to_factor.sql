ALTER TABLE `factors` ADD `item`  bigint(20) unsigned NULL DEFAULT NULL;
ALTER TABLE `factors` CHANGE `detailcount` `qty`  smallint(5) unsigned NULL DEFAULT NULL;

UPDATE factors SET factors.item = (SELECT COUNT(*) FROM factordetails WHERE factordetails.factor_id = factors.id);


