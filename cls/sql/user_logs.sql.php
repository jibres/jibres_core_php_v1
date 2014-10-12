<?php
namespace sql;
class user_logs {
	public $id = array('type' => 'int@10', 'label' => 'user_logs_id');
	public $ul_title = array('type' => 'varchar@50', 'label' => 'user_logs_ul_title');
	public $ul_desc = array('type' => 'varchar@999', 'label' => 'user_logs_ul_desc');
	public $ul_priority = array('type' => 'enum@high,medium,low!medium', 'label' => 'user_logs_ul_priority');
	public $ul_type = array('type' => 'enum@forget_password', 'label' => 'user_logs_ul_type');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_logs_user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'user_logs_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'user_logs_date_modified');

	public function id(){}
	public function ul_title(){}
	public function ul_desc(){}
	public function ul_priority(){}
	public function ul_type(){}
	public function user_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>