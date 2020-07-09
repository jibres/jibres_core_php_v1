ALTER TABLE jibres_XXXXXXX.factors CHANGE `status` `status` ENUM('enable','disable','draft','order','expire','cancel','pending_pay','pending_verify','pending_prepare','pending_send','sending','deliver','reject','spam','deleted') CHARACTER SET utf8mb4 NULL DEFAULT NULL;


CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.factoraction (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`factor_id` bigint(20) UNSIGNED NOT NULL,
`action` enum('comment','order','expire','cancel','go_to_bank','pay_successfull','pay_error','pay_verified','pay_unverified','sending','pending_pay','pending_verify','pending_prepare','pending_send','deliver','reject','spam','deleted') DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`file` text CHARACTER SET utf8mb4,
`user_id` INT(10) UNSIGNED NULL DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `factoraction_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factoraction_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
