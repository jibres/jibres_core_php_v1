CREATE TABLE IF NOT EXISTS jibres.store_domain (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED DEFAULT NULL,
`domain` varchar(100) DEFAULT NULL,
`subdomain` varchar(100) DEFAULT NULL,
`root` varchar(100) DEFAULT NULL,
`tld` varchar(100) DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `index_search_domain` (`domain`),
CONSTRAINT `store_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_domain_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
