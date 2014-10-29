<?php
namespace sql;
class funds 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $fund_title = array('type' => 'varchar@100', 'label' => 'Title');
	public $fund_slug = array('type' => 'varchar@100', 'label' => 'Slug');
	public $location_id = array('type' => 'smallint@5', 'label' => 'Location');
	public $fund_initial_balance = array('type' => 'decimal@14,4', 'label' => 'Initial Balance');
	public $fund_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("#title");
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("#slug");
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->form("#foreignkey")->name("location")->validate("id");
	}
	public function fund_initial_balance() 
	{
		$this->form()->name("initial_balance");
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>