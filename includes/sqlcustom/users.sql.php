<?php
namespace sql;
class users 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $user_type = array('type' => 'enum@customer,supplier,employee!customer', 'label' => 'user_type');
	public $user_pass = array('type' => 'char@32', 'label' => 'user_pass');
	public $user_email = array('type' => 'varchar@50', 'label' => 'user_email');
	public $user_gender = array('type' => 'enum@male,female', 'label' => 'user_gender');



	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_type() 
	{
		
	}
	public function user_email() 
	{
		$this->form("#email")->validate();

	}
	public function user_pass() 
	{
		$this->form("#password");
		// $this->validate()->xsslug(function(){
		// 	$this->value = \validator_lib::$save['form']['user_email']->value;
		// });
	}
	public function user_gender() 
	{

	}
}
?>