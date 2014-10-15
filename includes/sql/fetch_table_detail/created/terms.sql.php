<?php
namespace sql;
class terms 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $term_name = array('type' => 'varchar@50', 'label' => 'term_name');
	public $term_slug = array('type' => 'varchar@50', 'label' => 'term_slug');
	public $term_desc = array('type' => 'varchar@200', 'label' => 'term_desc');
	public $term_father = array('type' => 'smallint@5', 'label' => 'term_father');
	public $term_type = array('type' => 'enum@cat,tag!cat', 'label' => 'term_type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function term_name() 
	{
		$this->form()->name("name")
		->validate();
	}

	//------------------------------------------------------------------ slug
	public function term_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['term_title']->value
	}

	//------------------------------------------------------------------ description
	public function term_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function term_father() 
	{
		$this->form()->name("father")
		->validate();
	}
	public function term_type() 
	{
		$this->form()->name("type")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>