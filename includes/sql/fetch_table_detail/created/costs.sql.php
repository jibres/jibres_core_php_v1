<?php
namespace sql;
class costs 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $cost_title = array('type' => 'varchar@50', 'label' => 'title');
	public $cost_price = array('type' => 'decimal@13,4', 'label' => 'price');
	public $cc_id = array('type' => 'smallint@5', 'label' => 'id');
	public $account_id = array('type' => 'smallint@5', 'label' => 'id');
	public $cost_date = array('type' => 'datetime@', 'label' => 'date');
	public $cost_desc = array('type' => 'varchar@200', 'label' => 'desc');
	public $cost_type = array('type' => 'enum@income,outcome!outcome', 'label' => 'type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("#title")->name("title")->validate();
	}
	public function cost_price() 
	{
		$this->form()->name("price")
		->validate();
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
		$this->form()->name("date")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function cost_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function cost_type() 
	{
		$this->form()->name("type")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>