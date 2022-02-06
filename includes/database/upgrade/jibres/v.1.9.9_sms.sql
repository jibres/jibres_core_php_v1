CREATE TABLE IF NOT EXISTS jibres_api_log.sms (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

`store_id` INT UNSIGNED NULL,
`store_smslog_id` BIGINT UNSIGNED NULL,

`mobile` varchar(50) NULL DEFAULT NULL,
`message` text NULL DEFAULT NULL,

`mode` enum('sms', 'call','tts') NULL,
`type` enum('signup', 'login','twostep', 'twostepset', 'twostepunset', 'deleteaccount', 'recovermobile', 'callback_signup', 'changepassword', 'notif', 'other')  NULL,
`status` enum('register', 'pending','sending','expired', 'moneylow', 'unknown', 'send', 'sended','delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
`sender` enum('system','admin', 'customer') DEFAULT NULL,


`provider` varchar(50) NULL DEFAULT NULL,
`line` varchar(100) NULL DEFAULT NULL,
`apikey` text NULL DEFAULT NULL,
`send` text NULL DEFAULT NULL,
`template` varchar(100) NULL DEFAULT NULL,
`response` text NULL DEFAULT NULL,
`responsecode` smallint NULL DEFAULT NULL,
`provider_status` varchar(100) NULL DEFAULT NULL,
`provider_messageid` varchar(100) NULL DEFAULT NULL,
`provider_sender` varchar(100) NULL DEFAULT NULL,
`provider_receptor` VARCHAR(100) NULL DEFAULT NULL,
`provider_date` datetime NULL DEFAULT NULL,
`provider_cost` decimal(13, 4) NULL DEFAULT NULL,
`provider_currency` VARCHAR(50) NULL DEFAULT NULL,
`provider_deliverstatus` varchar(100) NULL DEFAULT NULL,

`len` INT NULL DEFAULT NULL,
`smscount` smallint DEFAULT NULL,
`package_id` BIGINT UNSIGNED NULL,
`amount` decimal(13, 4) NULL DEFAULT NULL,
`currency` VARCHAR(50) NULL DEFAULT NULL,

`dateregister` timestamp NULL,
`datesend` timestamp NULL,
`dateresponse` timestamp NULL,
`datedeliver` timestamp NULL,
`datestoresync` timestamp NULL,


`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),

INDEX `sms_store_id` (`store_id`),
INDEX `sms_store_smslog_id` (`store_smslog_id`),
INDEX `sms_provider_messageid` (`provider_messageid`),
INDEX `sms_package_id` (`package_id`),
INDEX `sms_status` (`status`),
INDEX `sms_smscount` (`smscount`),
INDEX `sms_mobile` (`mobile`),
INDEX `sms_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE jibres.sms_log DROP `mobiles`;
ALTER TABLE jibres.sms_log CHANGE `status` `status` enum('register', 'pending','sending','expired', 'moneylow', 'unknown', 'send', 'sended','delivered','queue','failed','undelivered','cancel','block','other') NULL DEFAULT NULL;
ALTER TABLE jibres.sms_log ADD `template` varchar(100) NULL DEFAULT NULL;



CREATE TABLE IF NOT EXISTS jibres_api_log.sms_sending (
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
`sms_id` bigint UNSIGNED NOT NULL,
`status` enum('pending','sending','done') DEFAULT NULL,
`datecreated` timestamp NULL,
PRIMARY KEY (`id`),
INDEX `sms_sending_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
