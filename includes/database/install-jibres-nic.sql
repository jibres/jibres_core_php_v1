
CREATE DATABASE IF NOT EXISTS `jibres_nic_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_nic_log`;

CREATE TABLE IF NOT EXISTS `log` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`type` enum(
	'whois',
	'contact_check',
	'contact_info',
	'contact_create',
	'contact_update',
	'domain_check',
	'domain_info',
	'domain_create',
	'domain_update',
	'domain_renew',
	'domain_delete',
	'poll_request',
	'poll_acknowledge'
	) DEFAULT NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`result` text CHARACTER SET utf8mb4 DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE DATABASE IF NOT EXISTS `jibres_nic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_nic`;

CREATE TABLE IF NOT EXISTS `contact` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`nic_id` varchar(100) NULL DEFAULT NULL,
`roid` varchar(100) NULL DEFAULT NULL,
`holder` bit(1) NULL DEFAULT NULL,
`admin` bit(1) NULL DEFAULT NULL,
`tech` bit(1) NULL DEFAULT NULL,
`bill` bit(1) NULL DEFAULT NULL,
`email` varchar(200) NULL DEFAULT NULL,
`isdefault` bit(1) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `contact_index_search_nic_id` (`nic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




