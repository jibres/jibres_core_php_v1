<?php
namespace sql;
class terms 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $term_name = array('type' => 'varchar@50', 'label' => 'Name');
	public $term_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $term_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $term_father = array('type' => 'smallint@5', 'label' => 'Father');
	public $term_type = array('type' => 'enum@cat,tag!cat', 'label' => 'Type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function term_name() 
	{
		$this->form()->name("Name")
		->validate();
	}

	//------------------------------------------------------------------ slug
	public function term_slug() 
	{
		$this->form()->name("Slug")->validate();
	}

	//------------------------------------------------------------------ description
	public function term_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function term_father() 
	{
		$this->form()->name("Father")
		->validate();
	}

	//------------------------------------------------------------------ radio button
	public function term_type() 
	{
		$this->form("radio")->name("Type")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>