<?php
namespace sql;
class funds 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $fund_title = array('type' => 'varchar@100', 'label' => 'title');
	public $fund_slug = array('type' => 'varchar@100', 'label' => 'slug');
	public $location_id = array('type' => 'smallint@5', 'label' => 'id');
	public $fund_initial_balance = array('type' => 'decimal@14,4', 'label' => 'initial_balance');
	public $fund_desc = array('type' => 'varchar@200', 'label' => 'desc');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("#title")->name("title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['fund_title']->value
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->validate("id");
	}
	public function fund_initial_balance() 
	{
		$this->form()->name("initial_balance")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>