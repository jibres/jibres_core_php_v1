<?php
namespace sql;
class verifications 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $verification_type = array('type' => 'enum@register_by_email,register_by_mobile,forget,change_email,change_mobile', 'label' => 'verification_type');
	public $verification_email = array('type' => 'varchar@50', 'label' => 'verification_email');
	public $verification_code = array('type' => 'varchar@32', 'label' => 'verification_code');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'label' => 'verification_verified');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function verification_type() 
	{
		
	}

	//------------------------------------------------------------------ email
	public function verification_email() 
	{
		$this->form("#email")->name("verification_email");
	}
	public function verification_code() 
	{
		
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function verification_verified() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>