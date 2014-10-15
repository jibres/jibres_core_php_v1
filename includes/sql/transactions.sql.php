<?php
namespace sql;
class transactions 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $transaction_type = array('type' => 'enum@sale,purchase,customer_to_store,store_to_company,anbargardani,install,repair,chqeue_back_fail!sale', 'label' => 'Type');
	public $user_id_employee = array('type' => 'smallint@5', 'label' => 'Id Employee');
	public $user_id_customer = array('type' => 'smallint@5', 'label' => 'Id Customer');
	public $transaction_date = array('type' => 'datetime@', 'label' => 'Date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'label' => 'Sum');
	public $transaction_discount = array('type' => 'decimal@13,4', 'label' => 'Discount');
	public $transaction_initial_received = array('type' => 'decimal@13,4', 'label' => 'Initial Received');
	public $transaction_received = array('type' => 'decimal@13,4', 'label' => 'Received');
	public $transaction_remained = array('type' => 'decimal@13,4', 'label' => 'Remained');
	public $transaction_pre = array('type' => 'enum@yes,no', 'label' => 'Pre');
	public $transaction_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $transaction_transport = array('type' => 'decimal@13,4', 'label' => 'Transport');
	public $transaction_vat = array('type' => 'enum@yes,yes_nocalc,no', 'label' => 'Vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function transaction_type() 
	{
		$this->form()->name("Type")
		->validate();
	}
	public function user_id_employee() 
	{
		$this->form()->name("Id Employee")
		->validate();
	}
	public function user_id_customer() 
	{
		$this->form()->name("Id Customer")
		->validate();
	}
	public function transaction_date() 
	{
		$this->form()->name("Date")
		->validate();
	}
	public function transaction_sum() 
	{
		$this->form()->name("Sum")
		->validate();
	}
	public function transaction_discount() 
	{
		$this->form()->name("Discount")
		->validate();
	}
	public function transaction_initial_received() 
	{
		$this->form()->name("Initial Received")
		->validate();
	}
	public function transaction_received() 
	{
		$this->form()->name("Received")
		->validate();
	}
	public function transaction_remained() 
	{
		$this->form()->name("Remained")
		->validate();
	}
	public function transaction_pre() 
	{
		$this->form()->name("Pre")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function transaction_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function transaction_transport() 
	{
		$this->form()->name("Transport")
		->validate();
	}
	public function transaction_vat() 
	{
		$this->form()->name("Vat")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>