<?php
namespace sql;
class receipts 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $receipt_code = array('type' => 'varchar@30', 'label' => 'Code');
	public $receipt_price = array('type' => 'decimal@13,4!0.0000', 'label' => 'Price');
	public $cheque_id = array('type' => 'smallint@5', 'label' => 'Cheque');
	public $receipt_cheque_date = array('type' => 'datetime@', 'label' => 'Cheque Date');
	public $receipt_cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'Cheque Status');
	public $receipt_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $transaction_id = array('type' => 'int@10', 'label' => 'Transaction');
	public $fund_id = array('type' => 'smallint@5', 'label' => 'Fund');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function receipt_code() 
	{
		$this->form()->name("code");
	}
	public function receipt_price() 
	{
		$this->form()->name("price");
	}

	//------------------------------------------------------------------ id - foreign key
	public function cheque_id() 
	{
		$this->form("#foreignkey")->name("cheque")->validate("id");
	}
	public function receipt_cheque_date() 
	{
		$this->form()->name("cheque_date");
	}

	//------------------------------------------------------------------ select button
	public function receipt_cheque_status() 
	{
		$this->form("select")->name("cheque_status")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ description
	public function receipt_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("#foreignkey")->name("transaction")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function fund_id() 
	{
		$this->form("#foreignkey")->name("fund")->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>