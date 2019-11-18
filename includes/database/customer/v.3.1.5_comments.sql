CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `minus` int(10) UNSIGNED DEFAULT NULL,
  `plus` int(10) UNSIGNED DEFAULT NULL,
  `star` smallint(5) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `index_search_star` (`star`),
  KEY `index_search_minus` (`minus`),
  KEY `index_search_plus` (`plus`),
  KEY `index_search_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
