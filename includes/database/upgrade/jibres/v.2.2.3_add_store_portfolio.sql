ALTER TABLE jibres.store_data ADD `portfolio` enum('request', 'accept', 'reject', 'delete') NULL DEFAULT NULL;
ALTER TABLE jibres.store_data ADD `portfolio_detail` text NULL DEFAULT NULL;
ALTER TABLE jibres.store_data ADD INDEX `index_search_store_data_portfolio` (`portfolio`);