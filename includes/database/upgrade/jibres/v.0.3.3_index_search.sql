ALTER TABLE jibres_nic.domain ADD KEY `domain_search_index_verify` (`verify`);
ALTER TABLE jibres_nic.domain ADD KEY `domain_search_index_available` (`available`);
ALTER TABLE jibres_nic.domain ADD KEY `domain_search_index_autorenew` (`autorenew`);

ALTER TABLE jibres_nic_log.domains ADD KEY `domains_search_index_registrar` (`registrar`);
ALTER TABLE jibres_nic_log.domainactivity ADD KEY `domainactivity_search_index_available` (`available`);
ALTER TABLE jibres_nic_log.domainactivity ADD KEY `domainactivity_search_index_type` (`type`);
