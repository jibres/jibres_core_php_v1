ALTER TABLE jibres_XXXXXXX.form_choice ADD `status` ENUM('enable', 'deleted') NULL DEFAULT 'enable';
ALTER TABLE jibres_XXXXXXX.form_choice ADD KEY `form_choice_index_status` (`status`);

ALTER TABLE jibres_XXXXXXX.form ADD `analyze` timestamp NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.form ADD `analyzefield` text NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.form_answer ADD `analyze` timestamp NULL DEFAULT NULL;


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
PRIMARY KEY (`id`),
CONSTRAINT `form_filter_where_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE,
CONSTRAINT `form_filter_where_filter_id` FOREIGN KEY (`filter_id`) REFERENCES `form_filter` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

