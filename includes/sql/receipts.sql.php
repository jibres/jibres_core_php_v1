<?php
namespace sql;
class receipts 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $receipt_code = array('type' => 'varchar@30', 'null' =>'YES' ,'label' => 'Code');
	public $receipt_price = array('type' => 'decimal@13,4!0.0000', 'null' =>'NO' ,'label' => 'Price');
	public $cheque_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Cheque', 'foreign' => 'cheques@id!cheque_title');
	public $receipt_chequedate = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Chequedate');
	public $receipt_chequestatus = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'null' =>'YES' ,'label' => 'Chequestatus');
	public $receipt_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $transaction_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Transaction', 'foreign' => 'transactions@id!transaction_title');
	public $fund_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Fund', 'foreign' => 'funds@id!fund_title');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function receipt_code() 
	{
		$this->form("text")->name("code");
	}
	public function receipt_price() 
	{
		$this->form("text")->name("price");
	}

	//------------------------------------------------------------------ id - foreign key
	public function cheque_id() 
	{
		$this->form("select")->name("cheque")->validate("id");
		$this->setChild($this->form);
	}
	public function receipt_chequedate() 
	{
		$this->form("text")->name("chequedate");
	}
	public function receipt_chequestatus() 
	{
		$this->form("text")->name("chequestatus");
	}

	//------------------------------------------------------------------ description
	public function receipt_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transaction")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function fund_id() 
	{
		$this->form("select")->name("fund")->validate("id");
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>