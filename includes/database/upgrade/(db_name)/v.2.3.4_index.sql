ALTER TABLE `factors` ADD CONSTRAINT `factors_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

ALTER TABLE `factors` ADD INDEX `index_search_store_id` (`store_id`);
ALTER TABLE `factors` ADD INDEX `index_search_detailsum` (`detailsum`);
ALTER TABLE `factors` ADD INDEX `index_search_detaildiscount` (`detaildiscount`);
ALTER TABLE `factors` ADD INDEX `index_search_detailtotalsum` (`detailtotalsum`);
ALTER TABLE `factors` ADD INDEX `index_search_qty` (`qty`);
ALTER TABLE `factors` ADD INDEX `index_search_sum` (`sum`);
ALTER TABLE `factors` ADD INDEX `index_search_status` (`status`);
ALTER TABLE `factors` ADD INDEX `index_search_type` (`type`);
ALTER TABLE `factors` ADD INDEX `index_search_item` (`item`);
ALTER TABLE `factors` ADD INDEX `index_search_customer` (`customer`);
ALTER TABLE `factors` ADD INDEX `index_search_date` (`date`);
ALTER TABLE `factors` ADD INDEX `index_search_pay` (`pay`);
ALTER TABLE `factors` ADD INDEX `index_search_discount` (`discount`);
ALTER TABLE `factors` ADD INDEX `index_search_discount2` (`discount2`);



ALTER TABLE `products` ADD INDEX `index_search_title` (`title`);
ALTER TABLE `products` ADD INDEX `index_search_barcode` (`barcode`);
ALTER TABLE `products` ADD INDEX `index_search_barcode2` (`barcode2`);
ALTER TABLE `products` ADD INDEX `index_search_quickcode` (`quickcode`);
ALTER TABLE `products` ADD INDEX `index_search_buyprice` (`buyprice`);
ALTER TABLE `products` ADD INDEX `index_search_price` (`price`);
ALTER TABLE `products` ADD INDEX `index_search_discount` (`discount`);
ALTER TABLE `products` ADD INDEX `index_search_status` (`status`);
ALTER TABLE `products` ADD INDEX `index_search_sold` (`sold`);
ALTER TABLE `products` ADD INDEX `index_search_stock` (`stock`);
ALTER TABLE `products` ADD INDEX `index_search_store_id` (`store_id`);



ALTER TABLE `userstores` ADD INDEX `index_search_store_id` (`store_id`);
ALTER TABLE `userstores` ADD INDEX `index_search_user_id` (`user_id`);
ALTER TABLE `userstores` ADD INDEX `index_search_displayname` (`displayname`);
ALTER TABLE `userstores` ADD INDEX `index_search_firstname` (`firstname`);
ALTER TABLE `userstores` ADD INDEX `index_search_lastname` (`lastname`);
ALTER TABLE `userstores` ADD INDEX `index_search_mobile` (`mobile`);
ALTER TABLE `userstores` ADD INDEX `index_search_staff` (`staff`);
ALTER TABLE `userstores` ADD INDEX `index_search_supplier` (`supplier`);
ALTER TABLE `userstores` ADD INDEX `index_search_customer` (`customer`);
ALTER TABLE `userstores` ADD INDEX `index_search_status` (`status`);


ALTER TABLE `productterms` ADD CONSTRAINT `productterms_store_id` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;
ALTER TABLE `storetransactions` ADD `finalmsg` bit(1) DEFAULT NULL;