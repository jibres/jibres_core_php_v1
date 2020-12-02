ALTER TABLE jibres.users ADD `accounttype` enum('personal', 'legal') NULL DEFAULT 'personal' AFTER `status`;

ALTER TABLE jibres.users ADD `companyname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE jibres.users ADD `companyeconomiccode` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE jibres.users ADD `companynationalid` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE jibres.users ADD `companyregisternumber` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;

