CREATE TABLE IF NOT EXISTS jibres.csrf (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`token` CHAR(32) NULL,
`urlmd5` CHAR(32) NULL,
`status` enum('active', 'used','expire', 'deleted', 'disabled', 'block') NULL,
`url` text NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),
KEY `jibres_csrf_status` (`status`),
KEY `jibres_csrf_token` (`token`),
KEY `jibres_csrf_urlmd5` (`urlmd5`),
KEY `jibres_csrf_datemodified` (`datemodified`),
KEY `jibres_csrf_check` (`token`, `urlmd5`, `status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;