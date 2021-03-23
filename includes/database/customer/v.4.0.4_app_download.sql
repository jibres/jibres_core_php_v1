CREATE TABLE `jibres_XXXXXXX`.`app_download` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`os` enum('android','ios','windows','linux','bot','other') DEFAULT NULL,
`version` smallint(5) UNSIGNED  NULL,
`build` smallint(5) UNSIGNED  NULL,
`user_id` int(10) UNSIGNED  NULL,
`datedownload` timestamp NULL DEFAULT NULL,
`ip_id` BIGINT UNSIGNED NULL,
`agent_id` INT UNSIGNED NULL,
PRIMARY KEY (`id`),
KEY `app_download_index_search_os` (`os`),
KEY `app_download_index_search_version` (`version`),
KEY `app_download_index_search_build` (`build`),
KEY `app_download_index_search_datedownload` (`datedownload`),
CONSTRAINT `app_download_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;