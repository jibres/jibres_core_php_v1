
CREATE TABLE `factordetails` (
  `factor_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `count` float UNSIGNED DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `sum` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `factors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `customer` bigint(20) UNSIGNED DEFAULT NULL,
  `seller` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `pre` bit(1) DEFAULT NULL,
  `transport` bigint(20) UNSIGNED DEFAULT NULL,
  `pay` bit(1) DEFAULT NULL,
  `detailsum` bigint(20) UNSIGNED DEFAULT NULL,
  `detaildiscount` bigint(20) DEFAULT NULL,
  `detailtotalsum` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` float UNSIGNED DEFAULT NULL,
  `vat` int(10) UNSIGNED DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `sum` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','expire','draft','deleted') NOT NULL DEFAULT 'draft',
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `desc` text CHARACTER SET utf8mb4,
  `type` enum('sale','buy','presell','lending','backbuy','backsell','waste') NOT NULL,
  `discount2` int(10) DEFAULT NULL,
  `item` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `funds` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(500) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `initialbalance` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','delete','trash') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `pos` text CHARACTER SET utf8mb4
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `default` bit(1) DEFAULT NULL,
  `online` bit(1) DEFAULT NULL,
  `sale` bit(1) DEFAULT NULL,
  `sort` smallint(3) DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `productcategory` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `language` char(2) DEFAULT NULL,
  `properties` text CHARACTER SET utf8mb4,
  `desc` text CHARACTER SET utf8mb4,
  `seotitle` varchar(300) DEFAULT NULL,
  `seodesc` varchar(500) DEFAULT NULL,
  `file_id` int(10) UNSIGNED DEFAULT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','deleted') DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `productcomment` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `userstore_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` mediumtext,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `star` smallint(5) UNSIGNED DEFAULT NULL,
  `status` enum('approved','awaiting','unapproved','spam','deleted','filter','close','answered') NOT NULL DEFAULT 'awaiting',
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `productcompany` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `productprices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `last` enum('yes') DEFAULT NULL,
  `creator` int(10) UNSIGNED NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `buyprice` bigint(20) UNSIGNED DEFAULT NULL,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` bigint(20) DEFAULT NULL,
  `discountpercent` float DEFAULT NULL,
  `finalprice` bigint(20) DEFAULT NULL,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `factor_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `productproperties` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cat` varchar(100) DEFAULT NULL,
  `key` varchar(200) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `productterms`
--

CREATE TABLE `productterms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `type` enum('cat','tag','code','other','term') DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `url` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order` smallint(5) UNSIGNED DEFAULT NULL,
  `desc` mediumtext CHARACTER SET utf8mb4,
  `meta` mediumtext CHARACTER SET utf8mb4,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `creator` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('enable','disable','delete') NOT NULL DEFAULT 'enable',
  `count` int(10) UNSIGNED DEFAULT NULL,
  `site` enum('yes','no') NOT NULL DEFAULT 'yes',
  `valuetype` enum('decimal','integer') DEFAULT NULL,
  `isdefault` bit(1) DEFAULT NULL,
  `file` varchar(1000) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `defaultproperty` text CHARACTER SET utf8mb4
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `producttermusages`
--

CREATE TABLE `producttermusages` (
  `productterm_id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productunit`
--

CREATE TABLE `productunit` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `int` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `factordetails`
  ADD PRIMARY KEY (`factor_id`,`product_id`),
  ADD KEY `factordetails_product_id` (`product_id`);


ALTER TABLE `factors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_search_seller` (`seller`),
  ADD KEY `index_search_store_id` (`store_id`),
  ADD KEY `index_search_detailsum` (`detailsum`),
  ADD KEY `index_search_detaildiscount` (`detaildiscount`),
  ADD KEY `index_search_detailtotalsum` (`detailtotalsum`),
  ADD KEY `index_search_qty` (`qty`),
  ADD KEY `index_search_sum` (`sum`),
  ADD KEY `index_search_status` (`status`),
  ADD KEY `index_search_type` (`type`),
  ADD KEY `index_search_item` (`item`),
  ADD KEY `index_search_customer` (`customer`),
  ADD KEY `index_search_date` (`date`),
  ADD KEY `index_search_pay` (`pay`),
  ADD KEY `index_search_discount` (`discount`),
  ADD KEY `index_search_discount2` (`discount2`);

ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funds_store_id` (`store_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_store_id` (`store_id`);

ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productcategory_store_id` (`store_id`),
  ADD KEY `productcategory_file_id` (`file_id`);

--
-- Indexes for table `productcomment`
--
ALTER TABLE `productcomment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productcomment_userstore_id` (`userstore_id`),
  ADD KEY `productcomment_store_id_search_index` (`store_id`),
  ADD KEY `productcomment_product_id_search_index` (`product_id`),
  ADD KEY `productcomment_star_search_index` (`star`);

--
-- Indexes for table `productcompany`
--
ALTER TABLE `productcompany`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productcompany_store_id_search_index` (`store_id`);


ALTER TABLE `productinventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productinventory_inventory_id` (`inventory_id`),
  ADD KEY `productinventory_product_id` (`product_id`),
  ADD KEY `prudoctinventory_store_id` (`store_id`);

--
-- Indexes for table `productprices`
--
ALTER TABLE `productprices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productprices_product_id` (`product_id`),
  ADD KEY `productprices_creator` (`creator`),
  ADD KEY `productprices_factor_id` (`factor_id`),
  ADD KEY `productprices_last_search_index` (`last`);

--
-- Indexes for table `productproperties`
--
ALTER TABLE `productproperties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productpropreries_prudeuct_id` (`product_id`),
  ADD KEY `productpropreries_store_id` (`store_id`),
  ADD KEY `productproperties_cat_search_index` (`cat`),
  ADD KEY `productproperties_key_search_index` (`key`),
  ADD KEY `productproperties_value_search_index` (`value`),
  ADD KEY `productproperties_product_id_search_index` (`product_id`),
  ADD KEY `productproperties_store_id_search_index` (`store_id`);


-

--
-- Indexes for table `productterms`
--
ALTER TABLE `productterms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productterms_creator` (`creator`),
  ADD KEY `productterms_store_id` (`store_id`),
  ADD KEY `terms_type_search_index` (`type`),
  ADD KEY `terms_store_id_search_index` (`store_id`);

--
-- Indexes for table `producttermusages`
--
ALTER TABLE `producttermusages`
  ADD KEY `producttermusages_product_id_search_index` (`product_id`),
  ADD KEY `producttermusages_productterm_id_search_index` (`productterm_id`);

--
-- Indexes for table `productunit`
--
ALTER TABLE `productunit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productunit_store_id_search_index` (`store_id`);


--
-- Constraints for table `factordetails`
--
ALTER TABLE `factordetails`
  ADD CONSTRAINT `factordetails_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `factordetails_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `factors`
--
ALTER TABLE `factors`
  ADD CONSTRAINT `factors_customer` FOREIGN KEY (`seller`) REFERENCES `userstores` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `factors_seller` FOREIGN KEY (`customer`) REFERENCES `userstores` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `factors_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

ALTER TABLE `funds`
  ADD CONSTRAINT `funds_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `productcategory_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productcategory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productcomment`
--
ALTER TABLE `productcomment`
  ADD CONSTRAINT `productcomment_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productcomment_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productcomment_userstore_id` FOREIGN KEY (`userstore_id`) REFERENCES `userstores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productcompany`
--
ALTER TABLE `productcompany`
  ADD CONSTRAINT `productcompany_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productinventory`
--
ALTER TABLE `productinventory`
  ADD CONSTRAINT `productinventory_inventory_id` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productinventory_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prudoctinventory_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productprices`
--
ALTER TABLE `productprices`
  ADD CONSTRAINT `productprices_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productprices_factor_id` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productprices_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productproperties`
--
ALTER TABLE `productproperties`
  ADD CONSTRAINT `productpropreries_prudeuct_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productpropreries_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;


--
-- Constraints for table `products`
--

--
-- Constraints for table `productterms`
--
ALTER TABLE `productterms`
  ADD CONSTRAINT `productterms_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `productterms_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productunit`
--
ALTER TABLE `productunit`
  ADD CONSTRAINT `productunit_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

-