<?php
namespace sql;
class notifications 
{
	public $id = array('type' => 'int@10', 'label' => 'd');
	public $user_id_sender = array('type' => 'smallint@5', 'label' => 'id_sender');
	public $user_id_reciever = array('type' => 'smallint@5', 'label' => 'id_reciever');
	public $notification_title = array('type' => 'varchar@50', 'label' => 'title');
	public $notification_content = array('type' => 'varchar@200', 'label' => 'content');
	public $notification_url = array('type' => 'varchar@100', 'label' => 'url');
	public $notification_status = array('type' => 'enum@read,unread!unread', 'label' => 'status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_id_sender() 
	{
		$this->form()->name("id_sender")
		->validate();
	}
	public function user_id_reciever() 
	{
		$this->form()->name("id_reciever")
		->validate();
	}

	//------------------------------------------------------------------ title
	public function notification_title() 
	{
		$this->form("#title")->name("title")->validate();
	}
	public function notification_content() 
	{
		$this->form()->name("content")
		->validate();
	}
	public function notification_url() 
	{
		$this->form()->name("url")
		->validate();
	}
	public function notification_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>