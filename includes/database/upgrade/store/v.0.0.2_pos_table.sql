CREATE TABLE `jibres_XXXXXXX`.`pos` (
`id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(200) DEFAULT NULL,
`slug` varchar(100) DEFAULT NULL,
`isdefault` bit(1) NULL DEFAULT NULL,
`pcpos` bit(1) NULL DEFAULT NULL,
`setting` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`status` enum('enable','disable','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;