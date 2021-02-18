ALTER TABLE jibres.store  ADD `status` enum('enable', 'close', 'deleted', 'spam', 'hard_delete') CHARACTER SET utf8mb4 NOT NULL DEFAULT 'enable' AFTER `ip`;
ALTER TABLE jibres.store  ADD INDEX `store_index_search_status` (`status`);
