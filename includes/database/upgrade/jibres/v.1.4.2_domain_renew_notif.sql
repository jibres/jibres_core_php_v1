ALTER TABLE jibres_nic.domain ADD `renewnotif` timestamp NULL DEFAULT NULL AFTER `autorenew`;
ALTER TABLE jibres_nic.domain ADD `renewtry` timestamp NULL DEFAULT NULL AFTER `autorenew`;
ALTER TABLE jibres_nic.usersetting ADD `autorenewperiodcom` varchar(50) NULL DEFAULT NULL AFTER `autorenewperiod`;