<?php
namespace sql;
class notifications 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $user_id_sender = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Id Sender');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $notification_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $notification_content = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Content');
	public $notification_url = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Url');
	public $notification_status = array('type' => 'enum@read,unread!unread', 'null' =>'NO' ,'label' => 'Status');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_id_sender() 
	{
		$this->form("text")->name("id_sender")->min(0)->max(9999);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->required()->min(0)->max(9999)->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ title
	public function notification_title() 
	{
		$this->form("text")->name("title")->required()->maxlength(50);
	}
	public function notification_content() 
	{
		$this->form("text")->name("content")->maxlength(200);
	}
	public function notification_url() 
	{
		$this->form("text")->name("url")->maxlength(100);
	}

	//------------------------------------------------------------------ select button
	public function notification_status() 
	{
		$this->form("select")->name("status")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>