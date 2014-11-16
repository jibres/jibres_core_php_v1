<?php
namespace sql;
class transactions 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $transaction_type = array('type' => 'enum@sale,purchase,customertostore,storetocompany,anbargardani,install,repair,chqeuebackfail!sale', 'null' =>'NO' ,'label' => 'Type');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $user_id_customer = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Id Customer');
	public $transaction_date = array('type' => 'datetime@', 'null' =>'NO' ,'label' => 'Date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'null' =>'NO' ,'label' => 'Sum');
	public $transaction_discount = array('type' => 'decimal@13,4!0.0000', 'null' =>'NO' ,'label' => 'Discount');
	public $transaction_initialreceived = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Initialreceived');
	public $transaction_received = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Received');
	public $transaction_remained = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Remained');
	public $transaction_pre = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Pre');
	public $transaction_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $transaction_transport = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Transport');
	public $transaction_vat = array('type' => 'enum@yes,nocalc,no!no', 'null' =>'NO' ,'label' => 'Vat');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ select button
	public function transaction_type() 
	{
		$this->form("select")->name("type")->required()->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("user")->required()->validate("id");
		$this->setChild($this->form);
	}
	public function user_id_customer() 
	{
		$this->form("text")->name("id_customer")->required();
	}
	public function transaction_date() 
	{
		$this->form("text")->name("date")->required();
	}
	public function transaction_sum() 
	{
		$this->form("text")->name("sum")->required();
	}
	public function transaction_discount() 
	{
		$this->form("text")->name("discount")->required();
	}
	public function transaction_initialreceived() 
	{
		$this->form("text")->name("initialreceived");
	}
	public function transaction_received() 
	{
		$this->form("text")->name("received");
	}
	public function transaction_remained() 
	{
		$this->form("text")->name("remained");
	}
	public function transaction_pre() 
	{
		$this->form("text")->name("pre")->required();
	}

	//------------------------------------------------------------------ description
	public function transaction_desc() 
	{
		$this->form("#desc");
	}
	public function transaction_transport() 
	{
		$this->form("text")->name("transport");
	}
	public function transaction_vat() 
	{
		$this->form("text")->name("vat")->required();
	}
	public function date_modified() {}
}
?>