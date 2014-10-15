<?php
namespace sql;
class term_usages 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $term_id = array('type' => 'smallint@5', 'label' => 'id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>