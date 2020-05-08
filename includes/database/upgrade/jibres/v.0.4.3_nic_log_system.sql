ALTER TABLE jibres_nic_log.log CHANGE `gateway` `gateway` enum('system', 'user', 'api') NULL DEFAULT NULL;

ALTER TABLE jibres_nic_log.log CHANGE `type` `type` enum(
'whois',
'contact_check',
'contact_info',
'contact_create',
'contact_update',
'contact_credit',
'domain_check',
'domain_lock',
'domain_unlock',
'domain_info',
'domain_create',
'domain_update',
'domain_renew',
'domain_delete',
'domain_transfer',
'poll_request',
'poll_acknowledge'
) DEFAULT NULL;


CREATE TABLE IF NOT EXISTS jibres_nic.credit (
`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`nic_id` varchar(100) DEFAULT NULL,
`roid` varchar(100) DEFAULT NULL,
`date` datetime NULL DEFAULT NULL,
`description` text NULL DEFAULT NULL,
`amount` int(10)  NULL DEFAULT NULL,
`balance` int(10)  NULL DEFAULT NULL,
`datecreated` datetime NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
