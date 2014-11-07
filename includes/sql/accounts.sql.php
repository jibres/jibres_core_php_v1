<?php
namespace sql;
class accounts 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $account_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $account_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $bank_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Bank', 'foreign' => 'banks@id!bank_title');
	public $account_branch = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Branch');
	public $account_number = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Number');
	public $account_card = array('type' => 'varchar@30', 'null' =>'YES' ,'label' => 'Card');
	public $account_primarybalance = array('type' => 'decimal@14,4!0.0000', 'null' =>'NO' ,'label' => 'Primarybalance');
	public $account_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_title');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function account_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function account_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("account_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("#foreignkey")->name("bank")->validate("id");
	}
	public function account_branch() 
	{
		$this->form("text")->name("branch");
	}
	public function account_number() 
	{
		$this->form("text")->name("number");
	}
	public function account_card() 
	{
		$this->form("text")->name("card");
	}
	public function account_primarybalance() 
	{
		$this->form("text")->name("primarybalance");
	}

	//------------------------------------------------------------------ description
	public function account_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}
	public function date_modified() {}
}
?>