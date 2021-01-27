ALTER TABLE jibres_XXXXXXX.sms_log CHANGE `status` `status` enum('pending', 'sending', 'send', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.sms_log ADD `sender` enum('system','admin', 'customer') DEFAULT NULL AFTER `status`;
ALTER TABLE jibres_XXXXXXX.sms_log ADD KEY `smslog_sender` (`sender`);
UPDATE jibres_XXXXXXX.sms_log SET sms_log.status = 'send';


CREATE TABLE jibres_XXXXXXX.email_log (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`provider` varchar(50) DEFAULT NULL,
`email` varchar(200) DEFAULT NULL,
`template` varchar(100) DEFAULT NULL,
`content` text,
`type` enum('signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other') DEFAULT NULL,
`status` enum('pending', 'sending', 'send', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL,
`user_id` int UNSIGNED DEFAULT NULL,
`url` text,
`urlmd5` char(32) DEFAULT NULL,
`ip_id` int UNSIGNED DEFAULT NULL,
`agent_id` int UNSIGNED DEFAULT NULL,
`send` text,
`response` text,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `emaillog_status` (`status`),
KEY `emaillog_template` (`template`),
KEY `emaillog_email` (`email`),
KEY `emaillog_urlmd5` (`urlmd5`),
KEY `emaillog_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
