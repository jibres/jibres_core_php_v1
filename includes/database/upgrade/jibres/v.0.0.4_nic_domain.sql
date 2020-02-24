
ALTER TABLE jibres_nic.domain CHANGE `status` `status` enum('awaiting','failed','pending','enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL;

ALTER TABLE jibres_nic.domain ADD `result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL;

ALTER TABLE jibres_nic.domain ADD KEY `domain_index_search_user_id` (`user_id`);
ALTER TABLE jibres_nic.domain ADD KEY `domain_index_search_dns` (`dns`);
