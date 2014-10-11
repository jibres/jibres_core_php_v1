<?php
namespace sql;
class receipts {
	public $id = array('type' => 'int@10', 'label' => 'receipts_id');
	public $receipt_code = array('type' => 'varchar@30', 'label' => 'receipts_receipt_code');
	public $receipt_price = array('type' => 'decimal@13,4!0.0000', 'label' => 'receipts_receipt_price');
	public $cheque_id = array('type' => 'smallint@5', 'label' => 'receipts_cheque_id');
	public $receipt_cheque_date = array('type' => 'datetime@', 'label' => 'receipts_receipt_cheque_date');
	public $receipt_cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'receipts_receipt_cheque_status');
	public $receipt_desc = array('type' => 'varchar@200', 'label' => 'receipts_receipt_desc');
	public $transaction_id = array('type' => 'int@10', 'label' => 'receipts_transaction_id');
	public $fund_id = array('type' => 'smallint@5', 'label' => 'receipts_fund_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'receipts_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'receipts_date_modified');

	public function id(){}
	public function receipt_code(){}
	public function receipt_price(){}
	public function cheque_id(){}
	public function receipt_cheque_date(){}
	public function receipt_cheque_status(){}
	public function receipt_desc(){}
	public function transaction_id(){}
	public function fund_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>