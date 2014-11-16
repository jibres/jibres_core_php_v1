<?php
namespace sql;
class receipts 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $receipt_code = array('type' => 'varchar@30', 'null' =>'YES' ,'label' => 'Code');
	public $receipt_type = array('type' => 'enum@income,outcome!income', 'null' =>'YES' ,'label' => 'Type');
	public $receipt_price = array('type' => 'decimal@13,4!0.0000', 'null' =>'NO' ,'label' => 'Price');
	public $receipt_date = array('type' => 'datetime@', 'null' =>'NO' ,'label' => 'Date');
	public $paper_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Paper', 'foreign' => 'papers@id!paper_title');
	public $receipt_paperdate = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Paperdate');
	public $receipt_paperstatus = array('type' => 'enum@pass,recovery,fail,lost,block,delete,inprogress', 'null' =>'YES' ,'label' => 'Paperstatus');
	public $receipt_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $transaction_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Transaction', 'foreign' => 'transactions@id!transaction_title');
	public $fund_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Fund', 'foreign' => 'funds@id!fund_title');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $user_id_customer = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Id Customer');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function receipt_code() 
	{
		$this->form("text")->name("code");
	}

	//------------------------------------------------------------------ select button
	public function receipt_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}
	public function receipt_price() 
	{
		$this->form("text")->name("price")->required();
	}
	public function receipt_date() 
	{
		$this->form("text")->name("date")->required();
	}

	//------------------------------------------------------------------ id - foreign key
	public function paper_id() 
	{
		$this->form("select")->name("paper")->validate("id");
		$this->setChild($this->form);
	}
	public function receipt_paperdate() 
	{
		$this->form("text")->name("paperdate");
	}
	public function receipt_paperstatus() 
	{
		$this->form("text")->name("paperstatus");
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
		$this->form("select")->name("fund")->required()->validate("id");
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
	public function date_modified() {}
}
?>