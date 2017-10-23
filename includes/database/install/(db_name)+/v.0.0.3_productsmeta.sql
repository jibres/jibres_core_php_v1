CREATE TABLE productproperties (
`id`					bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id`				INT(10) UNSIGNED NOT NULL,
`product_id`			INT(10) UNSIGNED NOT NULL,
`cat`					varchar(100) NULL DEFAULT NULL,
`key`					varchar(200) NULL DEFAULT NULL,
`value`					varchar(1000) NULL DEFAULT NULL,
`desc`					text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
`datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `productpropreries_prudeuct_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
CONSTRAINT `productpropreries_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
