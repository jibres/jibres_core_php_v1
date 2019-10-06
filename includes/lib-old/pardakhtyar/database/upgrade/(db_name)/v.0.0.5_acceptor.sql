CREATE TABLE IF NOT EXISTS `acceptor` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`customer_id`				bigint(20) unsigned DEFAULT NULL,
`iin`						varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`acceptorCode`				char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`acceptorType`				smallint(2) NULL DEFAULT NULL,
`facilitatorAcceptorCode`	char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`cancelable`				bit(1) NULL DEFAULT NULL,
`refundable`				bit(1) NULL DEFAULT NULL,
`blockable`					bit(1) NULL DEFAULT NULL,
`chargeBackable`			bit(1) NULL DEFAULT NULL,
`settledSeparately`			bit(1) NULL DEFAULT NULL,
`allowScatteredSettlement`	smallint(2) NULL DEFAULT NULL,
`acceptCreditCardTransaction` bit(1) NULL DEFAULT NULL,
`allowIranianProductsTrx`	bit(1) NULL DEFAULT NULL,
`allowKaraCardTrx`			bit(1) NULL DEFAULT NULL,
`allowGoodsBasketTrx`		bit(1) NULL DEFAULT NULL,
`allowFoodSecurityTrx`		bit(1) NULL DEFAULT NULL,
`allowJcbCardTrx`			bit(1) NULL DEFAULT NULL,
`allowUpiCardTrx`			bit(1) NULL DEFAULT NULL,
`allowVisaCardTrx`			bit(1) NULL DEFAULT NULL,
`allowMasterCardTrx`		bit(1) NULL DEFAULT NULL,
`allowAmericanExpressTrx`	bit(1) NULL DEFAULT NULL,
`allowOtherInternationaCardsTrx` bit(1) NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `acceptor_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `acceptor_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `acceptor_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `terminal` (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`customer_id`				bigint(20) unsigned DEFAULT NULL,
`sequence` 					bigint(20) NULL DEFAULT NULL,
`terminalNumber` 			char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`terminalType` 				smallint(2) NULL DEFAULT NULL,
`serialNumber` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`setupDate` 				datetime NULL DEFAULT NULL,
`hardwareBrand` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`hardwareModel` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`accessAddress` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`accessPort` 				int(5) NULL DEFAULT NULL,
`callbackAddress` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`callbackPort` 				int(5) NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `terminal_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `terminal_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `terminal_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS `merchantIbans` (
`id`				bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`			int(10) unsigned DEFAULT NULL,
`creator`			int(10) unsigned DEFAULT NULL,
`customer_id`		bigint(20) unsigned DEFAULT NULL,
`merchantIban` 		varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`Description`		varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`		timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`		timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `merchantIbans_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `merchantIbans_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
CONSTRAINT `merchantIbans_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


