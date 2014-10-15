<?php
namespace sql;
class transaction_details 
{
	public $td_row = array('type' => 'smallint@5', 'label' => 'Row');
	public $transaction_id = array('type' => 'int@10', 'label' => 'Transaction Id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'Product Id');
	public $td_quantity = array('type' => 'int@9', 'label' => 'Quantity');
	public $td_price = array('type' => 'decimal@13,4', 'label' => 'Price');
	public $td_discount = array('type' => 'decimal@13,4', 'label' => 'Discount');

	public function td_row() 
	{
		$this->form()->name("Row")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function transaction_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->validate("id");
	}
	public function td_quantity() 
	{
		$this->form()->name("Quantity")
		->validate();
	}
	public function td_price() 
	{
		$this->form()->name("Price")
		->validate();
	}
	public function td_discount() 
	{
		$this->form()->name("Discount")
		->validate();
	}
}
?>