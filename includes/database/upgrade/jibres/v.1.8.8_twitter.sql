CREATE TABLE jibres_api_log.twitter (

`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` bigint NULL DEFAULT NULL,
`identify` text NULL DEFAULT NULL,
`request_type` varchar(200) DEFAULT NULL,
`user_id` text DEFAULT NULL,
`username` varchar(200) DEFAULT NULL,
`status` enum('enable', 'disable', 'expire', 'used', 'deleted') DEFAULT NULL,
`send` mediumtext DEFAULT NULL,
`receive` mediumtext DEFAULT NULL,
`meta` mediumtext DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `index_search_twitter_store_id` (`store_id`),
KEY `index_search_twitter_status` (`status`),
KEY `index_search_twitter_request_type` (`request_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;