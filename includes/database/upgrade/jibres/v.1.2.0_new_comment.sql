DROP TABLE jibres.comments;

CREATE TABLE IF NOT EXISTS jibres.comments (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `for` enum('page','post','product') NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `displayname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `gallery` text CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter') NULL DEFAULT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `star` smallint(5) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `ip` bigint(20)  DEFAULT NULL,
  `agent_id` int(10) UNSIGNED  DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `comments_posts_id`    FOREIGN KEY (`post_id`)     REFERENCES `posts` (`id`)     ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `comments_users_id`    FOREIGN KEY (`user_id`)     REFERENCES `users` (`id`)     ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `comments_agent_id`    FOREIGN KEY (`agent_id`)    REFERENCES `agents` (`id`)    ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `index_search_star` (`star`),
  KEY `index_search_for` (`for`),
  KEY `index_search_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
