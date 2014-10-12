<?php
namespace sql;
class user_meta {
	public $id = array('type' => 'smallint@6', 'label' => 'user_meta_id');
	public $user_id = array('type' => 'smallint@6', 'label' => 'user_meta_user_id');
	public $usermeta_cat = array('type' => 'varchar@50', 'label' => 'user_meta_usermeta_cat');
	public $usermeta_name = array('type' => 'varchar@100', 'label' => 'user_meta_usermeta_name');
	public $usermeta_value = array('type' => 'varchar@999', 'label' => 'user_meta_usermeta_value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'user_meta_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'user_meta_date_modified');

	public function id(){}
	public function user_id(){}
	public function usermeta_cat(){}
	public function usermeta_name(){}
	public function usermeta_value(){}
	public function date_created(){}
	public function date_modified(){}
}
?>