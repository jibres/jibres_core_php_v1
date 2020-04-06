
CREATE TABLE IF NOT EXISTS jibres_nic_log.whois (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_whois_index_search_user_id` (`user_id`),
KEY `log_whois_index_search_datesend` (`datesend`),
KEY `log_whois_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres_nic_log.contact_check (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_contact_check_index_search_user_id` (`user_id`),
KEY `log_contact_check_index_search_datesend` (`datesend`),
KEY `log_contact_check_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.contact_info (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_contact_info_index_search_user_id` (`user_id`),
KEY `log_contact_info_index_search_datesend` (`datesend`),
KEY `log_contact_info_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.contact_create (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_contact_create_index_search_user_id` (`user_id`),
KEY `log_contact_create_index_search_datesend` (`datesend`),
KEY `log_contact_create_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.contact_update (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_contact_update_index_search_user_id` (`user_id`),
KEY `log_contact_update_index_search_datesend` (`datesend`),
KEY `log_contact_update_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_check (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_check_index_search_user_id` (`user_id`),
KEY `log_domain_check_index_search_datesend` (`datesend`),
KEY `log_domain_check_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_lock (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_lock_index_search_user_id` (`user_id`),
KEY `log_domain_lock_index_search_datesend` (`datesend`),
KEY `log_domain_lock_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_unlock (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_unlock_index_search_user_id` (`user_id`),
KEY `log_domain_unlock_index_search_datesend` (`datesend`),
KEY `log_domain_unlock_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_info (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_info_index_search_user_id` (`user_id`),
KEY `log_domain_info_index_search_datesend` (`datesend`),
KEY `log_domain_info_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_create (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_create_index_search_user_id` (`user_id`),
KEY `log_domain_create_index_search_datesend` (`datesend`),
KEY `log_domain_create_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_update (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_update_index_search_user_id` (`user_id`),
KEY `log_domain_update_index_search_datesend` (`datesend`),
KEY `log_domain_update_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_renew (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_renew_index_search_user_id` (`user_id`),
KEY `log_domain_renew_index_search_datesend` (`datesend`),
KEY `log_domain_renew_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_delete (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_delete_index_search_user_id` (`user_id`),
KEY `log_domain_delete_index_search_datesend` (`datesend`),
KEY `log_domain_delete_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.domain_transfer (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_domain_transfer_index_search_user_id` (`user_id`),
KEY `log_domain_transfer_index_search_datesend` (`datesend`),
KEY `log_domain_transfer_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.poll_request (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_poll_request_index_search_user_id` (`user_id`),
KEY `log_poll_request_index_search_datesend` (`datesend`),
KEY `log_poll_request_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_nic_log.poll_acknowledge (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NULL,
`send` text CHARACTER SET utf8mb4 DEFAULT NULL,
`response` text CHARACTER SET utf8mb4 DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`dateresponse` timestamp NULL DEFAULT NULL,
`nic_id` varchar(100) DEFAULT NULL,
`server_id` varchar(100) DEFAULT NULL,
`client_id` varchar(100) DEFAULT NULL,
`result_code` varchar(100) DEFAULT NULL,
`request_count` smallint(5) DEFAULT NULL,
`result` text  NULL DEFAULT NULL,
`runtime` text  NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `log_poll_acknowledge_index_search_user_id` (`user_id`),
KEY `log_poll_acknowledge_index_search_datesend` (`datesend`),
KEY `log_poll_acknowledge_index_search_result_code` (`result_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

