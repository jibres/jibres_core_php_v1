<?php
namespace sql;
class products 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $product_title = array('type' => 'varchar@100', 'label' => 'title');
	public $product_slug = array('type' => 'varchar@50', 'label' => 'slug');
	public $pcat_id = array('type' => 'smallint@5!1', 'label' => 'id');
	public $product_barcode = array('type' => 'varchar@20', 'label' => 'barcode');
	public $product_barcode2 = array('type' => 'varchar@20', 'label' => 'barcode2');
	public $product_buy_price = array('type' => 'decimal@13,4', 'label' => 'buy_price');
	public $product_price = array('type' => 'decimal@13,4', 'label' => 'price');
	public $product_discount = array('type' => 'decimal@13,4', 'label' => 'discount');
	public $product_vat = array('type' => 'decimal@6,4', 'label' => 'vat');
	public $product_initial_balance = array('type' => 'int@10', 'label' => 'initial_balance');
	public $product_min_inventory = array('type' => 'int@10', 'label' => 'min_inventory');
	public $product_status = array('type' => 'enum@unset,available,soon,discontinued,unavailable!unset', 'label' => 'status');
	public $product_sold = array('type' => 'int@10', 'label' => 'sold');
	public $product_stock = array('type' => 'int@10', 'label' => 'stock');
	public $product_carton = array('type' => 'int@10', 'label' => 'carton');
	public $attachment_id = array('type' => 'int@10', 'label' => 'id');
	public $product_service = array('type' => 'enum@yes,no!no', 'label' => 'service');
	public $product_sellin = array('type' => 'enum@store,online,both!both', 'label' => 'sellin');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function product_title() 
	{
		$this->form("#title")->name("title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function product_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['product_title']->value
	}

	//------------------------------------------------------------------ id - foreign key
	public function pcat_id() 
	{
		$this->validate("id");
	}
	public function product_barcode() 
	{
		$this->form()->name("barcode")
		->validate();
	}
	public function product_barcode2() 
	{
		$this->form()->name("barcode2")
		->validate();
	}
	public function product_buy_price() 
	{
		$this->form()->name("buy_price")
		->validate();
	}
	public function product_price() 
	{
		$this->form()->name("price")
		->validate();
	}
	public function product_discount() 
	{
		$this->form()->name("discount")
		->validate();
	}
	public function product_vat() 
	{
		$this->form()->name("vat")
		->validate();
	}
	public function product_initial_balance() 
	{
		$this->form()->name("initial_balance")
		->validate();
	}
	public function product_min_inventory() 
	{
		$this->form()->name("min_inventory")
		->validate();
	}
	public function product_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function product_sold() 
	{
		$this->form()->name("sold")
		->validate();
	}
	public function product_stock() 
	{
		$this->form()->name("stock")
		->validate();
	}
	public function product_carton() 
	{
		$this->form()->name("carton")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->validate("id");
	}
	public function product_service() 
	{
		$this->form()->name("service")
		->validate();
	}
	public function product_sellin() 
	{
		$this->form()->name("sellin")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>