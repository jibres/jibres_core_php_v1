ALTER TABLE jibres.store_domain ADD `dns1` varchar(100) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `dns2` varchar(100) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `dnsrecord` bit(1) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `dnsip` varchar(100) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `https` bit(1) NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `status` enum('failed', 'ok', 'pending') NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `message` text NULL DEFAULT NULL;
ALTER TABLE jibres.store_domain ADD `datemodified` timestamp NULL DEFAULT NULL;

