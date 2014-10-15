<?php
namespace sql;
class verifications 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $verification_type = array('type' => 'enum@register_by_email,register_by_mobile,forget,change_email,change_mobile', 'label' => 'type');
	public $verification_email = array('type' => 'varchar@50', 'label' => 'email');
	public $verification_code = array('type' => 'varchar@32', 'label' => 'code');
	public $user_id = array('type' => 'smallint@5', 'label' => 'id');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'label' => 'verified');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function verification_type() 
	{
		$this->form()->name("type")
		->validate();
	}

	//------------------------------------------------------------------ email
	public function verification_email() 
	{
		$this->form("#email")->name("email")->validate();
	}
	public function verification_code() 
	{
		$this->form()->name("code")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function verification_verified() 
	{
		$this->form()->name("verified")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>