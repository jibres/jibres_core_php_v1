
CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent` text NOT NULL,
  `group` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `osnum` varchar(50) DEFAULT NULL,
  `robot` bit(1) DEFAULT NULL,
  `meta` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `agentmd5` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`apilog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `apikey` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `appkey` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `zoneid` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `method` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `header` mediumtext CHARACTER SET utf8mb4,
  `headerlen` int(10) UNSIGNED DEFAULT NULL,
  `body` mediumtext CHARACTER SET utf8mb4,
  `bodylen` int(10) UNSIGNED DEFAULT NULL,
  `datesend` timestamp NULL DEFAULT NULL,
  `pagestatus` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `resultstatus` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `responseheader` mediumtext CHARACTER SET utf8mb4,
  `responsebody` mediumtext CHARACTER SET utf8mb4,
  `dateresponse` timestamp NULL DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `responselen` int(10) UNSIGNED DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `urlmd5` char(32) DEFAULT NULL,
  `notif` mediumtext CHARACTER SET utf8mb4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`dayevent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `countcalc` int(10) UNSIGNED DEFAULT NULL,
  `dbtrafic` int(10) UNSIGNED DEFAULT NULL,
  `dbsize` int(10) UNSIGNED DEFAULT NULL,
  `user` int(10) UNSIGNED DEFAULT NULL,
  `activeuser` int(10) UNSIGNED DEFAULT NULL,
  `deactiveuser` int(10) UNSIGNED DEFAULT NULL,
  `log` int(10) UNSIGNED DEFAULT NULL,
  `visitor` int(10) UNSIGNED DEFAULT NULL,
  `agent` int(10) UNSIGNED DEFAULT NULL,
  `session` int(10) UNSIGNED DEFAULT NULL,
  `urls` int(10) UNSIGNED DEFAULT NULL,
  `ticket` int(10) UNSIGNED DEFAULT NULL,
  `comment` int(10) UNSIGNED DEFAULT NULL,
  `address` int(10) UNSIGNED DEFAULT NULL,
  `news` int(10) UNSIGNED DEFAULT NULL,
  `page` int(10) UNSIGNED DEFAULT NULL,
  `post` int(10) UNSIGNED DEFAULT NULL,
  `transaction` int(10) UNSIGNED DEFAULT NULL,
  `term` int(10) UNSIGNED DEFAULT NULL,
  `termusages` int(10) UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `help` int(10) UNSIGNED DEFAULT NULL,
  `attachment` int(10) UNSIGNED DEFAULT NULL,
  `tag` int(10) UNSIGNED DEFAULT NULL,
  `cat` int(10) UNSIGNED DEFAULT NULL,
  `support_tag` int(10) UNSIGNED DEFAULT NULL,
  `help_tag` int(10) UNSIGNED DEFAULT NULL,
  `user_mobile` int(10) UNSIGNED DEFAULT NULL,
  `user_email` int(10) UNSIGNED DEFAULT NULL,
  `user_chatid` int(10) UNSIGNED DEFAULT NULL,
  `user_username` int(10) UNSIGNED DEFAULT NULL,
  `user_android` int(10) UNSIGNED DEFAULT NULL,
  `user_awaiting` int(10) UNSIGNED DEFAULT NULL,
  `user_removed` int(10) UNSIGNED DEFAULT NULL,
  `user_filter` int(10) UNSIGNED DEFAULT NULL,
  `user_unreachabl` int(10) UNSIGNED DEFAULT NULL,
  `user_permission` int(10) UNSIGNED DEFAULT NULL,
  `ticket_message` int(10) UNSIGNED DEFAULT NULL,
  `userdetail` int(10) UNSIGNED DEFAULT NULL,
  `lastactivity` BIGINT(20) NULL DEFAULT NULL,
`lastchangesetting` BIGINT(20) NULL DEFAULT NULL,
`lastadminlogin` BIGINT(20) NULL DEFAULT NULL,
`laststafflogin` BIGINT(20) NULL DEFAULT NULL,
`lastsale` BIGINT(20) NULL DEFAULT NULL,
`lastbuy` BIGINT(20) NULL DEFAULT NULL,
`customer` BIGINT(20) NULL DEFAULT NULL,
`staff` BIGINT(20) NULL DEFAULT NULL,
`sumplustransaction` BIGINT(20) NULL DEFAULT NULL,
`summinustransaction` BIGINT(20) NULL DEFAULT NULL,
`product` BIGINT(20) NULL DEFAULT NULL,
`factor` BIGINT(20) NULL DEFAULT NULL,
`factorbuy` BIGINT(20) NULL DEFAULT NULL,
`factorsale` BIGINT(20) NULL DEFAULT NULL,
`factordetail` BIGINT(20) NULL DEFAULT NULL,
`sumfactor` DECIMAL(22, 4) NULL DEFAULT NULL,
`planhistory` BIGINT(20) NULL DEFAULT NULL,
`cart` BIGINT(20) NULL DEFAULT NULL,
`sync` BIGINT(20) NULL DEFAULT NULL,
`apilog` BIGINT(20) NULL DEFAULT NULL,
`app_download` BIGINT(20) NULL DEFAULT NULL,
`csrf` BIGINT(20) NULL DEFAULT NULL,
`dayevent` BIGINT(20) NULL DEFAULT NULL,
`factoraction` BIGINT(20) NULL DEFAULT NULL,
`factoraddress` BIGINT(20) NULL DEFAULT NULL,
`files` BIGINT(20) NULL DEFAULT NULL,
`fileusage` BIGINT(20) NULL DEFAULT NULL,
`form` BIGINT(20) NULL DEFAULT NULL,
`form_answer` BIGINT(20) NULL DEFAULT NULL,
`form_answerdetail` BIGINT(20) NULL DEFAULT NULL,
`form_choice` BIGINT(20) NULL DEFAULT NULL,
`form_filter` BIGINT(20) NULL DEFAULT NULL,
`form_filter_where` BIGINT(20) NULL DEFAULT NULL,
`form_item` BIGINT(20) NULL DEFAULT NULL,
`funds` BIGINT(20) NULL DEFAULT NULL,
`importexport` BIGINT(20) NULL DEFAULT NULL,
`inventory` BIGINT(20) NULL DEFAULT NULL,
`ir_vat` BIGINT(20) NULL DEFAULT NULL,
`log_notif` BIGINT(20) NULL DEFAULT NULL,
`login` BIGINT(20) NULL DEFAULT NULL,
`login_ip` BIGINT(20) NULL DEFAULT NULL,
`pos` BIGINT(20) NULL DEFAULT NULL,
`productcategory` BIGINT(20) NULL DEFAULT NULL,
`productcategoryusage` BIGINT(20) NULL DEFAULT NULL,
`productcomment` BIGINT(20) NULL DEFAULT NULL,
`productcompany` BIGINT(20) NULL DEFAULT NULL,
`productinventory` BIGINT(20) NULL DEFAULT NULL,
`productprices` BIGINT(20) NULL DEFAULT NULL,
`productproperties` BIGINT(20) NULL DEFAULT NULL,
`producttag` BIGINT(20) NULL DEFAULT NULL,
`producttagusage` BIGINT(20) NULL DEFAULT NULL,
`productunit` BIGINT(20) NULL DEFAULT NULL,
`setting` BIGINT(20) NULL DEFAULT NULL,
`tax_coding` BIGINT(20) NULL DEFAULT NULL,
`tax_docdetail` BIGINT(20) NULL DEFAULT NULL,
`tax_document` BIGINT(20) NULL DEFAULT NULL,
`tax_year` BIGINT(20) NULL DEFAULT NULL,
`telegrams` BIGINT(20) NULL DEFAULT NULL,
`user_auth` BIGINT(20) NULL DEFAULT NULL,
`user_telegram` BIGINT(20) NULL DEFAULT NULL,
`userlegal` BIGINT(20) NULL DEFAULT NULL,
`visitors` BIGINT(20) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caller` varchar(200) DEFAULT NULL,
  `subdomain` varchar(100) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `send` bit(1) DEFAULT NULL,
  `to` int(10) UNSIGNED DEFAULT NULL,
  `notif` bit(1) DEFAULT NULL,
  `from` int(10) UNSIGNED DEFAULT NULL,
  `ip` bigint(20) DEFAULT NULL,
  `readdate` timestamp NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4,
  `status` enum('enable','disable','expire','deliver','awaiting','deleted','cancel','block','notif','notifread','notifexpire') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `sms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `telegram` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `expiredate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','terminate','expire','disable','changed','logout') NOT NULL DEFAULT 'active',
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `ip` bigint(20)  DEFAULT NULL,
  `count` int(10) UNSIGNED DEFAULT '1',
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_seen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`telegrams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chatid` bigint(20) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `step` text CHARACTER SET utf8mb4,
  `hook` mediumtext CHARACTER SET utf8mb4,
  `hooktext` text CHARACTER SET utf8mb4,
  `hookdate` datetime DEFAULT NULL,
  `hookmessageid` text CHARACTER SET utf8mb4,
  `send` mediumtext CHARACTER SET utf8mb4,
  `senddate` datetime DEFAULT NULL,
  `sendtext` text CHARACTER SET utf8mb4,
  `sendmesageid` text CHARACTER SET utf8mb4,
  `sendmethod` text CHARACTER SET utf8mb4,
  `sendkeyboard` text CHARACTER SET utf8mb4,
  `response` mediumtext CHARACTER SET utf8mb4,
  `responsedate` datetime DEFAULT NULL,
  `status` enum('enable','disable','ok','failed','other') DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `send2` mediumtext CHARACTER SET utf8mb4,
  `response2` mediumtext CHARACTER SET utf8mb4,
  `send3` mediumtext CHARACTER SET utf8mb4,
  `response3` mediumtext CHARACTER SET utf8mb4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `urlmd5` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `domain` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `subdomain` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `path` text CHARACTER SET utf8mb4,
  `query` text CHARACTER SET utf8mb4,
  `pwd` text CHARACTER SET utf8mb4,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `jibres_XXXXXXX`.`visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `statuscode` int(5) DEFAULT NULL,
  `visitor_ip` bigint(20)  DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `url_id` int(10) UNSIGNED NOT NULL,
  `url_idreferer` int(10) UNSIGNED DEFAULT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` timestamp NOT NULL,
  `avgtime` int(10) UNSIGNED DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




ALTER TABLE `jibres_XXXXXXX`.`agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_agentmd5` (`agentmd5`);


ALTER TABLE `jibres_XXXXXXX`.`apilog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_version` (`version`),
  ADD KEY `index_search_token` (`token`),
  ADD KEY `index_search_apikey` (`apikey`),
  ADD KEY `index_search_appkey` (`appkey`),
  ADD KEY `index_search_zoneid` (`zoneid`),
  ADD KEY `index_search_method` (`method`),
  ADD KEY `index_search_headerlen` (`headerlen`),
  ADD KEY `index_search_bodylen` (`bodylen`),
  ADD KEY `index_search_pagestatus` (`pagestatus`),
  ADD KEY `index_search_resultstatus` (`resultstatus`),
  ADD KEY `index_search_responselen` (`responselen`),
  ADD KEY `index_search_urlmd5` (`urlmd5`),
  ADD KEY `index_search_subdomain` (`subdomain`);


ALTER TABLE `jibres_XXXXXXX`.`dayevent`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `jibres_XXXXXXX`.`logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_status_index` (`status`),
  ADD KEY `log_to_index` (`to`),
  ADD KEY `log_expiredate` (`expiredate`),
  ADD KEY `log_caller` (`caller`),
  ADD KEY `log_code` (`code`),
  ADD KEY `index_search_send` (`send`),
  ADD KEY `index_search_notif` (`notif`),
  ADD KEY `index_search_caller` (`caller`),
  ADD KEY `index_search_subdomain` (`subdomain`),
  ADD KEY `index_search_readdate` (`readdate`),
  ADD KEY `index_search_datecreated` (`datecreated`);


ALTER TABLE `jibres_XXXXXXX`.`sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`code`) USING BTREE,
  ADD KEY `sessions_user_id` (`user_id`),
  ADD KEY `index_search_code` (`code`),
  ADD KEY `index_search_user_id` (`user_id`),
  ADD KEY `index_search_status` (`status`),
  ADD KEY `index_search_agent_id` (`agent_id`);


ALTER TABLE `jibres_XXXXXXX`.`telegrams`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `jibres_XXXXXXX`.`urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urlmd5_index` (`urlmd5`);


ALTER TABLE `jibres_XXXXXXX`.`visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_agents` (`agent_id`),
  ADD KEY `visitors_urls` (`url_id`),
  ADD KEY `visitors_urls_referer` (`url_idreferer`);




ALTER TABLE `jibres_XXXXXXX`.`agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`apilog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`dayevent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`telegrams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`urls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `jibres_XXXXXXX`.`visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;




ALTER TABLE `jibres_XXXXXXX`.`sessions`
  ADD CONSTRAINT `sessions_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE;


ALTER TABLE `jibres_XXXXXXX`.`visitors`
  ADD CONSTRAINT `visitors_agents` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_urls` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_urls_referer` FOREIGN KEY (`url_idreferer`) REFERENCES `urls` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
