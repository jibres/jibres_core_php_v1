ALTER TABLE jibres_nic_log.log ADD `result` text  NULL DEFAULT NULL;

DROP TABLE jibres_nic.domain_action;
DROP TABLE jibres_nic.domain_billing;




CREATE TABLE IF NOT EXISTS jibres_nic.domainaction (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,

`domain_id` int(10) UNSIGNED NULL,
`user_id` int(10) UNSIGNED NULL,

`status` enum('enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL,
`action` enum('register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire') NULL DEFAULT NULL,
`mode` enum('auto', 'manual') NULL DEFAULT NULL,

`detail` text NULL DEFAULT NULL,

`date` timestamp NULL DEFAULT NULL,

`price` int(10) UNSIGNED NULL DEFAULT NULL,
`discount` int(10) UNSIGNED NULL DEFAULT NULL,

`transaction_id` int(10) UNSIGNED NULL DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
CONSTRAINT `domainaction_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


