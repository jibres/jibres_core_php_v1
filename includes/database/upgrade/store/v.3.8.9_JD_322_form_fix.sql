CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.form_load
(
	`id`         bigint UNSIGNED NOT NULL AUTO_INCREMENT,
	`form_id`    int UNSIGNED         DEFAULT NULL,
	`token`      char(32)        NULL DEFAULT NULL,
	`ip_id`      int UNSIGNED         DEFAULT NULL,
	`agent_id`   int UNSIGNED         DEFAULT NULL,
	`user_id`    int UNSIGNED         DEFAULT NULL,
	`viewtime`   timestamp       NULL DEFAULT NULL,
	`starttime`  timestamp       NULL DEFAULT NULL,
	`url_id`     int UNSIGNED         DEFAULT NULL,
	`referer_id` int UNSIGNED         DEFAULT NULL,
	`questions`  text                 DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `form_load_index_token` (`form_id`, `token`),
	INDEX `form_load_index_ip_agent` (`form_id`, `ip_id`, `agent_id`),
	CONSTRAINT `form_load_form_id` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;



ALTER TABLE jibres_XXXXXXX.form_answer
	ADD `form_load_id` bigint UNSIGNED NULL DEFAULT NULL;

ALTER TABLE jibres_XXXXXXX.form_answer
	ADD CONSTRAINT `form_answer_form_load_id` FOREIGN KEY (`form_load_id`) REFERENCES `form_load` (`id`) ON UPDATE CASCADE;


