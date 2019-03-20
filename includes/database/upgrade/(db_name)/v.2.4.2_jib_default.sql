ALTER TABLE `i_jib` ADD  `isdefault` bit(1) NULL DEFAULT NULL;
ALTER TABLE `i_chequebook` CHANGE  `number` `number` bigint(20) unsigned NULL DEFAULT NULL;
ALTER TABLE `i_cheque` ADD  `chequebook_id` bigint(20) unsigned NULL DEFAULT NULL AFTER `bank_id`;

ALTER TABLE `i_cheque` ADD CONSTRAINT `i_cheque_chequebook_id` FOREIGN KEY (`chequebook_id`) REFERENCES `i_chequebook` (`id`) ON UPDATE CASCADE;