<?php
namespace sql;
class notifications 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $user_id_sender = array('type' => 'smallint@5', 'label' => 'user_id_sender');
	public $user_id_reciever = array('type' => 'smallint@5', 'label' => 'user_id_reciever');
	public $notification_title = array('type' => 'varchar@50', 'label' => 'notification_title');
	public $notification_content = array('type' => 'varchar@200', 'label' => 'notification_content');
	public $notification_url = array('type' => 'varchar@100', 'label' => 'notification_url');
	public $notification_status = array('type' => 'enum@read,unread!unread', 'label' => 'notification_status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_id_sender() 
	{
		
	}
	public function user_id_reciever() 
	{
		
	}

	//------------------------------------------------------------------ title
	public function notification_title() 
	{
		$this->form("title")->name("notification_title");
	}
	public function notification_content() 
	{
		
	}
	public function notification_url() 
	{
		
	}
	public function notification_status() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>