CREATE TABLE jibres_api_log.instagram (

`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` bigint NULL DEFAULT NULL,
`app_id` varchar(200) NULL DEFAULT NULL,
`token` varchar(50) NULL DEFAULT NULL,
`pwd` text DEFAULT NULL,

`request_type` varchar(200) DEFAULT NULL,

`access_token` text DEFAULT NULL,
`user_id` text DEFAULT NULL,
`username` varchar(200) DEFAULT NULL,

`status` enum('enable', 'disable', 'expire', 'used', 'deleted') DEFAULT NULL,

`send` mediumtext DEFAULT NULL,
`receive` mediumtext DEFAULT NULL,
`meta` mediumtext DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`expiredate` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `index_search_instagram_token` (`token`),
KEY `index_search_instagram_store_id` (`store_id`),
KEY `index_search_instagram_status` (`status`),
KEY `index_search_instagram_request_type` (`request_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;