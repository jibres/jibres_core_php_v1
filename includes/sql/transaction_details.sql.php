<?php
namespace sql;
class transaction_details 
{
	public $td_row = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Row');
	public $transaction_id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'Transaction');
	public $product_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Product');
	public $td_quantity = array('type' => 'int@9', 'null' =>'NO' ,'label' => 'Quantity');
	public $td_price = array('type' => 'decimal@13,4', 'null' =>'NO' ,'label' => 'Price');
	public $td_discount = array('type' => 'decimal@13,4', 'null' =>'YES' ,'label' => 'Discount');

	public function td_row() 
	{
		$this->form()->name("row");
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->form("#foreignkey")->name("transaction")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("#foreignkey")->name("product")->validate("id");
	}
	public function td_quantity() 
	{
		$this->form()->name("quantity");
	}
	public function td_price() 
	{
		$this->form()->name("price");
	}
	public function td_discount() 
	{
		$this->form()->name("discount");
	}
}
?>