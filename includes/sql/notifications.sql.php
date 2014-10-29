<?php
namespace sql;
class notifications 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $user_id_sender = array('type' => 'smallint@5', 'label' => 'Id Sender');
	public $user_id_reciever = array('type' => 'smallint@5', 'label' => 'Id Reciever');
	public $notification_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $notification_content = array('type' => 'varchar@200', 'label' => 'Content');
	public $notification_url = array('type' => 'varchar@100', 'label' => 'Url');
	public $notification_status = array('type' => 'enum@read,unread!unread', 'label' => 'Status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_id_sender() 
	{
		$this->form()->name("Id Sender");
	}
	public function user_id_reciever() 
	{
		$this->form()->name("Id Reciever");
	}

	//------------------------------------------------------------------ title
	public function notification_title() 
	{
		$this->form("#title");
	}
	public function notification_content() 
	{
		$this->form()->name("Content");
	}
	public function notification_url() 
	{
		$this->form()->name("Url");
	}

	//------------------------------------------------------------------ select button
	public function notification_status() 
	{
		$this->form("select")->name("Status")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>