CREATE TABLE IF NOT EXISTS jibres_api_log.telegram (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

`store_id` INT UNSIGNED NULL,
`store_telegramlog_id` BIGINT UNSIGNED NULL,

`chatid` varchar(100) NULL DEFAULT NULL,
`type` varchar(100) NULL,
`status` enum('register', 'pending','sending','expired', 'moneylow', 'unknown', 'send', 'sended','queue','failed','cancel','block','other') DEFAULT NULL,
`method` varchar(100) NULL DEFAULT NULL,
`send` mediumtext NULL DEFAULT NULL,
`response` mediumtext NULL DEFAULT NULL,

`dateregister` timestamp NULL,
`datesend` timestamp NULL,
`dateresponse` timestamp NULL,

`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),

INDEX `telegram_store_id` (`store_id`),
INDEX `telegram_store_telegramlog_id` (`store_telegramlog_id`),
INDEX `telegram_status` (`status`),
INDEX `telegram_chatid` (`chatid`),
INDEX `telegram_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_api_log.telegram_sending (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
`telegram_id` bigint UNSIGNED NOT NULL,
`status` enum('pending','sending','done') DEFAULT NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),
INDEX `telegram_sending_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
