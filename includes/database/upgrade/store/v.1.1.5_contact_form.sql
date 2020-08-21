CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `lang` char(2) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `privacy` enum('public','private') NULL DEFAULT NULL,
  `status` enum('draft','publish','expire','deleted','lock','awaiting','block','filter','close','full') NULL DEFAULT NULL,
  `redirect` varchar(2000) DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4,
  `setting` mediumtext CHARACTER SET utf8mb4,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `form_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_item (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` int(10) UNSIGNED NOT NULL,
  `title` text CHARACTER SET utf8mb4,
  `desc` text CHARACTER SET utf8mb4,
  `require` bit(1) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `file` text CHARACTER SET utf8mb4,
  `maxlen` int(10) UNSIGNED DEFAULT NULL,
  `sort` int(10) DEFAULT NULL,
  `setting` mediumtext CHARACTER SET utf8mb4,
  `choice` mediumtext CHARACTER SET utf8mb4,
  `status` enum('draft','publish','expire','deleted','lock','awaiting','block','filter','close','full') NULL DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `form_item_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_answer (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `status` enum('start','complete','skip','spam','filter','block') DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `form_answer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answer_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_answerdetail (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` int(10) UNSIGNED NOT NULL,
  `answer_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NULL,
  `score` int(10) DEFAULT NULL,
  `answer` varchar(200) CHARACTER SET utf8mb4,
  `textrarea` text CHARACTER SET utf8mb4,
  `file` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `form_answerdetail_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `form_answer` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_item_id` FOREIGN KEY (`item_id`) REFERENCES `form_item` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;