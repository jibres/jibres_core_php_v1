CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`user_telegram` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `chatid` bigint(20) NOT NULL,
  `firstname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lastname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `language` char(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting','inline','callback') DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_tg_user_id` FOREIGN KEY (`user_id`) REFERENCES `userstore` (`id`) ON UPDATE CASCADE,
  KEY `index_search_chatid` (`chatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
