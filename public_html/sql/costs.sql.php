<?php
namespace sql;
class costs {
	public $id = array('type' => 'smallint@5', 'label' => 'costs_id');
	public $cost_title = array('type' => 'varchar@50', 'label' => 'costs_cost_title');
	public $cost_price = array('type' => 'decimal@13,4', 'label' => 'costs_cost_price');
	public $cc_id = array('type' => 'smallint@5', 'label' => 'costs_cc_id');
	public $account_id = array('type' => 'smallint@5', 'label' => 'costs_account_id');
	public $cost_date = array('type' => 'datetime@', 'label' => 'costs_cost_date');
	public $cost_desc = array('type' => 'varchar@200', 'label' => 'costs_cost_desc');
	public $cost_type = array('type' => 'enum@income,outcome!outcome', 'label' => 'costs_cost_type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'costs_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'costs_date_modified');

	public function id(){}
	public function cost_title(){}
	public function cost_price(){}
	public function cc_id(){}
	public function account_id(){}
	public function cost_date(){}
	public function cost_desc(){}
	public function cost_type(){}
	public function date_created(){}
	public function date_modified(){}
}
?>