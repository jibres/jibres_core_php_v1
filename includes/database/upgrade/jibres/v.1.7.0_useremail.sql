ALTER TABLE jibres.useremail ADD `emailraw` varchar(200) NULL DEFAULT NULL AFTER `email`;
ALTER TABLE jibres.useremail ADD INDEX `useremail_index_search_emailraw` (`emailraw`);

ALTER TABLE jibres.useremail ADD `daterequestverify` datetime NULL DEFAULT NULL AFTER `verify`;
ALTER TABLE jibres.useremail ADD `dateverify` datetime NULL DEFAULT NULL AFTER `verify`;