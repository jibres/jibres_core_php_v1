CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `ip` bigint(20) DEFAULT NULL,
  `file` varchar(2000) DEFAULT NULL,
  `plus` int(10) UNSIGNED DEFAULT NULL,
  `answertime` int(10) UNSIGNED DEFAULT NULL,
  `solved` bit(1) DEFAULT NULL,
  `via` enum('site','telegram','sms','contact','admincontact','app') DEFAULT NULL,
  `see` bit(1) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `tickets_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  KEY `index_search_status` (`status`),
  KEY `index_search_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
