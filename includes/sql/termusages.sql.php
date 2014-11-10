<?php
namespace sql;
class termusages 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $term_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Term', 'foreign' => 'terms@id!term_title');
	public $post_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Post', 'foreign' => 'posts@id!post_title');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->form("select")->name("term")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post")->validate("id");
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>