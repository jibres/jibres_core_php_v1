-- [database log]

ALTER TABLE `dayevent` ADD 	`store` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`storetransaction` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`sumplustransaction` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`summinustransaction` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`userstore` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`product` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`factordetail` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`factor` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`sumfactor` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`fund` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`inventory` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`planhistory` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`productinventory` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`productprice` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`productterm` int(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `dayevent` ADD 	`producttermusage` int(10) UNSIGNED NULL DEFAULT NULL;

