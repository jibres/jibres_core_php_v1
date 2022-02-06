CREATE TABLE IF NOT EXISTS jibres_api_log.sms (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` INT UNSIGNED NULL,
`local_id` BIGINT UNSIGNED NULL,
`package_id` BIGINT UNSIGNED NULL,
`mobile` varchar(50) NULL DEFAULT NULL,
`message` text NULL DEFAULT NULL,
`len` INT NULL DEFAULT NULL,
`smscount` smallint DEFAULT NULL,
`mode` enum('sms', 'call','tts') NULL,
`type` enum('register', 'pending','sending','expired', 'lowbalance', 'unknown', 'send', 'sended','delivered','queue','failed','undelivered','cancel','block','other') NULL,
`status` enum('pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
`sender` enum('system','admin', 'customer') DEFAULT NULL,
`provider` varchar(50) NULL DEFAULT NULL,
`line` varchar(100) NULL DEFAULT NULL,
`apikey` text NULL DEFAULT NULL,
`send` text NULL DEFAULT NULL,
`template` varchar(100) NULL DEFAULT NULL,
`response` text NULL DEFAULT NULL,
`amount` decimal(13, 4) NULL DEFAULT NULL,
`cost` decimal(13, 4) NULL DEFAULT NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),
INDEX `sms_store_id` (`store_id`),
INDEX `sms_local_id` (`local_id`),
INDEX `sms_package_id` (`package_id`),
INDEX `sms_status` (`status`),
INDEX `sms_smscount` (`smscount`),
INDEX `sms_mode` (`mode`),
INDEX `sms_len` (`len`),
INDEX `sms_mobile` (`mobile`),
INDEX `sms_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE jibres.sms_log DROP `mobiles`;
ALTER TABLE jibres.sms_log CHANGE `status` `status` enum('register', 'pending','sending','expired', 'lowbalance', 'unknown', 'send', 'sended','delivered','queue','failed','undelivered','cancel','block','other') NULL DEFAULT NULL;
ALTER TABLE jibres.sms_log ADD `template` varchar(100) NULL DEFAULT NULL;
/