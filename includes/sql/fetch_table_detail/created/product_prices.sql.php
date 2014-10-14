<?php
namespace sql;
class product_prices 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'product_id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'productmeta_cat');
	public $pa_startdate = array('type' => 'datetime@', 'label' => 'pa_startdate');
	public $pa_enddate = array('type' => 'datetime@', 'label' => 'pa_enddate');
	public $pa_buy_price = array('type' => 'decimal@13,4', 'label' => 'pa_buy_price');
	public $pa_price = array('type' => 'decimal@13,4', 'label' => 'pa_price');
	public $pa_discount = array('type' => 'decimal@13,4', 'label' => 'pa_discount');
	public $pa_vat = array('type' => 'decimal@6,4', 'label' => 'pa_vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->validate("id");
	}
	public function productmeta_cat() 
	{
		
	}
	public function pa_startdate() 
	{
		
	}
	public function pa_enddate() 
	{
		
	}
	public function pa_buy_price() 
	{
		
	}
	public function pa_price() 
	{
		
	}
	public function pa_discount() 
	{
		
	}
	public function pa_vat() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>