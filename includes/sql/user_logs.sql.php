<?php
namespace sql;
class user_logs 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $ul_title = array('type' => 'varchar@50', 'label' => 'ul_title');
	public $ul_desc = array('type' => 'varchar@999', 'label' => 'ul_desc');
	public $ul_priority = array('type' => 'enum@high,medium,low!medium', 'label' => 'ul_priority');
	public $ul_type = array('type' => 'enum@forget_password', 'label' => 'ul_type');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function ul_title() 
	{
		$this->form("#title")->name("ul_title");
	}

	//------------------------------------------------------------------ description
	public function ul_desc() 
	{
		$this->form("#desc")->name("ul_desc");
	}
	public function ul_priority() 
	{
		
	}
	public function ul_type() 
	{
		
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>