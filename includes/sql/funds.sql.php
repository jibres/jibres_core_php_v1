<?php
namespace sql;
class funds 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $fund_title = array('type' => 'varchar@100', 'label' => 'Title');
	public $fund_slug = array('type' => 'varchar@100', 'label' => 'Slug');
	public $location_id = array('type' => 'smallint@5', 'label' => 'Location Id');
	public $fund_initial_balance = array('type' => 'decimal@14,4', 'label' => 'Initial Balance');
	public $fund_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("#title")->name("Title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form()->name("Slug")->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->validate("id");
	}
	public function fund_initial_balance() 
	{
		$this->form()->name("Initial Balance")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>