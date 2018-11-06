ALTER TABLE `userstores` ADD `sumpaysupplier` float(20) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `sumpaycustomer` float(20) NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `sumsalestaff` float(20) NULL DEFAULT NULL;

ALTER TABLE `userstores` ADD `countordercustomer` int(10) unsigned NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `countordersupplier` int(10) unsigned NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `countorderstaff` int(10) unsigned NULL DEFAULT NULL;

ALTER TABLE `userstores` ADD `lastpaycustomer` datetime NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `lastactivity` datetime NULL DEFAULT NULL;
ALTER TABLE `userstores` ADD `customercredit` float(20) NULL DEFAULT NULL;

