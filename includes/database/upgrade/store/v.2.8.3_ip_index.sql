ALTER TABLE jibres_XXXXXXX.cart ADD INDEX `cart_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres_XXXXXXX.cart ADD INDEX `cart_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres_XXXXXXX.comments ADD INDEX `comments_search_index_ip_id` (`ip_id`);

ALTER TABLE jibres_XXXXXXX.csrf ADD INDEX `csrf_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres_XXXXXXX.csrf ADD INDEX `csrf_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres_XXXXXXX.factors ADD INDEX `factors_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres_XXXXXXX.logs ADD INDEX `logs_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres_XXXXXXX.logs ADD INDEX `logs_search_index_agent_id` (`agent_id`);

ALTER TABLE jibres_XXXXXXX.tickets ADD INDEX `tickets_search_index_ip_id` (`ip_id`);

ALTER TABLE jibres_XXXXXXX.transactions ADD INDEX `transactions_search_index_ip_id` (`ip_id`);
ALTER TABLE jibres_XXXXXXX.transactions ADD INDEX `transactions_search_index_agent_id` (`agent_id`);