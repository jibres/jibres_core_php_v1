<?php
namespace sql;
class transactions 
{
	public $id = array('type' => 'int@10', 'label' => 'd');
	public $transaction_type = array('type' => 'enum@sale,purchase,customer_to_store,store_to_company,anbargardani,install,repair,chqeue_back_fail!sale', 'label' => 'type');
	public $user_id_employee = array('type' => 'smallint@5', 'label' => 'id_employee');
	public $user_id_customer = array('type' => 'smallint@5', 'label' => 'id_customer');
	public $transaction_date = array('type' => 'datetime@', 'label' => 'date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'label' => 'sum');
	public $transaction_discount = array('type' => 'decimal@13,4', 'label' => 'discount');
	public $transaction_initial_received = array('type' => 'decimal@13,4', 'label' => 'initial_received');
	public $transaction_received = array('type' => 'decimal@13,4', 'label' => 'received');
	public $transaction_remained = array('type' => 'decimal@13,4', 'label' => 'remained');
	public $transaction_pre = array('type' => 'enum@yes,no', 'label' => 'pre');
	public $transaction_desc = array('type' => 'varchar@200', 'label' => 'desc');
	public $transaction_transport = array('type' => 'decimal@13,4', 'label' => 'transport');
	public $transaction_vat = array('type' => 'enum@yes,yes_nocalc,no', 'label' => 'vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


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