<?php
namespace sql;
class cheques {
	public $id = array('type' => 'smallint@5', 'label' => 'cheques_id');
	public $cheque_number = array('type' => 'varchar@20', 'label' => 'cheques_cheque_number');
	public $cheque_date = array('type' => 'datetime@', 'label' => 'cheques_cheque_date');
	public $cheque_price = array('type' => 'decimal@13,4', 'label' => 'cheques_cheque_price');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'cheques_bank_id');
	public $cheque_holder = array('type' => 'varchar@100', 'label' => 'cheques_cheque_holder');
	public $cheque_desc = array('type' => 'varchar@200', 'label' => 'cheques_cheque_desc');
	public $cheque_status = array('type' => 'enum@pass,back_recovery,back_fail,lost,block,delete,inprogress', 'label' => 'cheques_cheque_status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'cheques_user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'cheques_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'cheques_date_modified');

	public function id(){}
	public function cheque_number(){}
	public function cheque_date(){}
	public function cheque_price(){}
	public function bank_id(){}
	public function cheque_holder(){}
	public function cheque_desc(){}
	public function cheque_status(){}
	public function user_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>