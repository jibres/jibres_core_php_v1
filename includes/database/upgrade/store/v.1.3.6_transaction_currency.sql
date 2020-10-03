ALTER TABLE jibres_XXXXXXX.transactions ADD `currency` varchar(50) NULL DEFAULT NULL AFTER `minus`;

UPDATE jibres_XXXXXXX.transactions SET jibres_XXXXXXX.transactions.currency = 'IRT' WHERE jibres_XXXXXXX.transactions.unit_id = 1;

ALTER TABLE jibres_XXXXXXX.transactions ADD INDEX `transactions_currency_index` (`currency`);

ALTER TABLE jibres_XXXXXXX.transactions DROP `unit_id`;