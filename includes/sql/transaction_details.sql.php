<?php
namespace sql;
class transaction_details 
{
	public $td_row = array('type' => 'smallint@5', 'label' => 'row');
	public $transaction_id = array('type' => 'int@10', 'label' => 'id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'id');
	public $td_quantity = array('type' => 'int@9', 'label' => 'quantity');
	public $td_price = array('type' => 'decimal@13,4', 'label' => 'price');
	public $td_discount = array('type' => 'decimal@13,4', 'label' => 'discount');

	public function td_row() 
	{
		$this->form()->name("row")
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
		$this->form()->name("quantity")
		->validate();
	}
	public function td_price() 
	{
		$this->form()->name("price")
		->validate();
	}
	public function td_discount() 
	{
		$this->form()->name("discount")
		->validate();
	}
}
?>