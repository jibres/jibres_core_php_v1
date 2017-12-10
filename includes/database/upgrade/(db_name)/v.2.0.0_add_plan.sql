CREATE TABLE `storeplans` (
`id` bigint(20) UNSIGNED NOT NULL,
`store_id` int(10) UNSIGNED NOT NULL,
`plan` int(10) NOT NULL,
`start` datetime NOT NULL,
`end` datetime DEFAULT NULL,
`creator` int(10) UNSIGNED NOT NULL,
`desc` text CHARACTER SET utf8mb4,
`meta` mediumtext CHARACTER SET utf8mb4,
`createdate` datetime DEFAULT CURRENT_TIMESTAMP,
`date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`status` enum('enable','disable','awaiting','paid','skipped') DEFAULT NULL,
`lastcalcdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for table `storeplans`
--
ALTER TABLE `storeplans`
ADD PRIMARY KEY (`id`),
ADD KEY `storeplans_store_id` (`store_id`),
ADD KEY `storeplans_creator` (`creator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `storeplans`
--
ALTER TABLE `storeplans`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `storeplans`
--
ALTER TABLE `storeplans`
ADD CONSTRAINT `storeplans_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `storeplans_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;


ALTER TABLE `stores` ADD  `startplanday` SMALLINT(2) NULL DEFAULT NULL;
ALTER TABLE `stores` ADD  `startplan` datetime NULL DEFAULT NULL;