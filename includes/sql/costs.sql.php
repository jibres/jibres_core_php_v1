<?php
namespace sql;
class costs 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $cost_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $cost_price = array('type' => 'decimal@13,4', 'null' =>'NO' ,'label' => 'Price');
	public $costcat_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Costcat', 'foreign' => 'costcats@id!costcat_title');
	public $account_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Account', 'foreign' => 'accounts@id!account_title');
	public $cost_date = array('type' => 'datetime@', 'null' =>'NO' ,'label' => 'Date');
	public $cost_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $cost_type = array('type' => 'enum@income,outcome!outcome', 'null' =>'NO' ,'label' => 'Type');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cost_title() 
	{
		$this->form("text")->name("title")->required()->maxlength(50);
	}
	public function cost_price() 
	{
		$this->form("text")->name("price")->required()->max(999999999999);
	}

	//------------------------------------------------------------------ id - foreign key
	public function costcat_id() 
	{
		$this->form("select")->name("costcat")->required()->min(0)->max(9999)->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function account_id() 
	{
		$this->form("select")->name("account")->required()->min(0)->max(9999)->validate("id");
		$this->setChild($this->form);
	}
	public function cost_date() 
	{
		$this->form("text")->name("date")->required();
	}

	//------------------------------------------------------------------ description
	public function cost_desc() 
	{
		$this->form("#desc")->maxlength(200);
	}

	//------------------------------------------------------------------ select button
	public function cost_type() 
	{
		$this->form("select")->name("type")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>