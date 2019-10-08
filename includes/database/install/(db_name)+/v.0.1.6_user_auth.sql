CREATE TABLE `user_auth` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `auth` char(32) NOT NULL,
  `status` enum('enable','disable','expire','used') DEFAULT NULL,
  `gateway` enum('android','ios','api') DEFAULT NULL,
  `type` enum('guest','member','appkey') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gateway_id` int(10) UNSIGNED DEFAULT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  KEY `index_search_auth` (`auth`),
  KEY `index_search_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
