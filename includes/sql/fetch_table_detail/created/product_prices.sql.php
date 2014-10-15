<?php
namespace sql;
class product_prices 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $product_id = array('type' => 'smallint@5', 'label' => 'Product Id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'Cat');
	public $pa_startdate = array('type' => 'datetime@', 'label' => 'Startdate');
	public $pa_enddate = array('type' => 'datetime@', 'label' => 'Enddate');
	public $pa_buy_price = array('type' => 'decimal@13,4', 'label' => 'Buy Price');
	public $pa_price = array('type' => 'decimal@13,4', 'label' => 'Price');
	public $pa_discount = array('type' => 'decimal@13,4', 'label' => 'Discount');
	public $pa_vat = array('type' => 'decimal@6,4', 'label' => 'Vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->validate("id");
	}
	public function productmeta_cat() 
	{
		$this->form()->name("Cat")
		->validate();
	}
	public function pa_startdate() 
	{
		$this->form()->name("Startdate")
		->validate();
	}
	public function pa_enddate() 
	{
		$this->form()->name("Enddate")
		->validate();
	}
	public function pa_buy_price() 
	{
		$this->form()->name("Buy Price")
		->validate();
	}
	public function pa_price() 
	{
		$this->form()->name("Price")
		->validate();
	}
	public function pa_discount() 
	{
		$this->form()->name("Discount")
		->validate();
	}
	public function pa_vat() 
	{
		$this->form()->name("Vat")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>