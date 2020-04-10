ALTER TABLE jibres_nic_log.log ADD KEY `log_index_search_user_id` (`user_id`);
ALTER TABLE jibres_nic_log.log ADD KEY `log_index_search_datesend` (`datesend`);


CREATE TABLE IF NOT EXISTS jibres_nic_log.domains (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain` varchar(300) DEFAULT NULL,
`root` varchar(300) DEFAULT NULL,
`tld` varchar(300) DEFAULT NULL,
`domainlen` smallint(5) DEFAULT NULL,
`registrar` varchar(200) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`dateregister` timestamp NULL DEFAULT NULL,
`dateexpire` timestamp NULL DEFAULT NULL,
`dateupdate` timestamp NULL DEFAULT NULL,
`ns1` varchar(200) NULL DEFAULT NULL,
`ns2` varchar(200) NULL DEFAULT NULL,
`ns3` varchar(200) NULL DEFAULT NULL,
`ns4` varchar(200) NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `domains_index_search_domain` (`domain`),
KEY `domains_index_search_root` (`root`),
KEY `domains_index_search_tld` (`tld`),
KEY `domains_index_search_datecreated` (`datecreated`),
KEY `domains_index_search_dateexpire` (`dateexpire`),
KEY `domains_index_search_domainlen` (`domainlen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE IF NOT EXISTS jibres_nic_log.domainactivity (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain_id` bigint(20) UNSIGNED DEFAULT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`type` varchar(200) NULL DEFAULT NULL,
`result` text NULL DEFAULT NULL,
`runtime` text NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `domainactivity_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON UPDATE CASCADE,
KEY `domainactivity_index_search_type` (`type`),
KEY `domainactivity_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;