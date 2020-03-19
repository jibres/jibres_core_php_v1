CREATE TABLE `jibres_XXXXXXX`.`app_download` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`platform` enum('android','ios','telegram','website') DEFAULT NULL,
`store_app_id` bigint(20) UNSIGNED  NULL,
`version` smallint(5) UNSIGNED  NULL,
`build` smallint(5) UNSIGNED  NULL,
`user_id` int(10) UNSIGNED  NULL,
`date` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `app_download_index_search_platform` (`platform`),
KEY `app_download_index_search_version` (`version`),
KEY `app_download_index_search_build` (`build`),
KEY `app_download_index_search_date` (`date`),
CONSTRAINT `app_download_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;