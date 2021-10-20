ALTER TABLE jibres_nic.credit ADD `domain` varchar(200) NULL DEFAULT NULL;
ALTER TABLE jibres_nic.credit ADD INDEX `nic_credit_index_domain` (`domain`);

ALTER TABLE jibres_nic.credit ADD `refund_transaction_id` bigint(20) unsigned NULL DEFAULT NULL;
ALTER TABLE jibres_nic.credit ADD `meta` text NULL DEFAULT NULL;
