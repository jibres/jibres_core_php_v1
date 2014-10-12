<?php
namespace sql;
class term_usages 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $term_id = array('type' => 'smallint@5', 'label' => 'term_id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'post_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


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
	public function date_created() {};
	public function date_modified() {};
}
?>