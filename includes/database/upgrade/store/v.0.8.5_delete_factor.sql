ALTER TABLE jibres_XXXXXXX.productinventory CHANGE `action` `action` enum('initial','manual','move_to_inventory','move_from_inventory','warehouse_handling','sale','edit_sale','buy','edit_buy','presell','edit_presell','lending','edit_lending','backbuy','edit_backbuy','backsell','edit_backsell','waste','edit_waste','saleorder','edit_saleorder','reject_order','cancel_order', 'expire_order', 'deleted_order') DEFAULT NULL;