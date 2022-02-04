ALTER TABLE jibres.store_plugin_action ADD `packagecount` INT NULL DEFAULT NULL AFTER `plusday`;

ALTER TABLE jibres.store_plugin_action CHANGE `status` `status` ENUM('pending','enable','disable','deleted','expired','cancel','refund','failed','used','finished') CHARACTER SET utf8mb4 NULL DEFAULT NULL;