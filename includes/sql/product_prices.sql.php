<?php
namespace sql;
class product_prices 
{
	public $id = array('type' => 'int@10', 'label' => 'd');
	public $product_id = array('type' => 'smallint@5', 'label' => 'id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'cat');
	public $pa_startdate = array('type' => 'datetime@', 'label' => 'startdate');
	public $pa_enddate = array('type' => 'datetime@', 'label' => 'enddate');
	public $pa_buy_price = array('type' => 'decimal@13,4', 'label' => 'buy_price');
	public $pa_price = array('type' => 'decimal@13,4', 'label' => 'price');
	public $pa_discount = array('type' => 'decimal@13,4', 'label' => 'discount');
	public $pa_vat = array('type' => 'decimal@6,4', 'label' => 'vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->validate("id");
	}
	public function productmeta_cat() 
	{
		$this->form()->name("cat")
		->validate();
	}
	public function pa_startdate() 
	{
		$this->form()->name("startdate")
		->validate();
	}
	public function pa_enddate() 
	{
		$this->form()->name("enddate")
		->validate();
	}
	public function pa_buy_price() 
	{
		$this->form()->name("buy_price")
		->validate();
	}
	public function pa_price() 
	{
		$this->form()->name("price")
		->validate();
	}
	public function pa_discount() 
	{
		$this->form()->name("discount")
		->validate();
	}
	public function pa_vat() 
	{
		$this->form()->name("vat")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>