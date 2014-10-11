<?php
namespace sql;
class funds {
	public $id = array('type' => 'smallint@5', 'label' => 'funds_id');
	public $fund_title = array('type' => 'varchar@100', 'label' => 'funds_fund_title');
	public $fund_slug = array('type' => 'varchar@100', 'label' => 'funds_fund_slug');
	public $location_id = array('type' => 'smallint@5', 'label' => 'funds_location_id');
	public $fund_initial_balance = array('type' => 'decimal@14,4', 'label' => 'funds_fund_initial_balance');
	public $fund_desc = array('type' => 'varchar@200', 'label' => 'funds_fund_desc');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'funds_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'funds_date_modified');

	public function id(){}
	public function fund_title(){}
	public function fund_slug(){}
	public function location_id(){}
	public function fund_initial_balance(){}
	public function fund_desc(){}
	public function date_created(){}
	public function date_modified(){}
}
?>