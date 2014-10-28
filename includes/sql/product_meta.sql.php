<?php
namespace sql;
class product_meta 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $product_id = array('type' => 'smallint@5', 'label' => 'Product Id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'Cat');
	public $productmeta_name = array('type' => 'varchar@100', 'label' => 'Name');
	public $productmeta_value = array('type' => 'varchar@999', 'label' => 'Value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form()->name("Id")->validate("id");
	}
	public function productmeta_cat() 
	{
		$this->form()->name("Cat")
		->validate();
	}
	public function productmeta_name() 
	{
		$this->form()->name("Name")
		->validate();
	}
	public function productmeta_value() 
	{
		$this->form()->name("Value")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>