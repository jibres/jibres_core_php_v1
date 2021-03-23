CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.csrf (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`token` CHAR(32) NULL,
`urlmd5` CHAR(32) NULL,
`status` enum('active', 'used','expire', 'deleted', 'disabled', 'block') NULL,
`url` text NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
`ip_id` BIGINT UNSIGNED NULL,
`agent_id` INT UNSIGNED NULL,
PRIMARY KEY (`id`),
KEY `jibres_csrf_status` (`status`),
KEY `jibres_csrf_token` (`token`),
KEY `jibres_csrf_urlmd5` (`urlmd5`),
KEY `jibres_csrf_datemodified` (`datemodified`),
KEY `jibres_csrf_check` (`token`, `urlmd5`, `status`),
INDEX `csrf_search_index_ip_id` (`ip_id`),
INDEX `csrf_search_index_agent_id` (`agent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;