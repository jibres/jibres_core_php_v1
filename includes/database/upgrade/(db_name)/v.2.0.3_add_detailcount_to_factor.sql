ALTER TABLE `factors` ADD `item`  bigint(20) unsigned NULL DEFAULT NULL;
ALTER TABLE `factors` CHANGE `detailcount` `qty`  smallint(5) unsigned NULL DEFAULT NULL;

UPDATE factors SET factors.item           = (SELECT COUNT(*) FROM factordetails WHERE factordetails.factor_id = factors.id);


UPDATE factors SET factors.detailsum      = (SELECT SUM(factordetails.price * factordetails.count) FROM factordetails WHERE factordetails.factor_id = factors.id);
UPDATE factors SET factors.detaildiscount = (SELECT SUM(factordetails.discount * factordetails.count) FROM factordetails WHERE factordetails.factor_id = factors.id);
UPDATE factors SET factors.detailtotalsum = factors.detailsum - factors.detaildiscount;
