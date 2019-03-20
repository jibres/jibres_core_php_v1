ALTER TABLE `i_jib` ADD  `isdefault` bit(1) NULL DEFAULT NULL;
ALTER TABLE `i_chequebook` CHANGE  `number` `number` bigint(20) unsigned NULL DEFAULT NULL;