CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.login (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`code` VARCHAR(200) NOT NULL,
`user_id` int(10) UNSIGNED NULL,
`jibres_user_id` int(10) UNSIGNED NULL,
`ip` VARCHAR(200) NULL,
`ip_id` int(10) UNSIGNED NULL,
`ip_md5` CHAR(32) NULL,
`agent_id` int(10) UNSIGNED NULL,
`agent_md5` CHAR(32) NULL,
`status` enum('active', 'expire', 'logout', 'changepassword', 'deleted', 'hijack', 'changeip', 'changeagent', 'block', 'error') NULL,
`place` enum('jibres', 'subdomain', 'admin', 'customer_domain', 'api_core', 'api_business', 'telegram') NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`),
KEY `jibres_login_code` (`code`),
KEY `jibres_login_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.login_ip (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`login_id` bigint(20) UNSIGNED NULL,
`ip` VARCHAR(200) NULL,
`ip_id` int(10) UNSIGNED NULL,
`agent_id` int(10) UNSIGNED NULL,
`datecreated` timestamp NULL,
`datemodified` timestamp NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
