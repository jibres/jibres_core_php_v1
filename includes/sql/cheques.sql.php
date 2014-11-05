<?php
namespace sql;
class cheques 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $cheque_number = array('type' => 'varchar@20', 'null' =>'YES' ,'label' => 'Number');
	public $cheque_date = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Date');
	public $cheque_price = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Price');
	public $bank_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Bank');
	public $cheque_holder = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Holder');
	public $cheque_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'null' =>'YES' ,'label' => 'Status');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function cheque_number() 
	{
		$this->form()->name("number");
	}
	public function cheque_date() 
	{
		$this->form()->name("date");
	}
	public function cheque_price() 
	{
		$this->form()->name("price");
	}

	//------------------------------------------------------------------ id - foreign key
	public function bank_id() 
	{
		$this->form("#foreignkey")->name("bank")->validate("id");
	}
	public function cheque_holder() 
	{
		$this->form()->name("holder");
	}

	//------------------------------------------------------------------ description
	public function cheque_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ select button
	public function cheque_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
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