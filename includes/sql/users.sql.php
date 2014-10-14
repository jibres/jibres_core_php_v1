<?php
namespace sql;
class users 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $user_type = array('type' => 'enum@customer,supplier,employee!customer', 'label' => 'user_type');
	public $user_pass = array('type' => 'char@32', 'label' => 'user_pass');
	public $user_email = array('type' => 'varchar@50', 'label' => 'user_email');
	public $user_gender = array('type' => 'enum@male,female', 'label' => 'user_gender');
	public $user_married = array('type' => 'enum@single,married', 'label' => 'user_married');
	public $user_firstname = array('type' => 'varchar@50', 'label' => 'user_firstname');
	public $user_lastname = array('type' => 'varchar@50', 'label' => 'user_lastname');
	public $user_nickname = array('type' => 'varchar@50', 'label' => 'user_nickname');
	public $user_tel = array('type' => 'varchar@15', 'label' => 'user_tel');
	public $user_mobile = array('type' => 'varchar@15', 'label' => 'user_mobile');
	public $user_birthday = array('type' => 'datetime@', 'label' => 'user_birthday');
	public $user_country = array('type' => 'smallint@5', 'label' => 'user_country');
	public $user_state = array('type' => 'smallint@5', 'label' => 'user_state');
	public $user_city = array('type' => 'smallint@5', 'label' => 'user_city');
	public $user_address = array('type' => 'varchar@200', 'label' => 'user_address');
	public $user_postcode = array('type' => 'varchar@10', 'label' => 'user_postcode');
	public $user_newsletter = array('type' => 'enum@yes,no!no', 'label' => 'user_newsletter');
	public $user_refer = array('type' => 'varchar@50', 'label' => 'user_refer');
	public $user_nationalcode = array('type' => 'varchar@15', 'label' => 'user_nationalcode');
	public $user_website = array('type' => 'varchar@100', 'label' => 'user_website');
	public $user_status = array('type' => 'enum@active,awaiting,deactive,removed!awaiting', 'label' => 'user_status');
	public $user_degree = array('type' => 'varchar@50', 'label' => 'user_degree');
	public $user_activity = array('type' => 'varchar@50', 'label' => 'user_activity');
	public $user_total_income = array('type' => 'bigint@11', 'label' => 'user_total_income');
	public $user_total_outcome = array('type' => 'bigint@11', 'label' => 'user_total_outcome');
	public $user_credit = array('type' => 'enum@yes,no!no', 'label' => 'user_credit');
	public $user_question = array('type' => 'varchar@100', 'label' => 'user_question');
	public $user_answer = array('type' => 'varchar@100', 'label' => 'user_answer');
	public $permission_name = array('type' => 'varchar@50', 'label' => 'permission_name');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


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
	public function user_married() 
	{
		
	}
	public function user_firstname() 
	{
		
	}
	public function user_lastname() 
	{
		
	}
	public function user_nickname() 
	{
		
	}
	public function user_tel() 
	{
		
	}
	public function user_mobile() 
	{
		
	}
	public function user_birthday() 
	{
		
	}
	public function user_country() 
	{
		
	}
	public function user_state() 
	{
		
	}
	public function user_city() 
	{
		
	}
	public function user_address() 
	{
		
	}
	public function user_postcode() 
	{
		
	}
	public function user_newsletter() 
	{
		
	}
	public function user_refer() 
	{
		
	}
	public function user_nationalcode() 
	{
		
	}
	public function user_website() 
	{
		
	}
	public function user_status() 
	{
		
	}
	public function user_degree() 
	{
		
	}
	public function user_activity() 
	{
		
	}
	public function user_total_income() 
	{
		
	}
	public function user_total_outcome() 
	{
		
	}
	public function user_credit() 
	{
		
	}
	public function user_question() 
	{
		
	}
	public function user_answer() 
	{
		
	}
	public function permission_name() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>