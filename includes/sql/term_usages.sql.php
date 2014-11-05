<?php
namespace sql;
class term_usages 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $term_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Term');
	public $post_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Post');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->form("#foreignkey")->name("term")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("#foreignkey")->name("post")->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>