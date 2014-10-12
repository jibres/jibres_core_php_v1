<?php
namespace sql;
class user_meta 
{
	public $id = array('type' => 'smallint@6', 'label' => 'id');
	public $user_id = array('type' => 'smallint@6', 'label' => 'user_id');
	public $usermeta_cat = array('type' => 'varchar@50', 'label' => 'usermeta_cat');
	public $usermeta_name = array('type' => 'varchar@100', 'label' => 'usermeta_name');
	public $usermeta_value = array('type' => 'varchar@999', 'label' => 'usermeta_value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function usermeta_cat() 
	{
		
	}
	public function usermeta_name() 
	{
		
	}
	public function usermeta_value() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>