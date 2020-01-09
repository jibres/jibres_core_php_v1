ALTER TABLE `jibres_XXXXXXX`.`factors` CHANGE `vat` `detailvat` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`factordetails` CHANGE `vat` `vat` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `jibres_XXXXXXX`.`productcategory` CHANGE `file_id` `file` varchar(500)  NULL DEFAULT NULL;
