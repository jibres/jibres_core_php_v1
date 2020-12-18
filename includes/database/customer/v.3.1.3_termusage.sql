CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`termusages` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`term_id` int(10) UNSIGNED NOT NULL,
`post_id` bigint(20) UNSIGNED NOT NULL,
`type` enum('cat','tag') DEFAULT NULL,
`sort` smallint(5) UNSIGNED DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `termusages_type_search_index` (`type`),
KEY `termusages_index_post_id` (`post_id`),
KEY `termusages_index_term_id` (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;