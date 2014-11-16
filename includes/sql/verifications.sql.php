<?php
namespace sql;
class verifications 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $verification_type = array('type' => 'enum@registerbyemail,registerbymobile,forget,changeemail,changemobile', 'null' =>'NO' ,'label' => 'Type');
	public $verification_email = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Email');
	public $verification_code = array('type' => 'varchar@32', 'null' =>'NO' ,'label' => 'Code');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Verified');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ select button
	public function verification_type() 
	{
		$this->form("select")->name("type")->required()->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ email
	public function verification_email() 
	{
		$this->form("#email")->required();
	}
	public function verification_code() 
	{
		$this->form("text")->name("code")->required();
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->required()->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function verification_verified() 
	{
		$this->form("radio")->name("verified")->required();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>