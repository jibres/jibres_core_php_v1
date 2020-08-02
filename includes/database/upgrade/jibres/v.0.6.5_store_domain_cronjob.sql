ALTER TABLE jibres.store_domain ADD `cronjobstatus` varchar(100) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `cronjobdate` datetime NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `sslrequestdate` datetime NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `sslfailed` datetime NULL DEFAULT NULL;