ALTER TABLE jibres_nic.domain ADD `renewnotif` timestamp NULL DEFAULT NULL AFTER `autorenew`;
ALTER TABLE jibres_nic.domain ADD `renewtry` timestamp NULL DEFAULT NULL AFTER `autorenew`;