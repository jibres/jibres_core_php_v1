ALTER TABLE jibres_nic_log.log ADD `domain` VARCHAR(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic_log.log ADD KEY `log_index_search_domain` (`domain`);
ALTER TABLE jibres_nic_log.log ADD KEY `log_index_search_nic_id` (`nic_id`);
