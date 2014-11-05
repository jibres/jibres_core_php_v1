<?php
namespace sql;
class cost_categories 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $cc_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $cc_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $cc_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $cc_father = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Father');
	public $cc_row = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Row');
	public $cc_type = array('type' => 'enum@income,outcome', 'null' =>'YES' ,'label' => 'Type');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cc_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function cc_slug() 
	{
		$this->form("text")->name("slug")->validate()
		->createslug(function()	{$this->value =\validator_lib::$save['form']['cc_title']->value;});
	}

	//------------------------------------------------------------------ description
	public function cc_desc() 
	{
		$this->form("#desc");
	}
	public function cc_father() 
	{
		$this->form("text")->name("father");
	}
	public function cc_row() 
	{
		$this->form("text")->name("row");
	}

	//------------------------------------------------------------------ select button
	public function cc_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>