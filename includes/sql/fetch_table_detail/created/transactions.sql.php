<?php
namespace sql;
class transactions 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $transaction_type = array('type' => 'enum@sale,purchase,customer_to_store,store_to_company,anbargardani,install,repair,chqeue_back_fail!sale', 'label' => 'transaction_type');
	public $user_id_employee = array('type' => 'smallint@5', 'label' => 'user_id_employee');
	public $user_id_customer = array('type' => 'smallint@5', 'label' => 'user_id_customer');
	public $transaction_date = array('type' => 'datetime@', 'label' => 'transaction_date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'label' => 'transaction_sum');
	public $transaction_discount = array('type' => 'decimal@13,4', 'label' => 'transaction_discount');
	public $transaction_initial_received = array('type' => 'decimal@13,4', 'label' => 'transaction_initial_received');
	public $transaction_received = array('type' => 'decimal@13,4', 'label' => 'transaction_received');
	public $transaction_remained = array('type' => 'decimal@13,4', 'label' => 'transaction_remained');
	public $transaction_pre = array('type' => 'enum@yes,no', 'label' => 'transaction_pre');
	public $transaction_desc = array('type' => 'varchar@200', 'label' => 'transaction_desc');
	public $transaction_transport = array('type' => 'decimal@13,4', 'label' => 'transaction_transport');
	public $transaction_vat = array('type' => 'enum@yes,yes_nocalc,no', 'label' => 'transaction_vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function transaction_type() 
	{
		$this->form()->name("type")
		->validate();
	}
	public function user_id_employee() 
	{
		$this->form()->name("id_employee")
		->validate();
	}
	public function user_id_customer() 
	{
		$this->form()->name("id_customer")
		->validate();
	}
	public function transaction_date() 
	{
		$this->form()->name("date")
		->validate();
	}
	public function transaction_sum() 
	{
		$this->form()->name("sum")
		->validate();
	}
	public function transaction_discount() 
	{
		$this->form()->name("discount")
		->validate();
	}
	public function transaction_initial_received() 
	{
		$this->form()->name("initial_received")
		->validate();
	}
	public function transaction_received() 
	{
		$this->form()->name("received")
		->validate();
	}
	public function transaction_remained() 
	{
		$this->form()->name("remained")
		->validate();
	}
	public function transaction_pre() 
	{
		$this->form()->name("pre")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function transaction_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function transaction_transport() 
	{
		$this->form()->name("transport")
		->validate();
	}
	public function transaction_vat() 
	{
		$this->form()->name("vat")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>