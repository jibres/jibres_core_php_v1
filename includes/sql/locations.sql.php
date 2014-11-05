<?php
namespace sql;
class locations 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $location_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $location_slug = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Slug');
	public $location_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function location_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function location_slug() 
	{
		$this->form("text")->name("slug")->validate()
		->createslug(function()	{$this->value =\validator_lib::$save['form']['location_title']->value;});
	}

	//------------------------------------------------------------------ description
	public function location_desc() 
	{
		$this->form("#desc");
	}
	public function date_modified() {}
}
?>