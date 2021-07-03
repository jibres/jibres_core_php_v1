ALTER TABLE jibres_XXXXXXX.pagebuilder CHANGE `status` `status` ENUM('draft','enable','disable','deleted', 'hidden') CHARACTER SET utf8mb4 NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `status_preview` ENUM('draft','enable','disable','deleted', 'hidden') CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `status`;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD INDEX `index_search_pagebuilder_status_preview` (`status_preview`);
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD `sort_preview` int NULL DEFAULT NULL AFTER `sort`;
ALTER TABLE jibres_XXXXXXX.pagebuilder ADD INDEX `index_search_pagebuilder_sort_preview` (`sort_preview`);