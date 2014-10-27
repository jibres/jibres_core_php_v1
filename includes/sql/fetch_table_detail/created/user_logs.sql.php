<?php
namespace sql;
class user_logs 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $ul_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $ul_desc = array('type' => 'varchar@999', 'label' => 'Description');
	public $ul_priority = array('type' => 'enum@high,medium,low!medium', 'label' => 'Priority');
	public $ul_type = array('type' => 'enum@forget_password', 'label' => 'Type');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function ul_title() 
	{
		$this->form("#title")->name("Title")->validate();
	}

	//------------------------------------------------------------------ description
	public function ul_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}

	//------------------------------------------------------------------ select button
	public function ul_priority() 
	{
		$this->form("select")->name("Priority")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function ul_type() 
	{
		$this->form("radio")->name("Type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>