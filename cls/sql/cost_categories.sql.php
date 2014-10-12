<?php
namespace sql;
class cost_categories {
	public $id = array('type' => 'smallint@5', 'label' => 'cost_categories_id');
	public $cc_title = array('type' => 'varchar@50', 'label' => 'cost_categories_cc_title');
	public $cc_slug = array('type' => 'varchar@50', 'label' => 'cost_categories_cc_slug');
	public $cc_desc = array('type' => 'varchar@200', 'label' => 'cost_categories_cc_desc');
	public $cc_father = array('type' => 'smallint@5', 'label' => 'cost_categories_cc_father');
	public $cc_row = array('type' => 'smallint@5', 'label' => 'cost_categories_cc_row');
	public $cc_type = array('type' => 'enum@income,outcome', 'label' => 'cost_categories_cc_type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'cost_categories_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'cost_categories_date_modified');

	public function id(){}
	public function cc_title(){}
	public function cc_slug(){}
	public function cc_desc(){}
	public function cc_father(){}
	public function cc_row(){}
	public function cc_type(){}
	public function date_created(){}
	public function date_modified(){}
}
?>