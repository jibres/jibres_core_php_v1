ALTER TABLE jibres_XXXXXXX.tickets ADD `guestid` varchar(50) NULL DEFAULT NULL AFTER `user_id`;
ALTER TABLE jibres_XXXXXXX.tickets ADD INDEX `ticket_index_search_guestid` (`guestid`);