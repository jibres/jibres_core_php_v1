ALTER TABLE jibres_XXXXXXX.form_answer ADD `ticket_id` BIGINT UNSIGNED NULL DEFAULT NULL AFTER `transaction_id`;
ALTER TABLE jibres_XXXXXXX.form_answer ADD INDEX  `form_answer_index_status` (`status`);
ALTER TABLE jibres_XXXXXXX.tickets ADD `form_answer_id` BIGINT UNSIGNED NULL DEFAULT NULL AFTER `see`;