<?php
namespace sql;
class costs 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $cost_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $cost_price = array('type' => 'decimal@13,4', 'label' => 'Price');
	public $cc_id = array('type' => 'smallint@5', 'label' => 'Cc');
	public $account_id = array('type' => 'smallint@5', 'label' => 'Account');
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
		$this->form("#title");
	}
	public function cost_price() 
	{
		$this->form()->name("price");
	}

	//------------------------------------------------------------------ id - foreign key
	public function cc_id() 
	{
		$this->form("#foreignkey")->name("cc")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->form("#foreignkey")->name("account")->validate("id");
	}
	public function cost_date() 
	{
		$this->form()->name("date");
	}

	//------------------------------------------------------------------ description
	public function cost_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ select button
	public function cost_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>