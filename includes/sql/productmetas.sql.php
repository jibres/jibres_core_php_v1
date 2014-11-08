<?php
namespace sql;
class productmetas 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $product_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Product', 'foreign' => 'products@id!product_title');
	public $productmeta_cat = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Cat');
	public $productmeta_name = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Name');
	public $productmeta_value = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Value');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("productid")->validate("id");
		$this->setChild($this->form);
	}
	public function productmeta_cat() 
	{
		$this->form("text")->name("cat");
	}
	public function productmeta_name() 
	{
		$this->form("text")->name("name");
	}
	public function productmeta_value() 
	{
		$this->form("text")->name("value");
	}
	public function date_modified() {}
}
?>