CREATE TABLE `jibres_XXXXXXX`.`app_download` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`os` enum('android','ios','windows','linux','bot','other') DEFAULT NULL,
`version` smallint(5) UNSIGNED  NULL,
`build` smallint(5) UNSIGNED  NULL,
`user_id` int(10) UNSIGNED  NULL,
`downloaddate` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `app_download_index_search_os` (`os`),
KEY `app_download_index_search_version` (`version`),
KEY `app_download_index_search_build` (`build`),
KEY `app_download_index_search_downloaddate` (`downloaddate`),
CONSTRAINT `app_download_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;