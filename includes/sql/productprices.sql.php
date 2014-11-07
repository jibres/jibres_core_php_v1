<?php
namespace sql;
class productprices 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $product_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Product', 'foreign' => 'products@id!product_title');
	public $productmeta_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Productmeta', 'foreign' => 'productmetas@id!productmeta_title');
	public $productprice_cat = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Cat');
	public $productprice_startdate = array('type' => 'datetime@', 'null' =>'NO' ,'label' => 'Startdate');
	public $productprice_enddate = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Enddate');
	public $productprice_buyprice = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Buyprice');
	public $productprice_price = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Price');
	public $productprice_discount = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Discount');
	public $productprice_vat = array('type' => 'decimal@6,4', 'null' =>'YES' ,'label' => 'Vat');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("#foreignkey")->name("product")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function productmeta_id() 
	{
		$this->form("#foreignkey")->name("productmeta")->validate("id");
	}
	public function productprice_cat() 
	{
		$this->form("text")->name("cat");
	}
	public function productprice_startdate() 
	{
		$this->form("text")->name("startdate");
	}
	public function productprice_enddate() 
	{
		$this->form("text")->name("enddate");
	}
	public function productprice_buyprice() 
	{
		$this->form("text")->name("buyprice");
	}
	public function productprice_price() 
	{
		$this->form("text")->name("price");
	}
	public function productprice_discount() 
	{
		$this->form("text")->name("discount");
	}
	public function productprice_vat() 
	{
		$this->form("text")->name("vat");
	}
	public function date_modified() {}
}
?>