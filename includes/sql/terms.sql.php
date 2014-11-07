<?php
namespace sql;
class terms 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $term_name = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Name');
	public $term_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $term_desc = array('type' => 'varchar@200', 'null' =>'NO' ,'label' => 'Description');
	public $term_father = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Father');
	public $term_type = array('type' => 'enum@cat,tag!cat', 'null' =>'NO' ,'label' => 'Type');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function term_name() 
	{
		$this->form("text")->name("name");
	}

	//------------------------------------------------------------------ slug
	public function term_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("term_title");
	}

	//------------------------------------------------------------------ description
	public function term_desc() 
	{
		$this->form("#desc");
	}
	public function term_father() 
	{
		$this->form("text")->name("father");
	}

	//------------------------------------------------------------------ select button
	public function term_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>