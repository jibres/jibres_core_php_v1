ALTER TABLE jibres.business_domain CHANGE `cdn` `cdn` ENUM('arvancloud','cloudflare','enterprise') NULL DEFAULT NULL;

ALTER TABLE jibres.business_domain_action ADD KEY `business_domain_action_index_datecreated` (`datecreated`);

ALTER TABLE jibres.business_domain ADD KEY `business_domain_index_datemodified` (`datemodified`);
ALTER TABLE jibres.business_domain ADD KEY `business_domain_index_dnsok` (`dnsok`);
ALTER TABLE jibres.business_domain ADD KEY `business_domain_index_redirecttomaster` (`redirecttomaster`);
ALTER TABLE jibres.business_domain ADD KEY `business_domain_index_subdomain` (`subdomain`);
ALTER TABLE jibres.business_domain ADD KEY `business_domain_index_cdn` (`cdn`);
