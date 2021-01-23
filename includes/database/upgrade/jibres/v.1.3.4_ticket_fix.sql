ALTER TABLE jibres.tickets DROP `meta`;
ALTER TABLE jibres.tickets CHANGE `status`  `status` enum('new','awaiting','answered','close','spam','deleted','pending') NULL DEFAULT NULL;
ALTER TABLE jibres.tickets ADD `branch` bigint NULL DEFAULT NULL AFTER `parent`;
ALTER TABLE jibres.tickets ADD `base` bigint NULL DEFAULT NULL AFTER `parent`;

ALTER TABLE jibres.tickets ADD INDEX `ticket_index_search_plus` (`plus`);
ALTER TABLE jibres.tickets ADD INDEX `ticket_index_search_answertime` (`answertime`);