CREATE TABLE jibres_api_log.sms_charge (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`store_id` int unsigned NOT NULL,
`user_id` int unsigned DEFAULT NULL,
`transaction_id` bigint unsigned DEFAULT NULL,
`amount` decimal(13, 4) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
INDEX `sms_charge_index_search_store_id` (`store_id`),
INDEX `sms_charge_index_search_amount` (`amount`),
INDEX `sms_charge_index_search` (`store_id`, `amount`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

