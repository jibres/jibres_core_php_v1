ALTER TABLE jibres.transactions ADD `currency` varchar(50) NULL DEFAULT NULL AFTER `minus`;

UPDATE jibres.transactions SET jibres.transactions.currency = 'IRT' WHERE jibres.transactions.unit_id = 1;

ALTER TABLE jibres.transactions ADD INDEX `transactions_currency_index` (`currency`);

ALTER TABLE jibres.transactions DROP `unit_id`;