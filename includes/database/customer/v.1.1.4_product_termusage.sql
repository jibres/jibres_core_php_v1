CREATE TABLE `jibres_XXXXXXX`.`producttermusages` (
`productterm_id` int(10) UNSIGNED NOT NULL,
`product_id` bigint(20) UNSIGNED NOT NULL,
KEY `producttermusages_product_id_search_index` (`product_id`),
KEY `producttermusages_productterm_id_search_index` (`productterm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;