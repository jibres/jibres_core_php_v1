<?php
namespace sql;
class costs 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $cost_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $cost_price = array('type' => 'decimal@13,4', 'label' => 'Price');
	public $cc_id = array('type' => 'smallint@5', 'label' => 'Cc Id');
	public $account_id = array('type' => 'smallint@5', 'label' => 'Account Id');
	public $cost_date = array('type' => 'datetime@', 'label' => 'Date');
	public $cost_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $cost_type = array('type' => 'enum@income,outcome!outcome', 'label' => 'Type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("#title")->name("Title")->validate();
	}
	public function cost_price() 
	{
		$this->form()->name("Price")
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
		$this->form()->name("Date")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function cost_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}

	//------------------------------------------------------------------ radio button
	public function cost_type() 
	{
		$this->form("radio")->name("Type")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>