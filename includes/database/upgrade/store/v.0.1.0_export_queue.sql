CREATE TABLE `jibres_XXXXXXX`.`export` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`type` varchar(200) DEFAULT NULL,
`file` varchar(500) DEFAULT NULL,
`creator` int(10) UNSIGNED DEFAULT NULL,
`meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`status` enum('request','cancel', 'expire','running', 'done','failed','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `export_field_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;