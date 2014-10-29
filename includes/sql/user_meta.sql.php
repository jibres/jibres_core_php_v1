<?php
namespace sql;
class user_meta 
{
	public $id = array('type' => 'smallint@6', 'label' => 'ID');
	public $user_id = array('type' => 'smallint@6', 'label' => 'User Id');
	public $usermeta_cat = array('type' => 'varchar@50', 'label' => 'Cat');
	public $usermeta_name = array('type' => 'varchar@100', 'label' => 'Name');
	public $usermeta_value = array('type' => 'varchar@999', 'label' => 'Value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}
	public function usermeta_cat() 
	{
		$this->form()->name("Cat");
	}
	public function usermeta_name() 
	{
		$this->form()->name("Name");
	}
	public function usermeta_value() 
	{
		$this->form()->name("Value");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>