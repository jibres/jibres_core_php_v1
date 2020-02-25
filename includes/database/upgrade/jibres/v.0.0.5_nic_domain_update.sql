
ALTER TABLE jibres_nic.domain CHANGE `status` `status` enum('awaiting','failed','pending','enable', 'disable', 'deleted', 'expire') NULL DEFAULT NULL;

ALTER TABLE jibres_nic.domain ADD `lastfetch` timestamp  NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `dateupdate` timestamp  NULL DEFAULT NULL;
ALTER TABLE jibres_nic.domain ADD `nicstatus` text  NULL DEFAULT NULL AFTER `lock`;
ALTER TABLE jibres_nic.domain ADD `reseller` varchar(100)  NULL DEFAULT NULL AFTER `bill`;
ALTER TABLE jibres_nic.domain ADD `roid` varchar(100)  NULL DEFAULT NULL AFTER `bill`;
ALTER TABLE jibres_nic.domain ADD `verify` bit(1) NULL DEFAULT NULL AFTER `lock`;

