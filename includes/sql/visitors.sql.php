<?php
namespace sql;
class visitors 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $visitor_ip = array('type' => 'int@10', 'null'=>'NO', 'show'=>'YES', 'label'=>'Ip');
	public $visitor_agent = array('type' => 'varchar@255', 'null'=>'YES', 'show'=>'YES', 'label'=>'Agent');
	public $visitor_referrer = array('type' => 'varchar@255', 'null'=>'YES', 'show'=>'YES', 'label'=>'Referrer');
	public $user_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null'=>'NO', 'show'=>'YES', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function visitor_ip() 
	{
		$this->form("text")->name("ip")->min(0)->max(999999999)->required()->type('number');
	}
	public function visitor_agent() 
	{
		$this->form("text")->name("agent")->maxlength(255)->type('textarea');
	}
	public function visitor_referrer() 
	{
		$this->form("text")->name("referrer")->maxlength(255)->type('textarea');
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>