<?php
namespace sql;
class users 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $user_type = array('type' => 'enum@customer,supplier,employee!customer', 'label' => 'type');
	public $user_pass = array('type' => 'char@32', 'label' => 'pass');
	public $user_email = array('type' => 'varchar@50', 'label' => 'email');
	public $user_gender = array('type' => 'enum@male,female', 'label' => 'gender');
	public $user_married = array('type' => 'enum@single,married', 'label' => 'married');
	public $user_firstname = array('type' => 'varchar@50', 'label' => 'firstname');
	public $user_lastname = array('type' => 'varchar@50', 'label' => 'lastname');
	public $user_nickname = array('type' => 'varchar@50', 'label' => 'nickname');
	public $user_tel = array('type' => 'varchar@15', 'label' => 'tel');
	public $user_mobile = array('type' => 'varchar@15', 'label' => 'mobile');
	public $user_birthday = array('type' => 'datetime@', 'label' => 'birthday');
	public $user_country = array('type' => 'smallint@5', 'label' => 'country');
	public $user_state = array('type' => 'smallint@5', 'label' => 'state');
	public $user_city = array('type' => 'smallint@5', 'label' => 'city');
	public $user_address = array('type' => 'varchar@200', 'label' => 'address');
	public $user_postcode = array('type' => 'varchar@10', 'label' => 'postcode');
	public $user_newsletter = array('type' => 'enum@yes,no!no', 'label' => 'newsletter');
	public $user_refer = array('type' => 'varchar@50', 'label' => 'refer');
	public $user_nationalcode = array('type' => 'varchar@15', 'label' => 'nationalcode');
	public $user_website = array('type' => 'varchar@100', 'label' => 'website');
	public $user_status = array('type' => 'enum@active,awaiting,deactive,removed!awaiting', 'label' => 'status');
	public $user_degree = array('type' => 'varchar@50', 'label' => 'degree');
	public $user_activity = array('type' => 'varchar@50', 'label' => 'activity');
	public $user_total_income = array('type' => 'bigint@11', 'label' => 'total_income');
	public $user_total_outcome = array('type' => 'bigint@11', 'label' => 'total_outcome');
	public $user_credit = array('type' => 'enum@yes,no!no', 'label' => 'credit');
	public $user_question = array('type' => 'varchar@100', 'label' => 'question');
	public $user_answer = array('type' => 'varchar@100', 'label' => 'answer');
	public $permission_name = array('type' => 'varchar@50', 'label' => 'name');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function user_type() 
	{
		$this->form()->name("type")
		->validate();
	}

	//------------------------------------------------------------------ password
	public function user_pass() 
	{
		$this->form("#pass")->name("pass")->validate();
	}

	//------------------------------------------------------------------ email
	public function user_email() 
	{
		$this->form("#email")->name("email")->validate();
	}
	public function user_gender() 
	{
		$this->form()->name("gender")
		->validate();
	}
	public function user_married() 
	{
		$this->form()->name("married")
		->validate();
	}
	public function user_firstname() 
	{
		$this->form()->name("firstname")
		->validate();
	}
	public function user_lastname() 
	{
		$this->form()->name("lastname")
		->validate();
	}
	public function user_nickname() 
	{
		$this->form()->name("nickname")
		->validate();
	}
	public function user_tel() 
	{
		$this->form()->name("tel")
		->validate();
	}
	public function user_mobile() 
	{
		$this->form()->name("mobile")
		->validate();
	}
	public function user_birthday() 
	{
		$this->form()->name("birthday")
		->validate();
	}
	public function user_country() 
	{
		$this->form()->name("country")
		->validate();
	}
	public function user_state() 
	{
		$this->form()->name("state")
		->validate();
	}
	public function user_city() 
	{
		$this->form()->name("city")
		->validate();
	}
	public function user_address() 
	{
		$this->form()->name("address")
		->validate();
	}
	public function user_postcode() 
	{
		$this->form()->name("postcode")
		->validate();
	}
	public function user_newsletter() 
	{
		$this->form()->name("newsletter")
		->validate();
	}
	public function user_refer() 
	{
		$this->form()->name("refer")
		->validate();
	}
	public function user_nationalcode() 
	{
		$this->form()->name("nationalcode")
		->validate();
	}
	public function user_website() 
	{
		$this->form()->name("website")
		->validate();
	}
	public function user_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function user_degree() 
	{
		$this->form()->name("degree")
		->validate();
	}
	public function user_activity() 
	{
		$this->form()->name("activity")
		->validate();
	}
	public function user_total_income() 
	{
		$this->form()->name("total_income")
		->validate();
	}
	public function user_total_outcome() 
	{
		$this->form()->name("total_outcome")
		->validate();
	}
	public function user_credit() 
	{
		$this->form()->name("credit")
		->validate();
	}
	public function user_question() 
	{
		$this->form()->name("question")
		->validate();
	}
	public function user_answer() 
	{
		$this->form()->name("answer")
		->validate();
	}
	public function permission_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>