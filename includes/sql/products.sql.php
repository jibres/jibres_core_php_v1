<?php
namespace sql;
class products 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $product_title = array('type' => 'varchar@100', 'label' => 'Title');
	public $product_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $pcat_id = array('type' => 'smallint@5!1', 'label' => 'Pcat Id');
	public $product_barcode = array('type' => 'varchar@20', 'label' => 'Barcode');
	public $product_barcode2 = array('type' => 'varchar@20', 'label' => 'Barcode2');
	public $product_buy_price = array('type' => 'decimal@13,4', 'label' => 'Buy Price');
	public $product_price = array('type' => 'decimal@13,4', 'label' => 'Price');
	public $product_discount = array('type' => 'decimal@13,4', 'label' => 'Discount');
	public $product_vat = array('type' => 'decimal@6,4', 'label' => 'Vat');
	public $product_initial_balance = array('type' => 'int@10', 'label' => 'Initial Balance');
	public $product_min_inventory = array('type' => 'int@10', 'label' => 'Min Inventory');
	public $product_status = array('type' => 'enum@unset,available,soon,discontinued,unavailable!unset', 'label' => 'Status');
	public $product_sold = array('type' => 'int@10', 'label' => 'Sold');
	public $product_stock = array('type' => 'int@10', 'label' => 'Stock');
	public $product_carton = array('type' => 'int@10', 'label' => 'Carton');
	public $attachment_id = array('type' => 'int@10', 'label' => 'Attachment Id');
	public $product_service = array('type' => 'enum@yes,no!no', 'label' => 'Service');
	public $product_sellin = array('type' => 'enum@store,online,both!both', 'label' => 'Sellin');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function product_title() 
	{
		$this->form("#title")->name("Title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function product_slug() 
	{
		$this->form()->name("Slug")->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function pcat_id() 
	{
		$this->validate("id");
	}
	public function product_barcode() 
	{
		$this->form()->name("Barcode")
		->validate();
	}
	public function product_barcode2() 
	{
		$this->form()->name("Barcode2")
		->validate();
	}
	public function product_buy_price() 
	{
		$this->form()->name("Buy Price")
		->validate();
	}
	public function product_price() 
	{
		$this->form()->name("Price")
		->validate();
	}
	public function product_discount() 
	{
		$this->form()->name("Discount")
		->validate();
	}
	public function product_vat() 
	{
		$this->form()->name("Vat")
		->validate();
	}
	public function product_initial_balance() 
	{
		$this->form()->name("Initial Balance")
		->validate();
	}
	public function product_min_inventory() 
	{
		$this->form()->name("Min Inventory")
		->validate();
	}

	//------------------------------------------------------------------ select button
	public function product_status() 
	{
		$this->form("select")->name("Status")->validate();
		$this->setChild($this->form);
	}
	public function product_sold() 
	{
		$this->form()->name("Sold")
		->validate();
	}
	public function product_stock() 
	{
		$this->form()->name("Stock")
		->validate();
	}
	public function product_carton() 
	{
		$this->form()->name("Carton")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ radio button
	public function product_service() 
	{
		$this->form("radio")->name("Service")->validate();
		$this->setChild($this->form);
	}
	public function product_sellin() 
	{
		$this->form()->name("Sellin")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>