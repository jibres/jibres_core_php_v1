ALTER TABLE jibres.csrf ADD INDEX `csrf_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres.csrf ADD INDEX `csrf_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres.logs ADD INDEX `logs_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres.logs ADD INDEX `logs_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres.tickets ADD INDEX `tickets_search_index_ip_id` (`ip_id`);

ALTER TABLE jibres.transactions ADD INDEX `transactions_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres.transactions ADD INDEX `transactions_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres.giftusage ADD INDEX `giftusage_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres.giftusage ADD INDEX `giftusage_search_index_agent_id` (`agent_id`);