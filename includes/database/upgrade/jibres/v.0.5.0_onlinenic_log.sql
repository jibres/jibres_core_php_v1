
CREATE DATABASE IF NOT EXISTS `jibres_onlinenic_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS jibres_onlinenic_log.log (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`type` enum(
		'checkDomain',
		'registerDomain',
		'renewDomain',
		'queryTransferStatus',
		'cancelDomainTransfer',
		'getAuthCode',
		'updateAuthCode',
		'infoDomain',
		'updateDomainStatus',
		'updateDomainDns',
		'setDomainPassword',
		'createContact',
		'infoContact',
		'domainChangeContact',
		'updateContact'
	) DEFAULT NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`domain` varchar(200) DEFAULT NULL,
`ip` varchar(50) DEFAULT NULL,
`gateway` enum('system','user','api') DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `onlinenic_log_index_search_type` (`type`),
KEY `onlinenic_log_index_search_user_id` (`user_id`),
KEY `onlinenic_log_index_search_datesend` (`datesend`),
KEY `onlinenic_log_index_search_domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



