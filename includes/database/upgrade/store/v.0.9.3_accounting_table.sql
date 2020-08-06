CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_coding (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`code` int(10) NULL,
`title` varchar(200) NULL,
`parent1` int(10) UNSIGNED NULL,
`parent2` int(10) UNSIGNED NULL,
`parent3` int(10) UNSIGNED NULL,
`status` enum('enable','disable', 'deleted') DEFAULT NULL,
`nature` enum('debtor','creditor','debtor-creditor','balance sheet','disciplinary','harmful profit') DEFAULT NULL,
`detailable` bit(1)  NULL,
`type` enum('group','total','assistant','details') DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
KEY `tax_coding_search_index_parent1` (`parent1`),
KEY `tax_coding_search_index_parent2` (`parent2`),
KEY `tax_coding_search_index_parent3` (`parent3`),
KEY `tax_coding_search_index_code` (`code`),
KEY `tax_coding_search_index_title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_document (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`number` bigint(20) NULL,
`date` date NULL,
`desc` varchar(300) NULL,
`status` enum('lock','temp') DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
KEY `tax_document_search_index_number` (`number`),
KEY `tax_document_search_index_status` (`status`),
KEY `tax_document_search_index_date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_docdetail (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`tax_document_id` int(10) UNSIGNED NULL,
`assistant_id` int(10) UNSIGNED NULL,
`details_id` int(10) UNSIGNED NULL,
`desc` varchar(300) NULL,
`debtor` bigint(20) NULL,
`creditor` bigint(20) NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `tax_docdetail_tax_document_id` FOREIGN KEY (`tax_document_id`) REFERENCES `tax_document` (`id`) ON UPDATE CASCADE,
CONSTRAINT `tax_docdetail_details_id` FOREIGN KEY (`details_id`) REFERENCES `tax_coding` (`id`) ON UPDATE CASCADE,
CONSTRAINT `tax_docdetail_assistant_id` FOREIGN KEY (`assistant_id`) REFERENCES `tax_coding` (`id`) ON UPDATE CASCADE,
KEY `tax_docdetail_search_index_debtor` (`debtor`),
KEY `tax_docdetail_search_index_creditor` (`creditor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
