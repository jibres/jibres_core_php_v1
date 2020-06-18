ALTER TABLE jibres_nic.domain CHANGE `registrar` `registrar` ENUM('irnic','onlinenic') CHARACTER SET utf8mb4 NULL DEFAULT NULL;


ALTER TABLE jibres_nic.usersetting ADD `phonecc` varchar(50) NULL DEFAULT NULL AFTER `mobile`;
ALTER TABLE jibres_nic.usersetting ADD `phone` varchar(50) NULL DEFAULT NULL AFTER `mobile`;
ALTER TABLE jibres_nic.usersetting ADD `faxcc` varchar(50) NULL DEFAULT NULL AFTER `mobile`;
ALTER TABLE jibres_nic.usersetting ADD `fax` varchar(50) NULL DEFAULT NULL AFTER `mobile`;
ALTER TABLE jibres_nic.usersetting ADD `fullname` varchar(100) NULL DEFAULT NULL AFTER `mobile`;