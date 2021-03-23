CREATE TABLE `jibres_XXXXXXX`.`importexport` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`type` varchar(200) DEFAULT NULL,
`related` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`related_id` bigint NULL DEFAULT NULL,
`mode` enum('import', 'export') DEFAULT NULL,
`file` varchar(500) DEFAULT NULL,
`creator` int(10) UNSIGNED DEFAULT NULL,
`meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`status` enum('awaiting','request','cancel', 'expire','running', 'done','failed','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `importexport_field_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;