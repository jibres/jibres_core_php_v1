CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`terms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language` char(2) DEFAULT NULL,
  `type` enum('cat','tag','code','other','term','support_tag','mag','mag_tag','help','help_tag') DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `desc` mediumtext CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','deleted') NOT NULL DEFAULT 'enable',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `terms_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `terms_type_search_index` (`type`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
