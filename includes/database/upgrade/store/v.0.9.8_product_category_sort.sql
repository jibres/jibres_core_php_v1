CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.tax_year (
`id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(300) NULL,
`startdate` date NULL,
`enddate` date NULL,
`status` enum('lock','enable') DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
KEY `tax_year_search_index_number` (`title`),
KEY `tax_year_search_index_status` (`status`),
KEY `tax_year_search_index_startdate` (`startdate`),
KEY `tax_year_search_index_enddate` (`enddate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_XXXXXXX.tax_docdetail ADD `year_id` smallint UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tax_docdetail ADD CONSTRAINT `tax_docdetail_year_id` FOREIGN KEY (`year_id`) REFERENCES `tax_year` (`id`) ON UPDATE CASCADE;

ALTER TABLE jibres_XXXXXXX.tax_docdetail ADD `sort` INT NULL DEFAULT NULL;

