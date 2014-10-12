<?php
namespace sql;
class cheques 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $cheque_number = array('type' => 'varchar@20', 'label' => 'cheque_number');
	public $cheque_date = array('type' => 'datetime@', 'label' => 'cheque_date');
	public $cheque_price = array('type' => 'decimal@13,4', 'label' => 'cheque_price');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'bank_id');
	public $cheque_holder = array('type' => 'varchar@100', 'label' => 'cheque_holder');
	public $cheque_desc = array('type' => 'varchar@200', 'label' => 'cheque_desc');
	public $cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'cheque_status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function cheque_number() 
	{
		
	}
	public function cheque_date() 
	{
		
	}
	public function cheque_price() 
	{
		
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->validate("id");
	}
	public function cheque_holder() 
	{
		
	}

	//------------------------------------------------------------------ description
	public function cheque_desc() 
	{
		$this->form("desc")->name("cheque_desc");
	}
	public function cheque_status() 
	{
		
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function date_created() {};
	public function date_modified() {};
}
?>