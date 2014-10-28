<?php
namespace sql;
class users 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $user_type = array('type' => 'enum@customer,supplier,employee!customer', 'label' => 'Type');
	public $user_pass = array('type' => 'char@32', 'label' => 'Password');
	public $user_email = array('type' => 'varchar@50', 'label' => 'Email');
	public $user_gender = array('type' => 'enum@male,female', 'label' => 'Gender');
	public $user_married = array('type' => 'enum@single,married', 'label' => 'Married');
	public $user_firstname = array('type' => 'varchar@50', 'label' => 'Firstname');
	public $user_lastname = array('type' => 'varchar@50', 'label' => 'Lastname');
	public $user_nickname = array('type' => 'varchar@50', 'label' => 'Nickname');
	public $user_tel = array('type' => 'varchar@15', 'label' => 'Tel');
	public $user_mobile = array('type' => 'varchar@15', 'label' => 'Mobile');
	public $user_birthday = array('type' => 'datetime@', 'label' => 'Birthday');
	public $user_country = array('type' => 'smallint@5', 'label' => 'Country');
	public $user_state = array('type' => 'smallint@5', 'label' => 'State');
	public $user_city = array('type' => 'smallint@5', 'label' => 'City');
	public $user_address = array('type' => 'varchar@200', 'label' => 'Address');
	public $user_postcode = array('type' => 'varchar@10', 'label' => 'Postcode');
	public $user_newsletter = array('type' => 'enum@yes,no!no', 'label' => 'Newsletter');
	public $user_refer = array('type' => 'varchar@50', 'label' => 'Refer');
	public $user_nationalcode = array('type' => 'varchar@15', 'label' => 'Nationalcode');
	public $user_website = array('type' => 'varchar@100', 'label' => 'Website');
	public $user_status = array('type' => 'enum@active,awaiting,deactive,removed!awaiting', 'label' => 'Status');
	public $user_degree = array('type' => 'varchar@50', 'label' => 'Degree');
	public $user_activity = array('type' => 'varchar@50', 'label' => 'Activity');
	public $user_total_income = array('type' => 'bigint@11', 'label' => 'Total Income');
	public $user_total_outcome = array('type' => 'bigint@11', 'label' => 'Total Outcome');
	public $user_credit = array('type' => 'enum@yes,no!no', 'label' => 'Credit');
	public $user_question = array('type' => 'varchar@100', 'label' => 'Question');
	public $user_answer = array('type' => 'varchar@100', 'label' => 'Answer');
	public $permission_name = array('type' => 'varchar@50', 'label' => 'Name');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ select button
	public function user_type() 
	{
		$this->form("select")->name("Type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ password
	public function user_pass() 
	{
		$this->form("#password")->name("password")->validate();
	}

	//------------------------------------------------------------------ email
	public function user_email() 
	{
		$this->form("#email")->name("Email")->validate();
	}

	//------------------------------------------------------------------ radio button
	public function user_gender() 
	{
		$this->form("radio")->name("Gender")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function user_married() 
	{
		$this->form("radio")->name("Married")->validate();
		$this->setChild($this->form);
	}
	public function user_firstname() 
	{
		$this->form()->name("Firstname")
		->validate();
	}
	public function user_lastname() 
	{
		$this->form()->name("Lastname")
		->validate();
	}
	public function user_nickname() 
	{
		$this->form()->name("Nickname")
		->validate();
	}
	public function user_tel() 
	{
		$this->form()->name("Tel")
		->validate();
	}
	public function user_mobile() 
	{
		$this->form()->name("Mobile")
		->validate();
	}
	public function user_birthday() 
	{
		$this->form()->name("Birthday")
		->validate();
	}
	public function user_country() 
	{
		$this->form()->name("Country")
		->validate();
	}
	public function user_state() 
	{
		$this->form()->name("State")
		->validate();
	}
	public function user_city() 
	{
		$this->form()->name("City")
		->validate();
	}
	public function user_address() 
	{
		$this->form()->name("Address")
		->validate();
	}
	public function user_postcode() 
	{
		$this->form()->name("Postcode")
		->validate();
	}

	//------------------------------------------------------------------ radio button
	public function user_newsletter() 
	{
		$this->form("radio")->name("Newsletter")->validate();
		$this->setChild($this->form);
	}
	public function user_refer() 
	{
		$this->form()->name("Refer")
		->validate();
	}
	public function user_nationalcode() 
	{
		$this->form()->name("Nationalcode")
		->validate();
	}
	public function user_website() 
	{
		$this->form()->name("Website")
		->validate();
	}

	//------------------------------------------------------------------ select button
	public function user_status() 
	{
		$this->form("select")->name("Status")->validate();
		$this->setChild($this->form);
	}
	public function user_degree() 
	{
		$this->form()->name("Degree")
		->validate();
	}
	public function user_activity() 
	{
		$this->form()->name("Activity")
		->validate();
	}
	public function user_total_income() 
	{
		$this->form()->name("Total Income")
		->validate();
	}
	public function user_total_outcome() 
	{
		$this->form()->name("Total Outcome")
		->validate();
	}

	//------------------------------------------------------------------ radio button
	public function user_credit() 
	{
		$this->form("radio")->name("Credit")->validate();
		$this->setChild($this->form);
	}
	public function user_question() 
	{
		$this->form()->name("Question")
		->validate();
	}
	public function user_answer() 
	{
		$this->form()->name("Answer")
		->validate();
	}
	public function permission_name() 
	{
		$this->form()->name("Name")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>