CREATE DATABASE IF NOT EXISTS `jibres_shaparak` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jibres_shaparak`;



CREATE TABLE IF NOT EXISTS jibres_shaparak.wallet (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`title` varchar(100) NULL DEFAULT NULL,
`color` varchar(100) NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted') NULL DEFAULT NULL,
`master` bit(1) NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `wallet_index_search_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE IF NOT EXISTS jibres_shaparak.customer (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned NOT NULL,


`pre_gender` enum('male', 'female', 'company') NULL DEFAULT NULL,
`pre_firstname` varchar(100) NULL DEFAULT NULL,
`pre_lastname` varchar(100) NULL DEFAULT NULL,
`pre_father` varchar(100) NULL DEFAULT NULL,
`pre_birthdate` date NULL DEFAULT NULL,
`pre_firstname_en` varchar(100) NULL DEFAULT NULL,
`pre_lastname_en` varchar(100) NULL DEFAULT NULL,
`pre_father_en` varchar(100) NULL DEFAULT NULL,
`pre_nationality` varchar(100) NULL DEFAULT NULL,
`pre_passport` varchar(100) NULL DEFAULT NULL,
`pre_passportexpire` date NULL DEFAULT NULL,
`pre_nationalcode` varchar(20) NULL DEFAULT NULL,
`pre_postcode` varchar(20) NULL DEFAULT NULL,
`pre_phone` varchar(20) NULL DEFAULT NULL,

`pre_company` bit(1) NULL DEFAULT NULL,
`pre_companyname` varchar(200) NULL DEFAULT NULL,
`pre_companyname_en` varchar(200) NULL DEFAULT NULL,
`pre_companyregisternumber` varchar(200) NULL DEFAULT NULL,
`pre_companynationalid` varchar(200) NULL DEFAULT NULL,
`pre_companyeconomiccode` varchar(200) NULL DEFAULT NULL,
`pre_ceonationalcode` varchar(200) NULL DEFAULT NULL,


`passportpic` varchar(300) NULL DEFAULT NULL,
`nationalpic` varchar(300) NULL DEFAULT NULL,
`shpic` varchar(300) NULL DEFAULT NULL,
`verifypic` varchar(300) NULL DEFAULT NULL,
`lock` bit(1) NULL DEFAULT NULL,
`actionstatus` enum('active', 'pending', 'deactive', 'block', 'error') NULL DEFAULT NULL,


`trackingNumber`			varchar(100) NULL DEFAULT NULL, -- varchar(50)
`trackingNumberPsp`			varchar(100) NULL DEFAULT NULL, -- varchar(50)
`requestType`				varchar(100) NULL DEFAULT NULL, -- varchar(50)
`status`					varchar(100) NULL DEFAULT NULL, -- varchar(50)
`createby` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`firstNameFa` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`lastNameFa` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`fatherNameFa` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`firstNameEn` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`lastNameEn` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`fatherNameEn` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`gender` 					smallint(5) NULL DEFAULT NULL, -- smallint(2)
`birthDate`					varchar(100) NULL DEFAULT NULL, -- date
`registerDate` 				varchar(100) NULL DEFAULT NULL, -- date
`nationalCode` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(10)
`registerNumber` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`comNameFa` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`comNameEn` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`merchantType` 				smallint(5) NULL DEFAULT NULL, -- smallint(2)
`residencyType` 			smallint(5) NULL DEFAULT NULL, -- smallint(2)
`vitalStatus` 				smallint(5) NULL DEFAULT NULL, -- smallint(2)
`birthCrtfctNumber` 		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(10)
`birthCrtfctSerial` 		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(6)
`birthCrtfctSeriesLetter` 	smallint(5) NULL DEFAULT NULL, -- smallint(2)
`birthCrtfctSeriesNumber` 	smallint(5) NULL DEFAULT NULL, -- smallint(2)
`nationalLegalCode` 		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(11)
`commercialCode` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`countryCode` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(2)
`foreignPervasiveCode` 		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`passportNumber` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`passportExpireDate` 		varchar(100) NULL DEFAULT NULL, -- date
`Description` 				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(255)
`telephoneNumber` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(12)
`cellPhoneNumber` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(11)
`emailAddress` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(100)
`webSite` 					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(100)
`fax` 						varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(12)

`fix_birthDate`				date NULL DEFAULT NULL,


`datecreated`				timestamp NULL DEFAULT NULL,
`datemodified`				timestamp NULL DEFAULT NULL,

KEY `customer_index_search_user_id` (`user_id`),
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;





CREATE TABLE IF NOT EXISTS jibres_shaparak.shop (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,

`title` varchar(100) NULL DEFAULT NULL,
`wallet_id` int(10) UNSIGNED NULL,
`apikey` varchar(100) NULL DEFAULT NULL,
`logo` varchar(20) NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'deleted', 'lock', 'reject', 'pending', 'blocked', 'error') NULL DEFAULT NULL,
`precategory` varchar(200) NULL DEFAULT NULL,


`farsiName`					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`englishName`				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`telephoneNumber`			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(12)
`postalCode`				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(10)
`businessCertificateNumber`	varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`certificateIssueDate`		varchar(100) NULL DEFAULT NULL, -- datetime -- varchar(100)
`certificateExpiryDate`		varchar(100) NULL DEFAULT NULL, -- datetime -- varchar(100)
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(255)
`businessCategoryCode`		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(4)
`businessSubCategoryCode`	varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(4)
`ownershipType`				smallint(5) NULL DEFAULT NULL, -- smallint(2)
`rentalContractNumber`		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`rentalExpiryDate`			varchar(100) NULL DEFAULT NULL, -- datetime -- varchar(100)
`Address`					varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(255)
`countryCode`				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(2)
`provinceCode`				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(3)
`cityCode`					varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(6)
`businessType`				smallint(5) NULL DEFAULT NULL, -- smallint(2)
`etrustCertificateType`		smallint(5) NULL DEFAULT NULL, -- smallint(2)
`etrustCertificateIssueDate` varchar(100) NULL DEFAULT NULL, -- datetime -- varchar(100)
`etrustCertificateExpiryDate` varchar(100) NULL DEFAULT NULL, -- datetime -- varchar(100)
`emailAddress`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(255)
`websiteAddress`			varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(255)
`datecreated`				timestamp NULL DEFAULT NULL,
`datemodified`				timestamp NULL DEFAULT NULL,

CONSTRAINT `shop_wallet_id` FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`id`) ON UPDATE CASCADE,
KEY `shop_index_search_user_id` (`user_id`),
KEY `shop_index_search_apikey` (`apikey`),
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS jibres_shaparak.acceptor (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,

`iin`						varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(9)
`acceptorCode`				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(15)
`acceptorType`				smallint(5) NULL DEFAULT NULL, -- smallint(2)
`facilitatorAcceptorCode`	varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(15)
`cancelable`				bit(1) NULL DEFAULT NULL,
`refundable`				bit(1) NULL DEFAULT NULL,
`blockable`					bit(1) NULL DEFAULT NULL,
`chargeBackable`			bit(1) NULL DEFAULT NULL,
`settledSeparately`			bit(1) NULL DEFAULT NULL,
`allowScatteredSettlement`	smallint(5) NULL DEFAULT NULL, -- smallint(2)
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
`datecreated`				timestamp NULL DEFAULT NULL,
`datemodified`				timestamp NULL DEFAULT NULL,
KEY `acceptor_index_search_user_id` (`user_id`),
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS jibres_shaparak.terminal (
`id`						bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id`					int(10) unsigned DEFAULT NULL,
`sequence` 					bigint(20) NULL DEFAULT NULL,
`terminalNumber` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- char(8)
`terminalType` 				smallint(5) NULL DEFAULT NULL, -- smallint(2)
`serialNumber` 				varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`setupDate` 				datetime NULL DEFAULT NULL,
`hardwareBrand` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`hardwareModel` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(50)
`accessAddress` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(100)
`accessPort` 				int(5) NULL DEFAULT NULL,
`callbackAddress` 			varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(100)
`callbackPort` 				int(5) NULL DEFAULT NULL,
`Description`				varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
`datecreated`				timestamp NULL DEFAULT NULL,
`datemodified`				timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS jibres_shaparak.iban (
`id`				bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_id` 			int(10) UNSIGNED NOT NULL,

`title` varchar(200) NULL DEFAULT NULL,
`bank` varchar(100) NULL DEFAULT NULL,
`isdefault` bit(1) NULL DEFAULT NULL,
`status` enum('enable', 'expire', 'pending', 'deleted', 'block', 'error') NULL DEFAULT NULL,
`datecreated` timestamp NULL DEFAULT NULL,
`datemodified` timestamp NULL DEFAULT NULL,

`merchantIban` 		varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, -- varchar(34)
`Description`		varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

