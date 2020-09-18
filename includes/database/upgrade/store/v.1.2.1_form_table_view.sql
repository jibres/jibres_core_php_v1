CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_view (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`form_id` int(10) UNSIGNED  NULL,
`user_id` INT(10) UNSIGNED NULL,
`title` VARCHAR(200) NULL,
`desc` text NULL,
`table_name` VARCHAR(200) NULL,
`countrecord` bigint(20) NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `form_view_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `form_view_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_filter (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`view_id` int(10) UNSIGNED  NULL,
`title` VARCHAR(200) NULL,
`desc` text NULL,
`datecreated` timestamp NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `form_filter_view_id` FOREIGN KEY (`view_id`) REFERENCES `form_view` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_filter_where (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`view_id` int(10) UNSIGNED  NULL,
`filter_id` int(10) UNSIGNED  NULL,
`operator` enum('and', 'or', 'open_group', 'close_group') NULL,
`field` VARCHAR(200) NULL,
`condition` VARCHAR(100) NULL,
`value` VARCHAR(1000) NULL,
`datecreated` timestamp NULL ,
`count_before` bigint(20) NULL,
`count_after` bigint(20) NULL,
PRIMARY KEY (`id`),
CONSTRAINT `form_filter_where_view_id` FOREIGN KEY (`view_id`) REFERENCES `form_view` (`id`) ON UPDATE CASCADE,
CONSTRAINT `form_filter_where_filter_id` FOREIGN KEY (`filter_id`) REFERENCES `form_filter` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

