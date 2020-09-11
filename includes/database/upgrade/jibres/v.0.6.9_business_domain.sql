CREATE TABLE IF NOT EXISTS jibres.business_domain (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain` VARCHAR(150) NULL,
`domain_id` int(10) UNSIGNED NULL,
`store_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`subdomain` VARCHAR(150) NULL,
`root` VARCHAR(150) NULL,
`tld` VARCHAR(150) NULL,
`master` bit(1) NULL,
`redirecttomaster` bit(1) NULL,
`cdn` enum('arvancloud', 'cloudflare') NULL,
`status` enum('pending', 'failed', 'ok') NULL,
`checkdns` timestamp NULL ,
`cdnpanel` timestamp NULL ,
`httpsrequest` timestamp NULL ,
`httpsverify` bit(1) NULL ,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
KEY `business_domain_index_domain` (`domain`),
KEY `business_domain_index_checkdns` (`checkdns`),
KEY `business_domain_index_store_id` (`store_id`),
KEY `business_domain_index_domain_id` (`domain_id`),
KEY `business_domain_index_cdnpanel` (`cdnpanel`),
KEY `business_domain_index_httpsrequest` (`httpsrequest`),
KEY `business_domain_index_httpsverify` (`httpsverify`),
KEY `business_domain_index_status` (`status`),
KEY `business_domain_index_master` (`master`),
CONSTRAINT `business_domain_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres.business_domain_dns (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`business_domain_id` int(10) UNSIGNED NULL,
`type` VARCHAR(150) NULL,
`key` VARCHAR(150) NULL,
`value` VARCHAR(1000) NULL,
`verify` bit(1) NULL ,
`status` enum('pending', 'failed', 'ok') NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `business_domain_dns_business_domain_id` FOREIGN KEY (`business_domain_id`) REFERENCES `business_domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres.business_domain_action (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`business_domain_id` int(10) UNSIGNED NULL,
`action` VARCHAR(300) NULL,
`desc` TEXT NULL,
`meta` TEXT NULL,
`datecreated` timestamp NULL ,
`gateway` enum('user', 'cronjob') NULL,
PRIMARY KEY (`id`),
CONSTRAINT `business_domain_action_business_domain_id` FOREIGN KEY (`business_domain_id`) REFERENCES `business_domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
