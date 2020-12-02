ALTER TABLE jibres.logs ADD `type` enum('public', 'system', 'db', 'php') NULL DEFAULT NULL AFTER `caller`;
ALTER TABLE jibres.logs ADD KEY `jibres_log_index_type` (`type`) ;