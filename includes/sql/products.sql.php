<?php
namespace sql;
class products 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $product_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $product_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $productcat_id = array('type' => 'smallint@5!1', 'null' =>'NO' ,'label' => 'Productcat', 'foreign' => 'productcats@id!productcat_title');
	public $product_barcode = array('type' => 'varchar@20', 'null' =>'YES' ,'label' => 'Barcode');
	public $product_barcode2 = array('type' => 'varchar@20', 'null' =>'YES' ,'label' => 'Barcode2');
	public $product_buyprice = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Buyprice');
	public $product_price = array('type' => 'decimal@13,4', 'null' =>'NO' ,'label' => 'Price');
	public $product_discount = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Discount');
	public $product_vat = array('type' => 'decimal@6,4', 'null' =>'YES' ,'label' => 'Vat');
	public $product_initialbalance = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Initialbalance');
	public $product_mininventory = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Mininventory');
	public $product_status = array('type' => 'enum@unset,available,soon,discontinued,unavailable!unset', 'null' =>'YES' ,'label' => 'Status');
	public $product_sold = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Sold');
	public $product_stock = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Stock');
	public $product_carton = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Carton');
	public $attachment_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Attachment', 'foreign' => 'attachments@id!attachment_title');
	public $product_service = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Service');
	public $product_sellin = array('type' => 'enum@store,online,both!both', 'null' =>'NO' ,'label' => 'Sellin');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function product_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function product_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("product_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function productcat_id() 
	{
		$this->form("select")->name("productcat")->validate("id");
		$this->setChild($this->form);
	}
	public function product_barcode() 
	{
		$this->form("text")->name("barcode");
	}
	public function product_barcode2() 
	{
		$this->form("text")->name("barcode2");
	}
	public function product_buyprice() 
	{
		$this->form("text")->name("buyprice");
	}
	public function product_price() 
	{
		$this->form("text")->name("price");
	}
	public function product_discount() 
	{
		$this->form("text")->name("discount");
	}
	public function product_vat() 
	{
		$this->form("text")->name("vat");
	}
	public function product_initialbalance() 
	{
		$this->form("text")->name("initialbalance");
	}
	public function product_mininventory() 
	{
		$this->form("text")->name("mininventory");
	}

	//------------------------------------------------------------------ select button
	public function product_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function product_sold() 
	{
		$this->form("text")->name("sold");
	}
	public function product_stock() 
	{
		$this->form("text")->name("stock");
	}
	public function product_carton() 
	{
		$this->form("text")->name("carton");
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function product_service() 
	{
		$this->form("radio")->name("service");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function product_sellin() 
	{
		$this->form("select")->name("sellin")->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>