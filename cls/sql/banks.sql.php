<?php
namespace sql;
class banks {
	public $id = array('type' => 'smallint@5', 'label' => 'banks_id');
	public $bank_title = array('type' => 'varchar@50', 'label' => 'banks_bank_title');
	public $bank_slug = array('type' => 'varchar@50', 'label' => 'banks_bank_slug');
	public $bank_website = array('type' => 'varchar@50', 'label' => 'banks_bank_website');
	public $bank_active = array('type' => 'enum@yes,no!yes', 'label' => 'banks_bank_active');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'banks_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'banks_date_modified');

	public function id(){}
	public function bank_title(){}
	public function bank_slug(){}
	public function bank_website(){}
	public function bank_active(){}
	public function date_created(){}
	public function date_modified(){}
}
?>