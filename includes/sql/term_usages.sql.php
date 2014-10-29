<?php
namespace sql;
class term_usages 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $term_id = array('type' => 'smallint@5', 'label' => 'Term Id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'Post Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>