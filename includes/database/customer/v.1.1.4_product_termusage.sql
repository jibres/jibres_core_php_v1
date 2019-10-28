CREATE TABLE `jibres_XXXXXXX`.`producttagusage` (
`producttag_id` int(10) UNSIGNED NOT NULL,
`product_id` bigint(20) UNSIGNED NOT NULL,
KEY `producttagusages_product_id_search_index` (`product_id`),
KEY `producttagusages_producttag_id_search_index` (`producttag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;