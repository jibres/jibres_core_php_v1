CREATE TABLE IF NOT EXISTS jibres_nic.contactdetail (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`nic_id` varchar(300) NULL DEFAULT NULL,
`person` varchar(500) NULL DEFAULT NULL,
`email` varchar(500) NULL DEFAULT NULL,
`address` text NULL DEFAULT NULL,
`phone` varchar(300) NULL DEFAULT NULL,
`mobile` varchar(15) NULL DEFAULT NULL,
`fax` varchar(300) NULL DEFAULT NULL,
`org` varchar(500) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `contactdetail_nic_id` (`nic_id`),
KEY `contactdetail_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
