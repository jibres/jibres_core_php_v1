<?php
namespace sql;
class cheques 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $cheque_number = array('type' => 'varchar@20', 'label' => 'Number');
	public $cheque_date = array('type' => 'datetime@', 'label' => 'Date');
	public $cheque_price = array('type' => 'decimal@13,4', 'label' => 'Price');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'Bank Id');
	public $cheque_holder = array('type' => 'varchar@100', 'label' => 'Holder');
	public $cheque_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'Status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function cheque_number() 
	{
		$this->form()->name("Number")
		->validate();
	}
	public function cheque_date() 
	{
		$this->form()->name("Date")
		->validate();
	}
	public function cheque_price() 
	{
		$this->form()->name("Price")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->validate("id");
	}
	public function cheque_holder() 
	{
		$this->form()->name("Holder")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function cheque_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function cheque_status() 
	{
		$this->form()->name("Status")
		->validate();
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