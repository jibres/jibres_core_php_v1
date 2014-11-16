<?php
namespace sql;
class costcats 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $costcat_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $costcat_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $costcat_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $costcat_father = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Father');
	public $costcat_row = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Row');
	public $costcat_type = array('type' => 'enum@income,outcome', 'null' =>'YES' ,'label' => 'Type');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function costcat_title() 
	{
		$this->form("text")->name("title")->required();
	}

	//------------------------------------------------------------------ slug
	public function costcat_slug() 
	{
		$this->form("text")->name("slug")->required()->validate()->slugify("costcat_title");
	}

	//------------------------------------------------------------------ description
	public function costcat_desc() 
	{
		$this->form("#desc");
	}
	public function costcat_father() 
	{
		$this->form("text")->name("father");
	}
	public function costcat_row() 
	{
		$this->form("text")->name("row");
	}

	//------------------------------------------------------------------ select button
	public function costcat_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>