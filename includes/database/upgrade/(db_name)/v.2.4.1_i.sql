CREATE TABLE `i_banks` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`country` varchar(10)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`bank` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`accountnumber` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`shaba` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`card` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`expire` varchar(10)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`cvv2` varchar(10)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`branch` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`branchcode` varchar(100)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`owner` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`nameoncard` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`title` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted', 'expire', 'lost','useless') NULL DEFAULT NULL,
`iban` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`swift` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `i_banks_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `i_cat` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`title` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`in` bit(1) NULL DEFAULT NULL,
`type` enum('tag', 'cat') NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted') NULL DEFAULT NULL,
`parent1` bigint(20) UNSIGNED null DEFAULT NULL,
`parent2` bigint(20) UNSIGNED null DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `i_cat_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `i_jib` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`title` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`cat_id` bigint(20) UNSIGNED NULL,
`bank_id` int(10) UNSIGNED null DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted', 'expire', 'lost','useless') NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `i_jib_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_jib_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `i_cat` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_jib_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `i_banks` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `i_inout` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`desc` text CHARACTER SET utf8mb4,
`plus` bigint(20) UNSIGNED null DEFAULT NULL,
`minus` bigint(20) UNSIGNED null DEFAULT NULL,
`cat_id` bigint(20) UNSIGNED  NULL,
`datetime` datetime NULL DEFAULT null,
`jib_id` bigint(20) UNSIGNED  NULL,
`discount` bigint(20) UNSIGNED  NULL,
`thirdparty` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`store_id` int(10) UNSIGNED  NULL,
`status` enum('enable', 'disable', 'deleted', 'expire', 'lost','useless') NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `i_inout_jib_id` FOREIGN KEY (`jib_id`) REFERENCES `i_jib` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_inout_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_inout_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_inout_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `i_cat` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `i_chequebook` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`bank_id` int(10) UNSIGNED NOT NULL,
`title` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`firstserial` bigint(20) UNSIGNED NOT NULL,
`pagecount` smallint(5) UNSIGNED NOT NULL,
`number` smallint(5) UNSIGNED NOT NULL,
`desc` text CHARACTER SET utf8mb4,
`status` enum('enable', 'disable', 'deleted', 'expire', 'lost','useless', 'done') NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `i_chequebook_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_chequebook_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `i_banks` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `i_cheque` (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`bank_id` int(10) UNSIGNED NULL,
`date` date NULL,
`bank` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`branch` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`amount` bigint(20) UNSIGNED   NULL,
`vajh` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`owner` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`getdate` timestamp null,
`number` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`type` enum('in', 'out') NULL DEFAULT NULL,
`babat` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`thirdparty` varchar(200)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8mb4,
`status` enum('enable', 'disable', 'deleted', 'expire', 'lost','useless', 'done') NULL DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `i_cheque_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `i_cheque_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `i_banks` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;