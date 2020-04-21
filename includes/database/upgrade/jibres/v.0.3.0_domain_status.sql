
CREATE TABLE IF NOT EXISTS jibres_nic.domainstatus (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`domain` varchar(300) NULL DEFAULT NULL,
`status` varchar(100) NULL DEFAULT NULL,
`active` bit(1) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `domainstatus_domain` (`domain`),
KEY `domainstatus_status` (`status`),
KEY `domainstatus_active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;