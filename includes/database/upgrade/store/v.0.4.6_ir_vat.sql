CREATE TABLE IF NOT EXISTS jibres_XXXXXXX.ir_vat (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`title` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`code` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,

`serialnumber` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
`factordate` datetime DEFAULT NULL,
`year` smallint(5) DEFAULT NULL,
`month` enum('1','2','3','4','5','6','7','8','9','10','11','12') DEFAULT NULL,
`day` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31') DEFAULT NULL,
`season` enum('1','2','3','4') DEFAULT NULL,

`customer` INT(10) UNSIGNED NULL DEFAULT NULL,
`seller` INT(10) UNSIGNED NULL DEFAULT NULL,
`type` enum('income','cost') DEFAULT NULL,

`total` bigint(20) NULL DEFAULT NULL,
`subtotalitembyvat` bigint(20) NULL DEFAULT NULL,
`sumvat` bigint(20) NULL DEFAULT NULL,

`items` bigint(20) NULL DEFAULT NULL,
`itemsvat` bigint(20) NULL DEFAULT NULL,
`official` bit(1) NULL DEFAULT NULL,
`vat` bit(1) NULL DEFAULT NULL,
`file` text CHARACTER SET utf8mb4,
`desc` text CHARACTER SET utf8mb4,

`creator` INT(10) UNSIGNED NULL DEFAULT NULL,

`datecreated` timestamp NULL ,
`datemodified` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`id`),
CONSTRAINT `ir_vat_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
