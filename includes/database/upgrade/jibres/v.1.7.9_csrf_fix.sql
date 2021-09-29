ALTER TABLE jibres.csrf ADD `user_id` INT(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.csrf ADD `remember_me` varchar(500) NULL DEFAULT NULL;
ALTER TABLE jibres.csrf ADD `session_id` varchar(500) NULL DEFAULT NULL;