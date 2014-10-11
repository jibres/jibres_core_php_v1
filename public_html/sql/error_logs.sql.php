<?php
namespace sql;
class error_logs {
	public $id = array('type' => 'int@10', 'label' => 'error_logs_id');
	public $user_id = array('type' => 'smallint@5', 'label' => 'error_logs_user_id');
	public $ed_id = array('type' => 'smallint@5', 'label' => 'error_logs_ed_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'error_logs_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'error_logs_date_modified');

	public function id(){}
	public function user_id(){}
	public function ed_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>