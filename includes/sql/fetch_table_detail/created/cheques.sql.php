<?php
namespace sql;
class cheques 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $cheque_number = array('type' => 'varchar@20', 'label' => 'number');
	public $cheque_date = array('type' => 'datetime@', 'label' => 'date');
	public $cheque_price = array('type' => 'decimal@13,4', 'label' => 'price');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'id');
	public $cheque_holder = array('type' => 'varchar@100', 'label' => 'holder');
	public $cheque_desc = array('type' => 'varchar@200', 'label' => 'desc');
	public $cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function cheque_number() 
	{
		$this->form()->name("number")
		->validate();
	}
	public function cheque_date() 
	{
		$this->form()->name("date")
		->validate();
	}
	public function cheque_price() 
	{
		$this->form()->name("price")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->validate("id");
	}
	public function cheque_holder() 
	{
		$this->form()->name("holder")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function cheque_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function cheque_status() 
	{
		$this->form()->name("status")
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