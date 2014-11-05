<?php
namespace sql;
class product_prices 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $product_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Product');
	public $productmeta_cat = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Cat');
	public $pa_startdate = array('type' => 'datetime@', 'null' =>'NO' ,'label' => 'Startdate');
	public $pa_enddate = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Enddate');
	public $pa_buy_price = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Buy Price');
	public $pa_price = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Price');
	public $pa_discount = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Discount');
	public $pa_vat = array('type' => 'decimal@6,4', 'null' =>'YES' ,'label' => 'Vat');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("#foreignkey")->name("product")->validate("id");
	}
	public function productmeta_cat() 
	{
		$this->form("text")->name("cat");
	}
	public function pa_startdate() 
	{
		$this->form("text")->name("startdate");
	}
	public function pa_enddate() 
	{
		$this->form("text")->name("enddate");
	}
	public function pa_buy_price() 
	{
		$this->form("text")->name("buy_price");
	}
	public function pa_price() 
	{
		$this->form("text")->name("price");
	}
	public function pa_discount() 
	{
		$this->form("text")->name("discount");
	}
	public function pa_vat() 
	{
		$this->form("text")->name("vat");
	}
	public function date_modified() {}
}
?>