CREATE TABLE `jibres_XXXXXXX`.`productcategoryusage` (
`productcategory_id` int(10) UNSIGNED NOT NULL,
`product_id` int(10) UNSIGNED NOT NULL,
KEY `productcategoryusages_product_id_search_index` (`product_id`),
KEY `productcategoryusages_productcategory_id_search_index` (`productcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;