<?php
namespace sql;
class errors {
	public $id = array('type' => 'smallint@5', 'label' => 'errors_id');
	public $ed_title = array('type' => 'varchar@100', 'label' => 'errors_ed_title');
	public $ed_solution = array('type' => 'varchar@999', 'label' => 'errors_ed_solution');
	public $ed_priority = array('type' => 'enum@critical,high,medium,low!medium', 'label' => 'errors_ed_priority');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'errors_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'errors_date_modified');

	public function id(){}
	public function ed_title(){}
	public function ed_solution(){}
	public function ed_priority(){}
	public function date_created(){}
	public function date_modified(){}
}
?>