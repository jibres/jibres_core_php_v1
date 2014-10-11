<?php
namespace sql;
class notifications {
	public $id = array('type' => 'int@10', 'label' => 'notifications_id');
	public $user_id_sender = array('type' => 'smallint@5', 'label' => 'notifications_user_id_sender');
	public $user_id_reciever = array('type' => 'smallint@5', 'label' => 'notifications_user_id_reciever');
	public $notification_title = array('type' => 'varchar@50', 'label' => 'notifications_notification_title');
	public $notification_content = array('type' => 'varchar@200', 'label' => 'notifications_notification_content');
	public $notification_url = array('type' => 'varchar@100', 'label' => 'notifications_notification_url');
	public $notification_status = array('type' => 'enum@read,unread!unread', 'label' => 'notifications_notification_status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'notifications_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'notifications_date_modified');

	public function id(){}
	public function user_id_sender(){}
	public function user_id_reciever(){}
	public function notification_title(){}
	public function notification_content(){}
	public function notification_url(){}
	public function notification_status(){}
	public function date_created(){}
	public function date_modified(){}
}
?>