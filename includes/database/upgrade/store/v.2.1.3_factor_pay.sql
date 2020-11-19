UPDATE jibres_XXXXXXX.factors SET factors.paystatus = 'successful_payment' WHERE factors.pay = 1;
ALTER TABLE jibres_XXXXXXX.factors DROP `pay`;
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_index_paystatus` (`paystatus`);