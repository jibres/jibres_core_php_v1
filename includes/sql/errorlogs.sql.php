<?php
namespace sql;
class errorlogs 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $user_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'User', 'foreign' => 'users@id!user_title');
	public $errorlog_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Errorlog', 'foreign' => 'errorlogs@id!errorlog_title');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function errorlog_id() 
	{
		$this->form("#foreignkey")->name("errorlog")->validate("id");
	}
	public function date_modified() {}
}
?>