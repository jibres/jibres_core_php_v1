CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.productstock (
`product_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`initial` bigint(20)  NULL,
`sold` bigint(20)  NULL,
`bought` bigint(20)  NULL,
`stock` bigint(20)  NULL,
`minstock` bigint(20)  NULL,
`maxstock` bigint(20)  NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`product_id`),
CONSTRAINT `productstock_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE jibres_XXXXXXX.factordetails ADD `precount` BIGINT NULL DEFAULT NULL AFTER `count`;
UPDATE jibres_XXXXXXX.factordetails SET factordetails.precount = factordetails.count;
