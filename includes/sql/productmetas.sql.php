<?php
namespace sql;
class productmetas 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $product_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'YES', 'label'=>'Product', 'foreign'=>'products@id!product_title');
	public $productmeta_cat = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Cat');
	public $productmeta_name = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $productmeta_value = array('type' => 'varchar@999', 'null'=>'YES', 'show'=>'YES', 'label'=>'Value');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null'=>'NO', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function productmeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function productmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function productmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(999)->type('textarea');
	}
	public function date_modified() {}
}
?>