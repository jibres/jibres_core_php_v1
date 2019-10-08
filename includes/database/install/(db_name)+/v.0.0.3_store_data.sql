CREATE TABLE `store_data` (
`id` int(10) UNSIGNED NOT NULL,
`title` varchar(200) CHARACTER SET utf8mb4 NULL,
`owner` int(10) UNSIGNED NOT NULL,
`description` text CHARACTER SET utf8mb4,
`lang` char(2) DEFAULT NULL,
`unit` varchar(50) DEFAULT NULL,
`country` varchar(50) DEFAULT NULL,
`domain1` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`domain2` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`domain3` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`status` enum('enable','disable','deleted','lock','awaiting','block','filter','close') NULL DEFAULT NULL,
`logo` varchar(2000) DEFAULT NULL,
`plan` varchar(50) DEFAULT NULL,
`startplan` timestamp NULL,
`expireplan` timestamp  NULL DEFAULT NULL,
`lastactivity` timestamp NULL DEFAULT NULL,
`dbversion` varchar(50) NULL,
`dbversiondate` datetime NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_data_id` FOREIGN KEY (`id`) REFERENCES `store` (`id`) ON UPDATE CASCADE,
CONSTRAINT `store_data_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
