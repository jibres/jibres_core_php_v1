
CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.factoraction (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`factor_id` bigint(20) UNSIGNED NOT NULL,
`action` ENUM('tracking','notes','draft','registered','awaiting','confirmed','cancel','expire','preparing','sending','delivered','revert','success','complete','archive','deleted','spam','go_to_bank','pay_error','pay_cancel','awaiting_payment','awaiting_verify_payment','unsuccessful_payment','payment_unverified','successful_payment') CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`category` ENUM('notes', 'status', 'paystatus', 'tracking') CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`file` text CHARACTER SET utf8mb4,
`user_id` INT(10) UNSIGNED NULL DEFAULT NULL,
`datecreated` timestamp NULL ,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `factoraction_creator` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `factoraction_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
