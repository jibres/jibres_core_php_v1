ALTER TABLE jibres_XXXXXXX.tax_document ADD `template` varchar(100) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD `serialnumber` varchar(100) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD `total` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD `totaldiscount` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD `totalvat` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD `user_id` INT(10) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE jibres_XXXXXXX.tax_docdetail ADD `template` varchar(100) NULL DEFAULT NULL;



ALTER TABLE jibres_XXXXXXX.tax_document ADD INDEX `tax_document_index_template` (`template`);
ALTER TABLE jibres_XXXXXXX.tax_document ADD INDEX `tax_document_index_total` (`total`);
ALTER TABLE jibres_XXXXXXX.tax_document ADD INDEX `tax_document_index_totalvat` (`totalvat`);