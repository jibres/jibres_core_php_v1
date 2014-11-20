<?php
namespace sql;
class verifications 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $verification_type = array('type' => 'enum@emailregister,emailchange,emailforget,mobileregister,mobilechange,mobileforget', 'null' =>'NO' ,'label' => 'Type');
	public $verification_value = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Value');
	public $verification_code = array('type' => 'varchar@32', 'null' =>'NO' ,'label' => 'Code');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Verified');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ select button
	public function verification_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function verification_value() 
	{
		$this->form("text")->name("value")->maxlength(50)->required()->type('text');
	}
	public function verification_code() 
	{
		$this->form("text")->name("code")->maxlength(32)->required()->type('text');
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function verification_verified() 
	{
		$this->form("radio")->name("verified")->type("radio")->required();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>