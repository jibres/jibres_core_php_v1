CREATE TABLE `jibres_XXXXXXX`.`funds` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(500) NOT NULL,
`slug` varchar(200) DEFAULT NULL,
`initialbalance` bigint(20) UNSIGNED DEFAULT NULL,
`status` enum('enable','disable','delete','trash') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`pos` text CHARACTER SET utf8mb4,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;