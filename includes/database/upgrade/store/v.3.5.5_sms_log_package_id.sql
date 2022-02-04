ALTER TABLE jibres_XXXXXXX.sms_log ADD `package_id` bigint  NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.sms_log ADD  KEY `sms_log_index_package_id` (`package_id`);