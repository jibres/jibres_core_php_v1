CREATE TABLE `users` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`username` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`displayname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`gender` enum('male','female') DEFAULT NULL,
`title` varchar(100) DEFAULT NULL,
`password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
`mobile` varchar(15) DEFAULT NULL,
`email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`chatid` int(20) UNSIGNED DEFAULT NULL,
`status` enum('active','awaiting','deactive','removed','filter','unreachable') DEFAULT 'awaiting',
`avatar` varchar(2000) DEFAULT NULL,
`parent` int(10) UNSIGNED DEFAULT NULL,
`permission` varchar(1000) DEFAULT NULL,
`type` varchar(100) DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`pin` smallint(4) UNSIGNED DEFAULT NULL,
`ref` int(10) UNSIGNED DEFAULT NULL,
`twostep` bit(1) DEFAULT NULL,
`birthday` varchar(50) DEFAULT NULL,
`unit_id` smallint(5) DEFAULT NULL,
`language` char(2) DEFAULT NULL,
`meta` mediumtext CHARACTER SET utf8mb4,
`website` varchar(200) DEFAULT NULL,
`facebook` varchar(200) DEFAULT NULL,
`twitter` varchar(200) DEFAULT NULL,
`instagram` varchar(200) DEFAULT NULL,
`linkedin` varchar(200) DEFAULT NULL,
`gmail` varchar(200) DEFAULT NULL,
`sidebar` bit(1) DEFAULT NULL,
`firstname` varchar(100) DEFAULT NULL,
`lastname` varchar(100) DEFAULT NULL,
`bio` text CHARACTER SET utf8mb4,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;