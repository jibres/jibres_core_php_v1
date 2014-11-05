<?php
namespace sql;
class errors 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $ed_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $ed_solution = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Solution');
	public $ed_priority = array('type' => 'enum@critical,high,medium,low!medium', 'null' =>'NO' ,'label' => 'Priority');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function ed_title() 
	{
		$this->form("#title");
	}
	public function ed_solution() 
	{
		$this->form()->name("solution");
	}

	//------------------------------------------------------------------ select button
	public function ed_priority() 
	{
		$this->form("select")->name("priority")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>