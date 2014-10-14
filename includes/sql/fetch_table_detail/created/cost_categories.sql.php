<?php
namespace sql;
class cost_categories 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $cc_title = array('type' => 'varchar@50', 'label' => 'cc_title');
	public $cc_slug = array('type' => 'varchar@50', 'label' => 'cc_slug');
	public $cc_desc = array('type' => 'varchar@200', 'label' => 'cc_desc');
	public $cc_father = array('type' => 'smallint@5', 'label' => 'cc_father');
	public $cc_row = array('type' => 'smallint@5', 'label' => 'cc_row');
	public $cc_type = array('type' => 'enum@income,outcome', 'label' => 'cc_type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function cc_title() 
	{
		$this->form("#title")->name("cc_title");
	}

	//------------------------------------------------------------------ slug
	public function cc_slug() 
	{
		$this->form("#slug")->name("cc_slug");
	}

	//------------------------------------------------------------------ description
	public function cc_desc() 
	{
		$this->form("#desc")->name("cc_desc");
	}
	public function cc_father() 
	{
		
	}
	public function cc_row() 
	{
		
	}
	public function cc_type() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>