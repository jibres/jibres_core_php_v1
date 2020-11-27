CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `lang` char(2) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `privacy` enum('public','private') NULL DEFAULT NULL,
  `status` enum('draft','publish','expire','deleted','lock','awaiting','block','filter','close','trash','full') DEFAULT NULL,
  `redirect` varchar(2000) DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4,
  `setting` mediumtext CHARACTER SET utf8mb4,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `endmessage` text CHARACTER SET utf8mb4,
  `file` text CHARACTER SET utf8mb4,
  `analyze` timestamp NULL DEFAULT NULL,
  `analyzefield` text NULL DEFAULT NULL,
  `inquiry` BIT(1) NULL DEFAULT NULL,
`inquirymsg` text NULL DEFAULT NULL,
`inquirysetting` text NULL DEFAULT NULL,
`inquiryimage` text NULL DEFAULT NULL,
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
  `analyze` timestamp NULL DEFAULT NULL,
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
  `choice_id` bigint(20) UNSIGNED NULL DEFAULT null,
  `textarea` text CHARACTER SET utf8mb4,
  `file` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_answerdetail_index_value` (`answer`),
  KEY `form_answerdetail_index_multi_value` (`answer`, `item_id`, `form_id`),
  CONSTRAINT `form_answerdetail_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `form_answer` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_item_id` FOREIGN KEY (`item_id`) REFERENCES `form_item` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_answerdetail_choice_id` FOREIGN KEY (`choice_id`) REFERENCES `form_choice` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_choice (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` int(10) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4,
  `score` int(10) DEFAULT NULL,
  `sort` int(10) DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4,
  `file` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NULL DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL,
  `status` ENUM('enable', 'deleted') NULL DEFAULT 'enable',
  PRIMARY KEY (`id`),
  KEY `form_choice_index_sort` (`sort`),
  KEY `form_choice_index_status` (`status`),
  CONSTRAINT `form_choice_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_choice_item_id` FOREIGN KEY (`item_id`) REFERENCES `form_item` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_filter (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`form_id` int(10) UNSIGNED  NULL,
`title` VARCHAR(200) NULL,
`desc` text NULL,
`datecreated` timestamp NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `form_filter_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_filter_where (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`form_id` int(10) UNSIGNED  NULL,
`filter_id` int(10) UNSIGNED  NULL,
`operator` enum('and', 'or') NULL,
`field` VARCHAR(200) NULL,
`condition` VARCHAR(100) NULL,
`value` VARCHAR(1000) NULL,
`datecreated` timestamp NULL ,
`count_before` bigint(20) NULL,
`count_after` bigint(20) NULL,
`inside` bigint(20) NULL,
`outside` bigint(20) NULL,
PRIMARY KEY (`id`),
CONSTRAINT `form_filter_where_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE,
CONSTRAINT `form_filter_where_filter_id` FOREIGN KEY (`filter_id`) REFERENCES `form_filter` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_comment (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`form_id` int UNSIGNED NOT NULL,
`answer_id` bigint UNSIGNED NULL DEFAULT NULL,
`user_id` INT(10) UNSIGNED NULL DEFAULT NULL,
`content` text CHARACTER SET utf8mb4,
`file` text CHARACTER SET utf8mb4,
`privacy` enum('public', 'private') NULL DEFAULT NULL,
`view` BIT(1) NULL DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `form_comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `form_comment_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `form_answer` (`id`) ON UPDATE CASCADE,
CONSTRAINT `form_comment_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_tag (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
`url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
`language` CHAR(2) DEFAULT NULL,
`desc` mediumtext CHARACTER SET utf8mb4,
`creator` int(10) UNSIGNED DEFAULT NULL,
`status` enum('enable','disable','delete') NOT NULL DEFAULT 'enable',
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`form_id` INT UNSIGNED NULL DEFAULT NULL,
`privacy`   enum('public', 'private') NULL DEFAULT 'private',
`color` enum('red', 'green', 'blue', 'black') NULL DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `form_tag_title_search_index` (`title`),
 CONSTRAINT `form_tag_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
 CONSTRAINT `form_tag_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_tagusage (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`form_tag_id` int(10) UNSIGNED NOT NULL,
`form_id` bigint(20) UNSIGNED NOT NULL,
`answer_id` bigint(20) UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
KEY `form_tagusages_form_id_search_index` (`form_id`),
KEY `form_tagusages_form_tag_id_search_index` (`form_tag_id`),
KEY `form_tagusages_form_answer_id_search_index` (`answer_id`),
CONSTRAINT `unique_tag_form_answer` UNIQUE (`form_id`, `form_tag_id`, `answer_id`),
KEY `check_unique_tag_form_answer` (`form_id`, `form_tag_id`, `answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;