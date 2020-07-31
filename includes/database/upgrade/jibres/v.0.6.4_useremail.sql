CREATE TABLE jibres.useremail (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`email` varchar(200) NULL,
`status` enum('enable','disable','filter','spam','delete') NULL DEFAULT 'enable',
`verify` bit(1) NULL,
`primary` bit(1) NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
KEY `useremail_index_search_email` (`email`),
KEY `useremail_index_search_primary` (`primary`),
KEY `useremail_index_search_verify` (`verify`),
PRIMARY KEY (`id`),
CONSTRAINT `useremail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
