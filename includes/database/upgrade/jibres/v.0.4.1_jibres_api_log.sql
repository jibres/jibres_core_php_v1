CREATE DATABASE IF NOT EXISTS `jibres_api_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;


CREATE TABLE jibres_api_log.apilog (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int UNSIGNED DEFAULT NULL,
`token` varchar(100) DEFAULT NULL,
`apikey` varchar(100) DEFAULT NULL,
`appkey` varchar(100) DEFAULT NULL,
`zoneid` varchar(100) DEFAULT NULL,
`url` varchar(2000) DEFAULT NULL,
`method` varchar(200) DEFAULT NULL,
`header` mediumtext,
`headerlen` int UNSIGNED DEFAULT NULL,
`body` mediumtext,
`bodylen` int UNSIGNED DEFAULT NULL,
`datesend` timestamp NULL DEFAULT NULL,
`pagestatus` varchar(100) DEFAULT NULL,
`resultstatus` varchar(100) DEFAULT NULL,
`responseheader` mediumtext,
`responsebody` mediumtext,
`dateresponse` timestamp NULL DEFAULT NULL,
`version` varchar(100) DEFAULT NULL,
`responselen` int UNSIGNED DEFAULT NULL,
`subdomain` varchar(100) DEFAULT NULL,
`urlmd5` char(32) DEFAULT NULL,
`notif` mediumtext,
PRIMARY KEY (`id`),
KEY `index_search_version` (`version`),
KEY `index_search_token` (`token`),
KEY `index_search_apikey` (`apikey`),
KEY `index_search_appkey` (`appkey`),
KEY `index_search_zoneid` (`zoneid`),
KEY `index_search_method` (`method`),
KEY `index_search_headerlen` (`headerlen`),
KEY `index_search_bodylen` (`bodylen`),
KEY `index_search_pagestatus` (`pagestatus`),
KEY `index_search_resultstatus` (`resultstatus`),
KEY `index_search_responselen` (`responselen`),
KEY `index_search_urlmd5` (`urlmd5`),
KEY `index_search_subdomain` (`subdomain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

