ALTER TABLE jibres_nic.domain ADD `email` VARCHAR(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `mobile` VARCHAR(15) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `ownercheckdate` datetime NULL DEFAULT NULL;

ALTER TABLE jibres_nic.domain ADD INDEX `domain_index_search_mobile` (`mobile`);
ALTER TABLE jibres_nic.domain ADD INDEX `domain_index_search_email` (`email`);
ALTER TABLE jibres_nic.domain ADD INDEX `domain_index_search_ownercheckdate` (`ownercheckdate`);


