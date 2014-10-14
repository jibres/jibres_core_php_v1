<?php
namespace sql;
class product_meta 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'product_id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'productmeta_cat');
	public $productmeta_name = array('type' => 'varchar@100', 'label' => 'productmeta_name');
	public $productmeta_value = array('type' => 'varchar@999', 'label' => 'productmeta_value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->validate("id");
	}
	public function productmeta_cat() 
	{
		
	}
	public function productmeta_name() 
	{
		
	}
	public function productmeta_value() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>