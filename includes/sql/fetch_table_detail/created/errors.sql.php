<?php
namespace sql;
class errors 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $ed_title = array('type' => 'varchar@100', 'label' => 'ed_title');
	public $ed_solution = array('type' => 'varchar@999', 'label' => 'ed_solution');
	public $ed_priority = array('type' => 'enum@critical,high,medium,low!medium', 'label' => 'ed_priority');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function ed_title() 
	{
		$this->form("#title")->name("ed_title");
	}
	public function ed_solution() 
	{
		
	}
	public function ed_priority() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>