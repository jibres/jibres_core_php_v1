DROP TABLE `agents`;
DROP TABLE `contacts`;
DROP TABLE `logitems`;
DROP TABLE `logs`;
DROP TABLE `notifications`;
DROP TABLE `sendnotifications`;
DROP TABLE `socials`;
DROP TABLE `userparents`;
DROP TABLE `sessions`;
DROP TABLE `storeplans`;




ALTER TABLE `stores` DROP `country`;
ALTER TABLE `stores` DROP `province`;
ALTER TABLE `stores` DROP `city`;
ALTER TABLE `stores` DROP `location`;
ALTER TABLE `stores` DROP `zipcode`;
ALTER TABLE `stores` DROP `address`;
ALTER TABLE `stores` DROP `telegram`;
ALTER TABLE `stores` DROP `startplanday`;
ALTER TABLE `stores` DROP `phone`;
ALTER TABLE `stores` DROP `parent`;
ALTER TABLE `stores` DROP `mobile`;
ALTER TABLE `stores` CHANGE `startplan` `startplan`  timestamp DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `stores` ADD `address_id` bigint(20) UNSIGNED NULL DEFAULT NULL;



ALTER TABLE `userstores` ADD `address_id` bigint(20) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `userstores` ADD `visitor` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `visitor2` int(10) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `userstores` DROP `type`;
ALTER TABLE `userstores` DROP `birthdate`;
ALTER TABLE `userstores` DROP `pasportdate`;
ALTER TABLE `userstores` DROP `zipcode`;
ALTER TABLE `userstores` DROP `city`;
ALTER TABLE `userstores` DROP `province`;
ALTER TABLE `userstores` DROP `country`;
ALTER TABLE `userstores` DROP `address`;

ALTER TABLE `userstores` CHANGE `permission` `permission` varchar(200) NULL DEFAULT NULL;
ALTER TABLE `userstores` CHANGE `datecreated` `datecreated`  timestamp DEFAULT CURRENT_TIMESTAMP;


ALTER TABLE `userstores` ADD `totalorder` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `totalspent` float(20) NULL DEFAULT NULL;

ALTER TABLE `userstores` ADD `taxexempt` bit(1) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `marketing` bit(1) NULL DEFAULT NULL;


ALTER TABLE `userstores` ADD `companyname` varchar(200) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `companyeconomiccode` varchar(200) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `companynationalid` varchar(200) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `companyregisternumber` varchar(200) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `companyaddress_id` bigint(20) NULL DEFAULT NULL;


