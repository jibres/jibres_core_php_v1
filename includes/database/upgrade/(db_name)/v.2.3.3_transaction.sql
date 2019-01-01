ALTER TABLE `storetransactions` ADD `token` varchar(32) DEFAULT NULL;
ALTER TABLE `storetransactions` ADD `banktoken` varchar(100) DEFAULT NULL;
ALTER TABLE `storetransactions` ADD `payment` varchar(100) DEFAULT NULL;
ALTER TABLE `storetransactions` ADD `dateverify` int(10) unsigned DEFAULT NULL;


ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_token` (`token`);
ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_banktoken` (`banktoken`);
ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_payment` (`payment`);
ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_dateverify` (`dateverify`);
ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_verify` (`verify`);
ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_plus` (`plus`);
ALTER TABLE `storetransactions` ADD INDEX `storetransactions_index_minus` (`minus`);
