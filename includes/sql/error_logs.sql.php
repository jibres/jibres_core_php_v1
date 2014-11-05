<?php
namespace sql;
class error_logs 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $user_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'User');
	public $ed_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Ed');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function ed_id() 
	{
		$this->form("#foreignkey")->name("ed")->validate("id");
	}
	public function date_modified() {}
}
?>