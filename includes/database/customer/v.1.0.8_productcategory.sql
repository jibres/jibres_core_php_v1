CREATE TABLE `jibres_XXXXXXX`.`productcategory` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(500) DEFAULT NULL,
`slug` varchar(200) DEFAULT NULL,
`language` char(2) DEFAULT NULL,
`properties` text CHARACTER SET utf8mb4,
`desc` text CHARACTER SET utf8mb4,
`seotitle` varchar(300) DEFAULT NULL,
`seodesc` varchar(500) DEFAULT NULL,
`file_id` int(10) UNSIGNED DEFAULT NULL,
`parent` int(10) UNSIGNED DEFAULT NULL,
`status` enum('enable','disable','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;