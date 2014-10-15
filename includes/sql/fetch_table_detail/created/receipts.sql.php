<?php
namespace sql;
class receipts 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $receipt_code = array('type' => 'varchar@30', 'label' => 'receipt_code');
	public $receipt_price = array('type' => 'decimal@13,4!0.0000', 'label' => 'receipt_price');
	public $cheque_id = array('type' => 'smallint@5', 'label' => 'cheque_id');
	public $receipt_cheque_date = array('type' => 'datetime@', 'label' => 'receipt_cheque_date');
	public $receipt_cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'receipt_cheque_status');
	public $receipt_desc = array('type' => 'varchar@200', 'label' => 'receipt_desc');
	public $transaction_id = array('type' => 'int@10', 'label' => 'transaction_id');
	public $fund_id = array('type' => 'smallint@5', 'label' => 'fund_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function receipt_code() 
	{
		$this->form()->name("code")
		->validate();
	}
	public function receipt_price() 
	{
		$this->form()->name("price")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function cheque_id() 
	{
		$this->validate("id");
	}
	public function receipt_cheque_date() 
	{
		$this->form()->name("cheque_date")
		->validate();
	}
	public function receipt_cheque_status() 
	{
		$this->form()->name("cheque_status")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function receipt_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function fund_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>