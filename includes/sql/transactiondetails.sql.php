<?php
namespace sql;
class transactiondetails 
{
	public $transactiondetail_row = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Row');
	public $transaction_id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'Transaction', 'foreign' => 'transactions@id!transaction_title');
	public $product_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Product', 'foreign' => 'products@id!product_title');
	public $transactiondetail_quantity = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'Quantity');
	public $transactiondetail_price = array('type' => 'decimal@13,4', 'null' =>'NO' ,'label' => 'Price');
	public $transactiondetail_discount = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Discount');

	public function transactiondetail_row() 
	{
		$this->form("text")->name("row");
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("select")->name("transactionid")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("productid")->validate("id");
		$this->setChild($this->form);
	}
	public function transactiondetail_quantity() 
	{
		$this->form("text")->name("quantity");
	}
	public function transactiondetail_price() 
	{
		$this->form("text")->name("price");
	}
	public function transactiondetail_discount() 
	{
		$this->form("text")->name("discount");
	}
}
?>