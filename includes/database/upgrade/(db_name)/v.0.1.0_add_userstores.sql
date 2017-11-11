CREATE TABLE `userstores` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED NOT NULL,
`type` varchar(50) DEFAULT NULL,
`permission` varchar(2000) DEFAULT NULL,
`avatar` varchar(2000) DEFAULT NULL,
`postion` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`displayname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
`status` enum('active','deactive','disable','filter','leave','delete','parent','suspended') NOT NULL DEFAULT 'active',
`desc` text CHARACTER SET utf8mb4,
`datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `user_id` (`user_id`,`store_id`),
CONSTRAINT `userstores_team_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE,
CONSTRAINT `userstores_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `contacts` ADD `store_id` INT(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `contacts` ADD CONSTRAINT `contacts_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;
