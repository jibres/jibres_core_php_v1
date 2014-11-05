<?php
namespace sql;
class verifications 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $verification_type = array('type' => 'enum@register_by_email,register_by_mobile,forget,change_email,change_mobile', 'null' =>'NO' ,'label' => 'Type');
	public $verification_email = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Email');
	public $verification_code = array('type' => 'varchar@32', 'null' =>'NO' ,'label' => 'Code');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Verified');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ select button
	public function verification_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ email
	public function verification_email() 
	{
		$this->form("#email");
	}
	public function verification_code() 
	{
		$this->form()->name("code");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}

	//------------------------------------------------------------------ radio button
	public function verification_verified() 
	{
		$this->form("radio")->name("verified");
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>