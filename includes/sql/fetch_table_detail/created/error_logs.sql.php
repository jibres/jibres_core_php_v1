<?php
namespace sql;
class error_logs 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $ed_id = array('type' => 'smallint@5', 'label' => 'Ed Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


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
	public function date_created() {}
	public function date_modified() {}
}
?>