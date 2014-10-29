<?php
namespace sql;
class accounts 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $account_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $account_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'Bank Id');
	public $account_branch_name = array('type' => 'varchar@50', 'label' => 'Branch Name');
	public $account_number = array('type' => 'varchar@50', 'label' => 'Number');
	public $account_card_number = array('type' => 'varchar@30', 'label' => 'Card Number');
	public $account_primarybalance = array('type' => 'decimal@14,4!0.0000', 'label' => 'Primarybalance');
	public $account_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


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
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}
	public function account_branch_name() 
	{
		$this->form()->name("Branch Name");
	}
	public function account_number() 
	{
		$this->form()->name("Number");
	}
	public function account_card_number() 
	{
		$this->form()->name("Card Number");
	}
	public function account_primarybalance() 
	{
		$this->form()->name("Primarybalance");
	}

	//------------------------------------------------------------------ description
	public function account_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>