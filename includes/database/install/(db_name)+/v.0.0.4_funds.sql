CREATE TABLE funds (
`id`					int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id`				int(10) UNSIGNED NOT NULL,
`title`					varchar(500) NOT NULL,
`slug`					varchar(200) NULL DEFAULT NULL,
`initialbalance`		BIGINT(20) UNSIGNED NULL DEFAULT NULL,
`status`				enum('enable', 'disable', 'delete', 'trash') NULL DEFAULT NULL,
`datecreated` 			timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` 			timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`desc`					text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `funds_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
