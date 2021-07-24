ALTER TABLE jibres_XXXXXXX.tax_document ADD `producttitle` text NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD `totalnotincludevat` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD INDEX `tax_document_index_totalnotincludevat` (`totalnotincludevat`);
ALTER TABLE jibres_XXXXXXX.tax_year ADD `vatsetting` text NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_year ADD `remainvatlastyear` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_year ADD `quorumprice` DECIMAL(20, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_year ADD `lock` bit(1) NULL DEFAULT NULL;