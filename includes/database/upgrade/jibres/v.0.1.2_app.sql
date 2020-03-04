CREATE TABLE jibres.store_app (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED NOT NULL,
`version` smallint(5) UNSIGNED NULL DEFAULT NULL,
`status` enum('queue','inprogress','done','failed', 'disable', 'expire', 'cancel', 'delete', 'enable') DEFAULT NULL,
`daterequest` timestamp NULL DEFAULT NULL,
`datequeue` timestamp NULL DEFAULT NULL,
`datedone` timestamp NULL DEFAULT NULL,
`datedownload` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `index_search_store_app_status` (`status`),
CONSTRAINT `store_app_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;