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
`topic` varchar(200) NULL DEFAULT NULL,
`class` varchar(200) NULL DEFAULT NULL,
`naturecontrol` BIT(1) NULL DEFAULT NULL,
`exchangeable` BIT(1) NULL DEFAULT NULL,
`followup` BIT(1) NULL DEFAULT NULL,
`currency` BIT(1) NULL DEFAULT NULL,
`naturegroup` enum('balance sheet','disciplinary','harmful profit') DEFAULT NULL,
`balancetype` enum('debtor','creditor','debtor-creditor') DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `tax_coding_search_index_parent1` (`parent1`),
KEY `tax_coding_search_index_parent2` (`parent2`),
KEY `tax_coding_search_index_parent3` (`parent3`),
KEY `tax_coding_search_index_code` (`code`),
KEY `tax_coding_search_index_title` (`title`),
KEY `tax_coding_search_index_topic` (`topic`),
KEY `tax_coding_search_index_class` (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_document (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`number` bigint(20) NULL,
`date` date NULL,
`desc` varchar(300) NULL,
`status`  enum('draft', 'lock','temp') DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
`year_id` smallint UNSIGNED NULL DEFAULT NULL,
`gallery` TEXT DEFAULT NULL,
`type` enum('normal', 'opening', 'closing') DEFAULT 'normal',
`subnumber` int(10) NULL  DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `tax_document_search_index_number` (`number`),
KEY `tax_document_search_index_status` (`status`),
KEY `tax_document_search_index_date` (`date`),
CONSTRAINT `tax_document_year_id` FOREIGN KEY (`year_id`) REFERENCES `tax_year` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_docdetail (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`tax_document_id` int(10) UNSIGNED NULL,
`assistant_id` int(10) UNSIGNED NULL,
`details_id` int(10) UNSIGNED NULL,
`desc` varchar(300) NULL,
`debtor` DECIMAL(20,4) NULL DEFAULT NULL,
`creditor` DECIMAL(20,4) NULL DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
`year_id` smallint UNSIGNED NULL DEFAULT NULL,
`sort` INT NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `tax_docdetail_tax_document_id` FOREIGN KEY (`tax_document_id`) REFERENCES `tax_document` (`id`) ON UPDATE CASCADE,
CONSTRAINT `tax_docdetail_details_id` FOREIGN KEY (`details_id`) REFERENCES `tax_coding` (`id`) ON UPDATE CASCADE,
CONSTRAINT `tax_docdetail_assistant_id` FOREIGN KEY (`assistant_id`) REFERENCES `tax_coding` (`id`) ON UPDATE CASCADE,
CONSTRAINT `tax_docdetail_year_id` FOREIGN KEY (`year_id`) REFERENCES `tax_year` (`id`) ON UPDATE CASCADE,
KEY `tax_docdetail_search_index_debtor` (`debtor`),
KEY `tax_docdetail_search_index_creditor` (`creditor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_year (
`id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(300) NULL,
`startdate` date NULL,
`enddate` date NULL,
`status` enum('lock','enable') DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
`isdefault` bit(1) NULL DEFAULT NULL,
`closing` text NULL DEFAULT NULL,
`opening` text NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `tax_year_search_index_number` (`title`),
KEY `tax_year_search_index_status` (`status`),
KEY `tax_year_search_index_startdate` (`startdate`),
KEY `tax_year_search_index_enddate` (`enddate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;