ALTER TABLE files ADD INDEX `files_search_index_filename` (`filename`);
ALTER TABLE files ADD INDEX `files_search_index_type` (`type`);
ALTER TABLE files ADD INDEX `files_search_index_ext` (`ext`);
ALTER TABLE files ADD INDEX `files_search_index_size` (`size`);
ALTER TABLE files ADD INDEX `files_search_index_totalsize` (`totalsize`);
ALTER TABLE files ADD INDEX `files_search_index_status` (`status`);