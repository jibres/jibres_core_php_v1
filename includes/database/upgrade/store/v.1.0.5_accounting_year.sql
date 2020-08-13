ALTER TABLE jibres_XXXXXXX.tax_year ADD `isdefault` bit(1) NULL DEFAULT NULL;


ALTER TABLE jibres_XXXXXXX.tax_document ADD `year_id` smallint UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_document ADD CONSTRAINT `tax_document_year_id` FOREIGN KEY (`year_id`) REFERENCES `tax_year` (`id`) ON UPDATE CASCADE;


ALTER TABLE jibres_XXXXXXX.tax_coding ADD `naturegroup` enum('balance sheet','disciplinary','harmful profit') DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_coding ADD `balancetype` enum('debtor','creditor','debtor-creditor') DEFAULT NULL;