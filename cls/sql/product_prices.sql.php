<?php
namespace sql;
class product_prices {
	public $id = array('type' => 'int@10', 'label' => 'product_prices_id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'product_prices_product_id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'product_prices_productmeta_cat');
	public $pa_startdate = array('type' => 'datetime@', 'label' => 'product_prices_pa_startdate');
	public $pa_enddate = array('type' => 'datetime@', 'label' => 'product_prices_pa_enddate');
	public $pa_buy_price = array('type' => 'decimal@13,4', 'label' => 'product_prices_pa_buy_price');
	public $pa_price = array('type' => 'decimal@13,4', 'label' => 'product_prices_pa_price');
	public $pa_discount = array('type' => 'decimal@13,4', 'label' => 'product_prices_pa_discount');
	public $pa_vat = array('type' => 'decimal@6,4', 'label' => 'product_prices_pa_vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'product_prices_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'product_prices_date_modified');

	public function id(){}
	public function product_id(){}
	public function productmeta_cat(){}
	public function pa_startdate(){}
	public function pa_enddate(){}
	public function pa_buy_price(){}
	public function pa_price(){}
	public function pa_discount(){}
	public function pa_vat(){}
	public function date_created(){}
	public function date_modified(){}
}
?>