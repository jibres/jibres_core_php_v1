ALTER TABLE jibres.business_domain DROP `f_ssl_https_upstram`;
ALTER TABLE jibres.business_domain DROP `f_ssl_redirect`;

ALTER TABLE jibres.business_domain ADD `lastactivity` datetime NULL DEFAULT NULL;
ALTER TABLE jibres.business_domain ADD `nextactivity` datetime NULL DEFAULT NULL;
ALTER TABLE jibres.business_domain ADD INDEX `business_domain_index_nextactivity` (`nextactivity`);

ALTER TABLE jibres.business_domain ADD `verifyprocess` text NULL DEFAULT NULL;


ALTER TABLE jibres.business_domain CHANGE `status` `status` ENUM('pending','failed','ok','pending_delete','deleted','inprogress','dns_not_resolved', 'pending_verify', 'cancel') CHARACTER SET utf8mb4  NULL DEFAULT NULL;