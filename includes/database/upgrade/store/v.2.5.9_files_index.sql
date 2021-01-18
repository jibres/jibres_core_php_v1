ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_filename` (`filename`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_type` (`type`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_ext` (`ext`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_size` (`size`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_totalsize` (`totalsize`);
ALTER TABLE jibres_XXXXXXX.files ADD INDEX `files_search_index_status` (`status`);