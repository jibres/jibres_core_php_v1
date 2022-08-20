
ALTER TABLE jibres.store_data ADD `plan` varchar(100) NULL DEFAULT NULL AFTER `title`;
ALTER TABLE jibres.store_data ADD `planexp` datetime NULL DEFAULT NULL AFTER `plan`;

CREATE TABLE jibres.store_plan_history (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`store_id` int unsigned NOT NULL,
`user_id` int unsigned DEFAULT NULL,
`plan` varchar(100) DEFAULT NULL,
`startdate` datetime NULL DEFAULT NULL,
`expirydate` datetime NULL DEFAULT NULL,
`type` enum('public', 'enterprise') DEFAULT NULL,
`action` enum('set', 'extends', 'upgrade', 'downgrade') DEFAULT NULL,
`status` enum('active', 'deactive') DEFAULT NULL,
`reason` text NULL DEFAULT NULL,
`periodtype` enum('monthly', 'yearly', 'custom') DEFAULT NULL,
`setby` enum('customer', 'admin', 'system') DEFAULT NULL,
`days` int NULL DEFAULT NULL,
`price` decimal(13, 4) DEFAULT NULL,
`discount` decimal(13, 4) DEFAULT NULL,
`vat` decimal(13, 4) DEFAULT NULL,
`finalprice` decimal(13, 4) DEFAULT NULL,
`currency` varchar(50) NULL DEFAULT NULL,
`giftusage_id` bigint unsigned DEFAULT NULL,
`previous_plan_id` bigint unsigned DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
INDEX `store_plan_action_plan` (`plan`),
INDEX `store_plan_expirydate` (`expirydate`),
INDEX `store_plan_detect` (`store_id`, `status`),
KEY `store_plan_action_creator` (`user_id`),
CONSTRAINT `store_plan_action_giftusage_id` FOREIGN KEY (`giftusage_id`) REFERENCES `giftusage` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_plan_action_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_plan_action_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

