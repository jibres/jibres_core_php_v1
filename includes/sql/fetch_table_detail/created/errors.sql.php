<?php
namespace sql;
class errors 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $ed_title = array('type' => 'varchar@100', 'label' => 'title');
	public $ed_solution = array('type' => 'varchar@999', 'label' => 'solution');
	public $ed_priority = array('type' => 'enum@critical,high,medium,low!medium', 'label' => 'priority');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function ed_title() 
	{
		$this->form("#title")->name("title")->validate();
	}
	public function ed_solution() 
	{
		$this->form()->name("solution")
		->validate();
	}
	public function ed_priority() 
	{
		$this->form()->name("priority")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>