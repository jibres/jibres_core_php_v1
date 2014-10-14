<?php
namespace sql;
class funds 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $fund_title = array('type' => 'varchar@100', 'label' => 'fund_title');
	public $fund_slug = array('type' => 'varchar@100', 'label' => 'fund_slug');
	public $location_id = array('type' => 'smallint@5', 'label' => 'location_id');
	public $fund_initial_balance = array('type' => 'decimal@14,4', 'label' => 'fund_initial_balance');
	public $fund_desc = array('type' => 'varchar@200', 'label' => 'fund_desc');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("#title")->name("fund_title");
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("#slug")->name("fund_slug");
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->validate("id");
	}
	public function fund_initial_balance() 
	{
		
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc")->name("fund_desc");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>