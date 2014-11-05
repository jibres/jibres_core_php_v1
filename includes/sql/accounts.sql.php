<?php
namespace sql;
class accounts 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $account_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $account_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $bank_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Bank');
	public $account_branch_name = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Branch Name');
	public $account_number = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Number');
	public $account_card_number = array('type' => 'varchar@30', 'null' =>'YES' ,'label' => 'Card Number');
	public $account_primarybalance = array('type' => 'decimal@14,4!0.0000', 'null' =>'NO' ,'label' => 'Primarybalance');
	public $account_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function account_title() 
	{
		$this->form("#title");
	}

	//------------------------------------------------------------------ slug
	public function account_slug() 
	{
		$this->form("#slug");
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("#foreignkey")->name("bank")->validate("id");
	}
	public function account_branch_name() 
	{
		$this->form()->name("branch_name");
	}
	public function account_number() 
	{
		$this->form()->name("number");
	}
	public function account_card_number() 
	{
		$this->form()->name("card_number");
	}
	public function account_primarybalance() 
	{
		$this->form()->name("primarybalance");
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
	public function date_created() {}
	public function date_modified() {}
}
?>