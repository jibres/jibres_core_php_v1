ALTER TABLE jibres_XXXXXXX.menu ADD `file` text CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `parent5`;
ALTER TABLE jibres_XXXXXXX.menu ADD `description` text CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `parent5`;
ALTER TABLE jibres_XXXXXXX.menu ADD `for` enum('menu', 'gallery') NULL DEFAULT 'menu' AFTER `file`;
ALTER TABLE jibres_XXXXXXX.menu ADD `for_id` bigint(20) unsigned NULL DEFAULT NULL AFTER `for`;

ALTER TABLE jibres_XXXXXXX.menu ADD INDEX `menu_index_for` (`for`);
ALTER TABLE jibres_XXXXXXX.menu ADD INDEX `menu_index_for_id` (`for_id`);