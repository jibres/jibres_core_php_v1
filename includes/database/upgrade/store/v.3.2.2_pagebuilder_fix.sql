ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `folder` varchar(50) CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `mode`;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `section` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `folder`;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `model` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `section`;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `preview_key` varchar(100) CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `model`;

ALTER TABLE jibres_XXXXXXX.pagebuilder ADD INDEX `pagebuilder_index_folder` (`folder`);
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD INDEX `pagebuilder_index_section` (`section`);
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD INDEX `pagebuilder_index_model` (`model`);
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD INDEX `pagebuilder_index_preview_key` (`preview_key`);
