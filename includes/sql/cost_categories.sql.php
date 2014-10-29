<?php
namespace sql;
class cost_categories 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $cc_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $cc_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $cc_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $cc_father = array('type' => 'smallint@5', 'label' => 'Father');
	public $cc_row = array('type' => 'smallint@5', 'label' => 'Row');
	public $cc_type = array('type' => 'enum@income,outcome', 'label' => 'Type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cc_title() 
	{
		$this->form("#title");
	}

	//------------------------------------------------------------------ slug
	public function cc_slug() 
	{
		$this->form("#slug");
	}

	//------------------------------------------------------------------ description
	public function cc_desc() 
	{
		$this->form("#desc");
	}
	public function cc_father() 
	{
		$this->form()->name("Father");
	}
	public function cc_row() 
	{
		$this->form()->name("Row");
	}

	//------------------------------------------------------------------ select button
	public function cc_type() 
	{
		$this->form("select")->name("Type")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>