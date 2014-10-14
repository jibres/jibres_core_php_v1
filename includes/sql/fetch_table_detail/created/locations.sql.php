<?php
namespace sql;
class locations 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $location_title = array('type' => 'varchar@100', 'label' => 'location_title');
	public $location_slug = array('type' => 'varchar@100', 'label' => 'location_slug');
	public $location_desc = array('type' => 'varchar@200', 'label' => 'location_desc');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function location_title() 
	{
		$this->form("#title")->name("location_title");
	}

	//------------------------------------------------------------------ slug
	public function location_slug() 
	{
		$this->form("#slug")->name("location_slug");
	}

	//------------------------------------------------------------------ description
	public function location_desc() 
	{
		$this->form("#desc")->name("location_desc");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>