<?php
namespace sql;
class funds 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $fund_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $fund_slug = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Slug');
	public $location_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Location');
	public $fund_initial_balance = array('type' => 'decimal@14,4', 'null' =>'YES' ,'label' => 'Initial Balance');
	public $fund_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("fund_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->form("#foreignkey")->name("location")->validate("id");
	}
	public function fund_initial_balance() 
	{
		$this->form("text")->name("initial_balance");
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc");
	}
	public function date_modified() {}
}
?>