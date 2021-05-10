CREATE TABLE jibres.temp_stats_monthly (

`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`year` smallint NULL DEFAULT NULL,
`month` smallint NULL DEFAULT NULL,

`count_store` bigint DEFAULT NULL,

`count_products` bigint DEFAULT NULL,

`count_factors` bigint DEFAULT NULL,
`count_factors_filtered` bigint DEFAULT NULL,

`sum_factors` bigint DEFAULT NULL,
`sum_factors_filtered` bigint DEFAULT NULL,

`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),

KEY `index_search_temp_stats_monthly_year` (`year`),
KEY `index_search_temp_stats_monthly_month` (`month`),
KEY `index_search_temp_stats_monthly_count_store` (`count_store`),
KEY `index_search_temp_stats_monthly_count_products` (`count_products`),
KEY `index_search_temp_stats_monthly_count_factors` (`count_factors`),
KEY `index_search_temp_stats_monthly_count_factors_filtered` (`count_factors_filtered`),

KEY `index_search_temp_stats_monthly_sum_factors` (`sum_factors`),
KEY `index_search_temp_stats_monthly_count_sum_factors_filtered` (`sum_factors_filtered`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;