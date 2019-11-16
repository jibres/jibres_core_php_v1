CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`user_android` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userstore_id` int(10) UNSIGNED NOT NULL,
  `uniquecode` char(32) NOT NULL,
  `osversion` varchar(200) DEFAULT NULL,
  `version` varchar(200) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `language` char(2) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting') DEFAULT NULL,
  `meta` text CHARACTER SET utf8mb4,
  `lastupdate` timestamp NULL DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_android_userstore_id` FOREIGN KEY (`userstore_id`) REFERENCES `userstore` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
