<?php
namespace sql;
class product_meta 
{
	public $id = array('type' => 'int@10', 'label' => 'd');
	public $product_id = array('type' => 'smallint@5', 'label' => 'id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'cat');
	public $productmeta_name = array('type' => 'varchar@100', 'label' => 'name');
	public $productmeta_value = array('type' => 'varchar@999', 'label' => 'value');
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
	public function productmeta_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function productmeta_value() 
	{
		$this->form()->name("value")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>