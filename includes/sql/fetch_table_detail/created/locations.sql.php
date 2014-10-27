<?php
namespace sql;
class locations 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $location_title = array('type' => 'varchar@100', 'label' => 'Title');
	public $location_slug = array('type' => 'varchar@100', 'label' => 'Slug');
	public $location_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function location_title() 
	{
		$this->form("#title")->name("Title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function location_slug() 
	{
		$this->form()->name("Slug")->validate();
	}

	//------------------------------------------------------------------ description
	public function location_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>