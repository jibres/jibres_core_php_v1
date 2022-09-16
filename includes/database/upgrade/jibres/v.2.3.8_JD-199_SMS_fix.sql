ALTER TABLE `jibres_api_log`.sms ADD `final_cost` decimal(13, 4) NULL DEFAULT NULL AFTER `sender`;
ALTER TABLE `jibres_api_log`.sms ADD `real_cost` decimal(13, 4) NULL DEFAULT NULL AFTER `sender`;
ALTER TABLE `jibres_api_log`.sms ADD `initial_cost` decimal(13, 4) NULL DEFAULT NULL AFTER `sender`;
ALTER TABLE `jibres_api_log`.sms ADD `calculate_cost` bit NULL DEFAULT NULL AFTER `sender`;

ALTER TABLE `jibres_api_log`.sms ADD INDEX `sms_index_search_final_cost` (`final_cost`);
ALTER TABLE `jibres_api_log`.sms ADD INDEX `sms_index_search_real_cost` (`real_cost`);
ALTER TABLE `jibres_api_log`.sms ADD INDEX `sms_index_search_initial_cost` (`initial_cost`);
ALTER TABLE `jibres_api_log`.sms ADD INDEX `sms_index_search_calculate_cost` (`calculate_cost`);
ALTER TABLE `jibres_api_log`.sms ADD INDEX `sms_index_search_spent` (`store_id`, `calculate_cost`);

