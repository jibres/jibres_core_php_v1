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
 PRIMARY KEY (`id`),
 KEY `form_tag_title_search_index` (`title`),
 CONSTRAINT `form_tag_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_tagusage (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`form_tag_id` int(10) UNSIGNED NOT NULL,
`form_id` bigint(20) UNSIGNED NOT NULL,
`answer_id` bigint(20) UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
KEY `form_tagusages_form_id_search_index` (`form_id`),
KEY `form_tagusages_form_tag_id_search_index` (`form_tag_id`),
KEY `form_tagusages_form_answer_id_search_index` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;