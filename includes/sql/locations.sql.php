<?php
namespace sql;
class locations 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $location_title = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $location_slug = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $location_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null'=>'NO', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function location_title() 
	{
		$this->form("text")->name("title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function location_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("location_title");
	}

	//------------------------------------------------------------------ description
	public function location_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function date_modified() {}
}
?>