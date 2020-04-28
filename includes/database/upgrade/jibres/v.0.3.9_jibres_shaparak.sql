CREATE DATABASE IF NOT EXISTS `jibres_shaparak` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_shaparak`;


CREATE TABLE IF NOT EXISTS jibres_shaparak.customer (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`trackingNumber`			varchar(50) NULL DEFAULT NULL,
`trackingNumberPsp`			varchar(50) NULL DEFAULT NULL,
`requestType`				varchar(50) NULL DEFAULT NULL,
`status`					varchar(50) NULL DEFAULT NULL,
`createby` 					varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`firstNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`lastNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`fatherNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`firstNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`lastNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`fatherNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`gender` 					smallint(2) NULL DEFAULT NULL,
`birthDate`					date NULL DEFAULT NULL,
`registerDate` 				date NULL DEFAULT NULL,
`nationalCode` 				char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`registerNumber` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`comNameFa` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`comNameEn` 				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`merchantType` 				smallint(2) NULL DEFAULT NULL,
`residencyType` 			smallint(2) NULL DEFAULT NULL,
`vitalStatus` 				smallint(2) NULL DEFAULT NULL,
`birthCrtfctNumber` 		varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`birthCrtfctSerial` 		char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`birthCrtfctSeriesLetter` 	smallint(2) NULL DEFAULT NULL,
`birthCrtfctSeriesNumber` 	smallint(2) NULL DEFAULT NULL,
`nationalLegalCode` 		char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`commercialCode` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`countryCode` 				char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`foreignPervasiveCode` 		varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`passportNumber` 			varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`passportExpireDate` 		date NULL DEFAULT NULL,
`Description` 				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`telephoneNumber` 			varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`cellPhoneNumber` 			char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`emailAddress` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`webSite` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`fax` 						varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS jibres_shaparak.shop (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`creator`					int(10) unsigned DEFAULT NULL,
`customer_id`				bigint(20) unsigned DEFAULT NULL,
`farsiName`					varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`englishName`				varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`telephoneNumber`			varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`postalCode`				char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessCertificateNumber`	varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`certificateIssueDate`		datetime NULL DEFAULT NULL,
`certificateExpiryDate`		datetime NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessCategoryCode`		char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessSubCategoryCode`	varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`ownershipType`				smallint(2) NULL DEFAULT NULL,
`rentalContractNumber`		varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`rentalExpiryDate`			datetime NULL DEFAULT NULL,
`Address`					varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`countryCode`				char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`provinceCode`				char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`cityCode`					char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`businessType`				smallint(2) NULL DEFAULT NULL,
`etrustCertificateType`		smallint(2) NULL DEFAULT NULL,
`etrustCertificateIssueDate` datetime NULL DEFAULT NULL,
`etrustCertificateExpiryDate` datetime NULL DEFAULT NULL,
`emailAddress`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`websiteAddress`			varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`				timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `shop_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS jibres_shaparak.acceptor (
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
CONSTRAINT `acceptor_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS jibres_shaparak.terminal (
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
CONSTRAINT `terminal_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS jibres_shaparak.merchantIbans (
`id`				bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`			int(10) unsigned DEFAULT NULL,
`creator`			int(10) unsigned DEFAULT NULL,
`customer_id`		bigint(20) unsigned DEFAULT NULL,
`merchantIban` 		varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`Description`		varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`		timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`datemodified`		timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT `merchantIbans_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


