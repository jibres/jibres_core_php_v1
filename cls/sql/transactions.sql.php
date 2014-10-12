<?php
namespace sql;
class transactions {
	public $id = array('type' => 'int@10', 'label' => 'transactions_id');
	public $transaction_type = array('type' => 'enum@sale,purchase,customer_to_store,store_to_company,anbargardani,install,repair,chqeue_back_fail!sale', 'label' => 'transactions_transaction_type');
	public $user_id_employee = array('type' => 'smallint@5', 'label' => 'transactions_user_id_employee');
	public $user_id_customer = array('type' => 'smallint@5', 'label' => 'transactions_user_id_customer');
	public $transaction_date = array('type' => 'datetime@', 'label' => 'transactions_transaction_date');
	public $transaction_sum = array('type' => 'decimal@13,4', 'label' => 'transactions_transaction_sum');
	public $transaction_discount = array('type' => 'decimal@13,4', 'label' => 'transactions_transaction_discount');
	public $transaction_initial_received = array('type' => 'decimal@13,4', 'label' => 'transactions_transaction_initial_received');
	public $transaction_received = array('type' => 'decimal@13,4', 'label' => 'transactions_transaction_received');
	public $transaction_remained = array('type' => 'decimal@13,4', 'label' => 'transactions_transaction_remained');
	public $transaction_pre = array('type' => 'enum@yes,no', 'label' => 'transactions_transaction_pre');
	public $transaction_desc = array('type' => 'varchar@200', 'label' => 'transactions_transaction_desc');
	public $transaction_transport = array('type' => 'decimal@13,4', 'label' => 'transactions_transaction_transport');
	public $transaction_vat = array('type' => 'enum@yes,yes_nocalc,no', 'label' => 'transactions_transaction_vat');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'transactions_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'transactions_date_modified');

	public function id(){}
	public function transaction_type(){}
	public function user_id_employee(){}
	public function user_id_customer(){}
	public function transaction_date(){}
	public function transaction_sum(){}
	public function transaction_discount(){}
	public function transaction_initial_received(){}
	public function transaction_received(){}
	public function transaction_remained(){}
	public function transaction_pre(){}
	public function transaction_desc(){}
	public function transaction_transport(){}
	public function transaction_vat(){}
	public function date_created(){}
	public function date_modified(){}
}
?>