<?php
namespace sql;
class costs 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $cost_title = array('type' => 'varchar@50', 'label' => 'cost_title');
	public $cost_price = array('type' => 'decimal@13,4', 'label' => 'cost_price');
	public $cc_id = array('type' => 'smallint@5', 'label' => 'cc_id');
	public $account_id = array('type' => 'smallint@5', 'label' => 'account_id');
	public $cost_date = array('type' => 'datetime@', 'label' => 'cost_date');
	public $cost_desc = array('type' => 'varchar@200', 'label' => 'cost_desc');
	public $cost_type = array('type' => 'enum@income,outcome!outcome', 'label' => 'cost_type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("title")->name("cost_title");
	}
	public function cost_price() 
	{
		
	}

	//------------------------------------------------------------------ id - foreign key
	public function cc_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->validate("id");
	}
	public function cost_date() 
	{
		
	}

	//------------------------------------------------------------------ description
	public function cost_desc() 
	{
		$this->form("desc")->name("cost_desc");
	}
	public function cost_type() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>