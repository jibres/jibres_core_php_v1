ALTER TABLE jibres.dayevent ADD `apilog` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `business_domain` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `business_domain_action` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `business_domain_dns` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `csrf` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `files` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `fileusage` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `gift` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `giftusage` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `log_notif` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `login` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `login_ip` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `setting` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_analytics` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_app` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_data` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_domain` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_file` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_plan` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_timeline` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `store_user` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `telegrams` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `user_auth` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `user_telegram` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `userdetail` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `useremail` BIGINT NULL DEFAULT NULL;


ALTER TABLE jibres.dayevent ADD `nic_contact` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_contactdetail` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_credit` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_dns` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_domain` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_domainaction` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_domainbilling` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_domainstatus` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_poll` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_usersetting` BIGINT NULL DEFAULT NULL;


ALTER TABLE jibres.dayevent ADD `nic_log_domainactivity` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_log_domains` BIGINT NULL DEFAULT NULL;
ALTER TABLE jibres.dayevent ADD `nic_log_log` BIGINT NULL DEFAULT NULL;

ALTER TABLE jibres.dayevent ADD `onlinenic_log_log` BIGINT NULL DEFAULT NULL;

ALTER TABLE jibres.dayevent ADD `visitor_ip` BIGINT NULL DEFAULT NULL;