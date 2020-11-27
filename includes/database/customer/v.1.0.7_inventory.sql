CREATE TABLE `jibres_XXXXXXX`.`inventory` (
`id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
`name` varchar(200) DEFAULT NULL,
`address_id` bigint(20) UNSIGNED DEFAULT NULL,
`default` bit(1) DEFAULT NULL,
`online` bit(1) DEFAULT NULL,
`sale` bit(1) DEFAULT NULL,
`sort` smallint(3) DEFAULT NULL,
`status` enum('enable','disable','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
