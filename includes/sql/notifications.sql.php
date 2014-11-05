<?php
namespace sql;
class notifications 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $user_id_sender = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Id Sender');
	public $user_id_reciever = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Id Reciever');
	public $notification_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $notification_content = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Content');
	public $notification_url = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Url');
	public $notification_status = array('type' => 'enum@read,unread!unread', 'null' =>'NO' ,'label' => 'Status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_id_sender() 
	{
		$this->form()->name("id_sender");
	}
	public function user_id_reciever() 
	{
		$this->form()->name("id_reciever");
	}

	//------------------------------------------------------------------ title
	public function notification_title() 
	{
		$this->form("#title");
	}
	public function notification_content() 
	{
		$this->form()->name("content");
	}
	public function notification_url() 
	{
		$this->form()->name("url");
	}

	//------------------------------------------------------------------ select button
	public function notification_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>