ALTER TABLE jibres_nic.domain ADD `email_tech` varchar(200) NULL DEFAULT NULL AFTER `email`;
ALTER TABLE jibres_nic.domain ADD INDEX `domain_index_search_email_tech` (`email_tech`);
