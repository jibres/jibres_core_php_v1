ALTER TABLE jibres_XXXXXXX.factordetails ADD `status` enum('enable','disable','draft','order','expire','cancel','pending_pay','pending_verify','pending_prepare','pending_send','sending','deliver','reject','spam','deleted') DEFAULT 'enable';
ALTER TABLE jibres_XXXXXXX.factordetails ADD KEY `factordetails_search_index_status` (`status`);
