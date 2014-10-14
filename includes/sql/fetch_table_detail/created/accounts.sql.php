<?php
namespace sql;
class accounts 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $account_title = array('type' => 'varchar@50', 'label' => 'account_title');
	public $account_slug = array('type' => 'varchar@50', 'label' => 'account_slug');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'bank_id');
	public $account_branch_name = array('type' => 'varchar@50', 'label' => 'account_branch_name');
	public $account_number = array('type' => 'varchar@50', 'label' => 'account_number');
	public $account_card_number = array('type' => 'varchar@30', 'label' => 'account_card_number');
	public $account_primarybalance = array('type' => 'decimal@14,4!0.0000', 'label' => 'account_primarybalance');
	public $account_desc = array('type' => 'varchar@200', 'label' => 'account_desc');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function account_title() 
	{
		$this->form("#title")->name("account_title");
	}

	//------------------------------------------------------------------ slug
	public function account_slug() 
	{
		$this->form("#slug")->name("account_slug");
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->validate("id");
	}
	public function account_branch_name() 
	{
		
	}
	public function account_number() 
	{
		
	}
	public function account_card_number() 
	{
		
	}
	public function account_primarybalance() 
	{
		
	}

	//------------------------------------------------------------------ description
	public function account_desc() 
	{
		$this->form("#desc")->name("account_desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>