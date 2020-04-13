
CREATE TABLE IF NOT EXISTS jibres_nic.domainbilling (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,
`action` enum('register', 'renew', 'transfer', 'delete') NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
`mode` enum('auto', 'manual') NULL DEFAULT NULL,
`detail` text NULL DEFAULT NULL,
`date` timestamp NULL DEFAULT NULL,
`price` int(10) UNSIGNED NULL DEFAULT NULL,
`discount` int(10) UNSIGNED NULL DEFAULT NULL,
`transaction_id` int(10) UNSIGNED NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `domainbilling_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_nic.domainaction ADD `category` VARCHAR(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainaction ADD `domainname` VARCHAR(300) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domainaction CHANGE `action` `action` VARCHAR(200) NULL DEFAULT NULL;
