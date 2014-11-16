<?php
namespace sql;
class visitors 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $visitor_ip = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'Ip');
	public $visitor_agent = array('type' => 'varchar@255', 'null' =>'YES' ,'label' => 'Agent');
	public $visitor_referrer = array('type' => 'varchar@255', 'null' =>'YES' ,'label' => 'Referrer');
	public $user_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function visitor_ip() 
	{
		$this->form("text")->name("ip");
	}
	public function visitor_agent() 
	{
		$this->form("text")->name("agent");
	}
	public function visitor_referrer() 
	{
		$this->form("text")->name("referrer");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->validate("id");
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>