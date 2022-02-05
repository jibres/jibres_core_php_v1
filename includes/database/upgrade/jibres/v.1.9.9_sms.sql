CREATE TABLE IF NOT EXISTS jibres_api_log.store_sms (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` INT UNSIGNED NULL,
`local_id` BIGINT UNSIGNED NULL,
`package_id` BIGINT UNSIGNED NULL,
`mobile` varchar(50) NULL DEFAULT NULL,
`message` text NULL DEFAULT NULL,
`len` INT NULL DEFAULT NULL,
`smscount` smallint DEFAULT NULL,
`mode` enum('sms', 'call','tts') NULL,
`type` enum('signup', 'login','twostep', 'twostepset', 'twostepunset', 'deleteaccount', 'recovermobile', 'callback_signup', 'changepassword', 'notif', 'other') NULL,
`status` enum('pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
`sender` enum('system','admin', 'customer') DEFAULT NULL,
`provider` varchar(50) NULL DEFAULT NULL,
`line` varchar(100) NULL DEFAULT NULL,
`apikey` text NULL DEFAULT NULL,
`send` text NULL DEFAULT NULL,
`response` text NULL DEFAULT NULL,
`amount` decimal(13, 4) NULL DEFAULT NULL,
`cost` decimal(13, 4) NULL DEFAULT NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),
INDEX `store_sms_store_id` (`store_id`),
INDEX `store_sms_local_id` (`local_id`),
INDEX `store_sms_package_id` (`package_id`),
INDEX `store_sms_status` (`status`),
INDEX `store_sms_smscount` (`smscount`),
INDEX `store_sms_mode` (`mode`),
INDEX `store_sms_len` (`len`),
INDEX `store_sms_mobile` (`mobile`),
INDEX `store_sms_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
