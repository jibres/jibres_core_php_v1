CREATE TABLE `store` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`subdomain` varchar(50) NULL,
`dbip` int(10) UNSIGNED NULL,
`creator` int(10) UNSIGNED NULL,
`ip` int(10) UNSIGNED NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY(`id`),
CONSTRAINT `store_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
KEY `store_subdomain` (`subdomain`)
) ENGINE=InnoDB AUTO_INCREMENT = 1000000 DEFAULT CHARSET=utf8mb4;
