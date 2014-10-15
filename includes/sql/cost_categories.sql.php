<?php
namespace sql;
class cost_categories 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $cc_title = array('type' => 'varchar@50', 'label' => 'title');
	public $cc_slug = array('type' => 'varchar@50', 'label' => 'slug');
	public $cc_desc = array('type' => 'varchar@200', 'label' => 'desc');
	public $cc_father = array('type' => 'smallint@5', 'label' => 'father');
	public $cc_row = array('type' => 'smallint@5', 'label' => 'row');
	public $cc_type = array('type' => 'enum@income,outcome', 'label' => 'type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cc_title() 
	{
		$this->form("#title")->name("title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function cc_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['cc_title']->value
	}

	//------------------------------------------------------------------ description
	public function cc_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function cc_father() 
	{
		$this->form()->name("father")
		->validate();
	}
	public function cc_row() 
	{
		$this->form()->name("row")
		->validate();
	}
	public function cc_type() 
	{
		$this->form()->name("type")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>