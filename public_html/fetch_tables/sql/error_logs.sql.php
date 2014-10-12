<?php
namespace sql;
class error_logs 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $ed_id = array('type' => 'smallint@5', 'label' => 'ed_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function ed_id() 
	{
		$this->validate("id");
	}
	public function date_created() {};
	public function date_modified() {};
}
?>