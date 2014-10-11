<?php
namespace sql;
class transaction_details {
	public $td_row = array('type' => 'smallint@5', 'label' => 'transaction_details_td_row');
	public $transaction_id = array('type' => 'int@10', 'label' => 'transaction_details_transaction_id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'transaction_details_product_id');
	public $td_quantity = array('type' => 'int@9', 'label' => 'transaction_details_td_quantity');
	public $td_price = array('type' => 'decimal@13,4', 'label' => 'transaction_details_td_price');
	public $td_discount = array('type' => 'decimal@13,4', 'label' => 'transaction_details_td_discount');

	public function td_row(){}
	public function transaction_id(){}
	public function product_id(){}
	public function td_quantity(){}
	public function td_price(){}
	public function td_discount(){}
}
?>