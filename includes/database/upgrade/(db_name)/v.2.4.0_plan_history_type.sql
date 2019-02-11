ALTER TABLE `planhistory` ADD  `type` enum('change','continuation','upgrade','downgrade','first_year', 'set') NULL DEFAULT NULL;
ALTER TABLE `planhistory` ADD  `expireplan` datetime NULL DEFAULT NULL;
ALTER TABLE `planhistory` ADD  `period` enum('monthly', 'yearly') NULL DEFAULT NULL;