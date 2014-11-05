<?php
namespace sql;
class user_logs 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $ul_title = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Title');
	public $ul_desc = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Description');
	public $ul_priority = array('type' => 'enum@high,medium,low!medium', 'null' =>'NO' ,'label' => 'Priority');
	public $ul_type = array('type' => 'enum@forget_password', 'null' =>'YES' ,'label' => 'Type');
	public $user_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'User');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function ul_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ description
	public function ul_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ select button
	public function ul_priority() 
	{
		$this->form("select")->name("priority")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function ul_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}
	public function date_modified() {}
}
?>