CREATE TABLE `sync` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(200) DEFAULT NULL,
`query` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
`fuel` varchar(100) DEFAULT NULL,
`status` enum('pending','awaiting','success','fail','deleted') DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `index_search_sync_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;