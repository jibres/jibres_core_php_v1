<?php
namespace sql;
class products {
	public $id = array('type' => 'smallint@5', 'label' => 'products_id');
	public $product_title = array('type' => 'varchar@100', 'label' => 'products_product_title');
	public $product_slug = array('type' => 'varchar@50', 'label' => 'products_product_slug');
	public $pcat_id = array('type' => 'smallint@5!1', 'label' => 'products_pcat_id');
	public $product_barcode = array('type' => 'varchar@20', 'label' => 'products_product_barcode');
	public $product_barcode2 = array('type' => 'varchar@20', 'label' => 'products_product_barcode2');
	public $product_buy_price = array('type' => 'decimal@13,4', 'label' => 'products_product_buy_price');
	public $product_price = array('type' => 'decimal@13,4', 'label' => 'products_product_price');
	public $product_discount = array('type' => 'decimal@13,4', 'label' => 'products_product_discount');
	public $product_vat = array('type' => 'decimal@6,4', 'label' => 'products_product_vat');
	public $product_initial_balance = array('type' => 'int@10', 'label' => 'products_product_initial_balance');
	public $product_min_inventory = array('type' => 'int@10', 'label' => 'products_product_min_inventory');
	public $product_status = array('type' => 'enum@unset,available,soon,discontinued,unavailable!unset', 'label' => 'products_product_status');
	public $product_sold = array('type' => 'int@10', 'label' => 'products_product_sold');
	public $product_stock = array('type' => 'int@10', 'label' => 'products_product_stock');
	public $product_carton = array('type' => 'int@10', 'label' => 'products_product_carton');
	public $attachment_id = array('type' => 'int@10', 'label' => 'products_attachment_id');
	public $product_service = array('type' => 'enum@yes,no!no', 'label' => 'products_product_service');
	public $product_sellin = array('type' => 'enum@store,online,both!both', 'label' => 'products_product_sellin');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'products_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'products_date_modified');

	public function id(){}
	public function product_title(){}
	public function product_slug(){}
	public function pcat_id(){}
	public function product_barcode(){}
	public function product_barcode2(){}
	public function product_buy_price(){}
	public function product_price(){}
	public function product_discount(){}
	public function product_vat(){}
	public function product_initial_balance(){}
	public function product_min_inventory(){}
	public function product_status(){}
	public function product_sold(){}
	public function product_stock(){}
	public function product_carton(){}
	public function attachment_id(){}
	public function product_service(){}
	public function product_sellin(){}
	public function date_created(){}
	public function date_modified(){}
}
?>