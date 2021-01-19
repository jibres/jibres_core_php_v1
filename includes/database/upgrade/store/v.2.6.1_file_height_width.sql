ALTER TABLE jibres_XXXXXXX.files ADD `height` int(10) NULL DEFAULT NULL AFTER `size`;
ALTER TABLE jibres_XXXXXXX.files ADD `width` int(10) NULL DEFAULT NULL AFTER `height`;
ALTER TABLE jibres_XXXXXXX.files ADD `ratio` decimal(6, 3) NULL DEFAULT NULL AFTER `width`;

ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_height` (`height`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_width` (`width`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_ratio` (`ratio`);
