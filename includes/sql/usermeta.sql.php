<?php
namespace sql;
class usermeta 
{
	public $id = array('type' => 'smallint@6', 'null' =>'NO' ,'label' => 'ID');
	public $user_id = array('type' => 'smallint@6', 'null' =>'YES' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $usermeta_cat = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Cat');
	public $usermeta_name = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Name');
	public $usermeta_value = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Value');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("userid")->validate("id");
		$this->setChild($this->form);
	}
	public function usermeta_cat() 
	{
		$this->form("text")->name("cat");
	}
	public function usermeta_name() 
	{
		$this->form("text")->name("name");
	}
	public function usermeta_value() 
	{
		$this->form("text")->name("value");
	}
	public function date_modified() {}
}
?>