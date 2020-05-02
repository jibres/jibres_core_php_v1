ALTER TABLE jibres_nic_log.log ADD `gateway` enum('system', 'user') NULL DEFAULT NULL;


UPDATE jibres_nic_log.log SET jibres_nic_log.log.gateway = 'system' WHERE jibres_nic_log.log.type IN ('poll_request','poll_acknowledge');
UPDATE jibres_nic_log.log SET jibres_nic_log.log.gateway = 'user' WHERE jibres_nic_log.log.type NOT IN ('poll_request','poll_acknowledge');