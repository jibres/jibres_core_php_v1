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
  PRIMARY KEY (`id`),
  KEY `form_choice_index_sort` (`sort`),
  CONSTRAINT `form_choice_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `form_choice_item_id` FOREIGN KEY (`item_id`) REFERENCES `form_item` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

