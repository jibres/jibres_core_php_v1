<?php
namespace sql;
class user_meta 
{
	public $id = array('type' => 'smallint@6', 'label' => 'd');
	public $user_id = array('type' => 'smallint@6', 'label' => 'id');
	public $usermeta_cat = array('type' => 'varchar@50', 'label' => 'cat');
	public $usermeta_name = array('type' => 'varchar@100', 'label' => 'name');
	public $usermeta_value = array('type' => 'varchar@999', 'label' => 'value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function usermeta_cat() 
	{
		$this->form()->name("cat")
		->validate();
	}
	public function usermeta_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function usermeta_value() 
	{
		$this->form()->name("value")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>