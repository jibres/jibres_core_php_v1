ALTER TABLE jibres.temp_stats_monthly ADD `count_transaction` bigint NULL DEFAULT NULL;
ALTER TABLE jibres.temp_stats_monthly ADD `count_transaction_verify` bigint NULL DEFAULT NULL;
ALTER TABLE jibres.temp_stats_monthly ADD INDEX `index_search_temp_stats_monthly_count_transaction` (`count_transaction`);
ALTER TABLE jibres.temp_stats_monthly ADD INDEX `index_search_temp_stats_monthly_count_transaction_verify` (`count_transaction_verify`);
