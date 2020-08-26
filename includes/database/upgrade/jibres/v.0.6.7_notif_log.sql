CREATE TABLE IF NOT EXISTS `log_notif` (
`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`type` enum('ok', 'error', 'warn', 'info') NULL,
`method` VARCHAR(100) NULL,
`message` VARCHAR(255) NULL,
`messagemd5` CHAR(32) NULL,
`user_id` INT(10) UNSIGNED NULL,
`urlkingdom` VARCHAR(255) NULL,
`urldir` VARCHAR(255) NULL,
`urlquery` VARCHAR(255) NULL,
`datecreated` timestamp NULL ,
`meta` text NULL,
PRIMARY KEY (`id`),
KEY `log_notif_search_index_messagemd5` (`messagemd5`),
KEY `log_notif_search_index_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
