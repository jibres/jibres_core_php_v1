<?php
namespace sql;
class users 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $user_type = array('type' => 'enum@customer,supplier,employee!customer', 'null' =>'YES' ,'label' => 'Type');
	public $user_pass = array('type' => 'char@32', 'null' =>'NO' ,'label' => 'Password');
	public $user_email = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Email');
	public $user_gender = array('type' => 'enum@male,female', 'null' =>'YES' ,'label' => 'Gender');
	public $user_married = array('type' => 'enum@single,married', 'null' =>'YES' ,'label' => 'Married');
	public $user_firstname = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Firstname');
	public $user_lastname = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Lastname');
	public $user_nickname = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Nickname');
	public $user_tel = array('type' => 'varchar@15', 'null' =>'YES' ,'label' => 'Tel');
	public $user_mobile = array('type' => 'varchar@15', 'null' =>'YES' ,'label' => 'Mobile');
	public $user_birthday = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Birthday');
	public $user_country = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Country');
	public $user_state = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'State');
	public $user_city = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'City');
	public $user_address = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Address');
	public $user_postcode = array('type' => 'varchar@10', 'null' =>'YES' ,'label' => 'Postcode');
	public $user_newsletter = array('type' => 'enum@yes,no!no', 'null' =>'YES' ,'label' => 'Newsletter');
	public $user_refer = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Refer');
	public $user_nationalcode = array('type' => 'varchar@15', 'null' =>'YES' ,'label' => 'Nationalcode');
	public $user_website = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Website');
	public $user_status = array('type' => 'enum@active,awaiting,deactive,removed!awaiting', 'null' =>'YES' ,'label' => 'Status');
	public $user_degree = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Degree');
	public $user_activity = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Activity');
	public $user_incomes = array('type' => 'bigint@11', 'null' =>'YES' ,'label' => 'Incomes');
	public $user_outcomes = array('type' => 'bigint@11', 'null' =>'YES' ,'label' => 'Outcomes');
	public $user_credit = array('type' => 'enum@yes,no!no', 'null' =>'YES' ,'label' => 'Credit');
	public $user_question = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Question');
	public $user_answer = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Answer');
	public $permission_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Permission', 'foreign' => 'permissions@id!permission_title');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ select button
	public function user_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ password
	public function user_pass() 
	{
		$this->form("#password")->required()->maxlength(32);
	}

	//------------------------------------------------------------------ email
	public function user_email() 
	{
		$this->form("#email")->maxlength(50);
	}

	//------------------------------------------------------------------ radio button
	public function user_gender() 
	{
		$this->form("radio")->name("gender");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function user_married() 
	{
		$this->form("radio")->name("married");
		$this->setChild($this->form);
	}
	public function user_firstname() 
	{
		$this->form("text")->name("firstname")->maxlength(50);
	}
	public function user_lastname() 
	{
		$this->form("text")->name("lastname")->maxlength(50);
	}
	public function user_nickname() 
	{
		$this->form("text")->name("nickname")->maxlength(50);
	}
	public function user_tel() 
	{
		// $this->form("text")->name("tel")->maxlength(15);
		$this->form("#password")->type("test");
		var_dump($this->form->compile());
	}
	public function user_mobile() 
	{
		$this->form("text")->name("mobile")->maxlength(15);
	}
	public function user_birthday() 
	{
		$this->form("text")->name("birthday");
	}
	public function user_country() 
	{
		$this->form("text")->name("country")->min(0)->max(9999);
	}
	public function user_state() 
	{
		$this->form("text")->name("state")->min(0)->max(9999);
	}
	public function user_city() 
	{
		$this->form("text")->name("city")->min(0)->max(9999);
	}
	public function user_address() 
	{
		$this->form("text")->name("address")->maxlength(200);
	}
	public function user_postcode() 
	{
		$this->form("text")->name("postcode")->maxlength(10);
	}

	//------------------------------------------------------------------ radio button
	public function user_newsletter() 
	{
		$this->form("radio")->name("newsletter");
		$this->setChild($this->form);
	}
	public function user_refer() 
	{
		$this->form("text")->name("refer")->maxlength(50);
	}
	public function user_nationalcode() 
	{
		$this->form("text")->name("nationalcode")->maxlength(15);
	}

	//------------------------------------------------------------------ website
	public function user_website() 
	{
		$this->form("#website")->maxlength(100);
	}

	//------------------------------------------------------------------ select button
	public function user_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function user_degree() 
	{
		$this->form("text")->name("degree")->maxlength(50);
	}
	public function user_activity() 
	{
		$this->form("text")->name("activity")->maxlength(50);
	}
	public function user_incomes() 
	{
		$this->form("text")->name("incomes")->max(9999999999);
	}
	public function user_outcomes() 
	{
		$this->form("text")->name("outcomes")->max(9999999999);
	}

	//------------------------------------------------------------------ radio button
	public function user_credit() 
	{
		$this->form("radio")->name("credit");
		$this->setChild($this->form);
	}
	public function user_question() 
	{
		$this->form("text")->name("question")->maxlength(100);
	}
	public function user_answer() 
	{
		$this->form("text")->name("answer")->maxlength(100);
	}

	//------------------------------------------------------------------ id - foreign key
	public function permission_id() 
	{
		$this->form("select")->name("permission")->min(0)->max(9999)->validate("id");
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>