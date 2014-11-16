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
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function costcat_slug() 
	{
		$this->form("text")->name("slug")->maxlength(50)->required()->type('text')->validate()->slugify("costcat_title");
	}

	//------------------------------------------------------------------ description
	public function costcat_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function costcat_father() 
	{
		$this->form("text")->name("father")->max(9999)->type('number');
	}
	public function costcat_row() 
	{
		$this->form("text")->name("row")->max(9999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function costcat_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>