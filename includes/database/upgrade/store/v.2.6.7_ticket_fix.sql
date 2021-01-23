ALTER TABLE jibres_XXXXXXX.tickets DROP `meta`;
ALTER TABLE jibres_XXXXXXX.tickets CHANGE `status`  `status` enum('new','awaiting','answered','close','spam','deleted','pending') NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.tickets ADD `branch` bigint NULL DEFAULT NULL AFTER `parent`;
ALTER TABLE jibres_XXXXXXX.tickets ADD `base` bigint NULL DEFAULT NULL AFTER `parent`;

ALTER TABLE jibres_XXXXXXX.tickets ADD INDEX `ticket_index_search_plus` (`plus`);
ALTER TABLE jibres_XXXXXXX.tickets ADD INDEX `ticket_index_search_answertime` (`answertime`);