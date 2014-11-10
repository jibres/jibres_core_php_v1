<?php
namespace sql;
class userlogs 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $userlog_title = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Title');
	public $userlog_desc = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Description');
	public $userlog_priority = array('type' => 'enum@high,medium,low!medium', 'null' =>'NO' ,'label' => 'Priority');
	public $userlog_type = array('type' => 'enum@forget_password', 'null' =>'YES' ,'label' => 'Type');
	public $user_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function userlog_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ description
	public function userlog_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ select button
	public function userlog_priority() 
	{
		$this->form("select")->name("priority")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function userlog_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->validate("id");
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>