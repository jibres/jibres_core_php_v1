<?php
namespace sql;
class terms {
	public $id = array('type' => 'smallint@5', 'label' => 'terms_id');
	public $term_name = array('type' => 'varchar@50', 'label' => 'terms_term_name');
	public $term_slug = array('type' => 'varchar@50', 'label' => 'terms_term_slug');
	public $term_desc = array('type' => 'varchar@200', 'label' => 'terms_term_desc');
	public $term_father = array('type' => 'smallint@5', 'label' => 'terms_term_father');
	public $term_type = array('type' => 'enum@cat,tag!cat', 'label' => 'terms_term_type');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'terms_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'terms_date_modified');

	public function id(){}
	public function term_name(){}
	public function term_slug(){}
	public function term_desc(){}
	public function term_father(){}
	public function term_type(){}
	public function date_created(){}
	public function date_modified(){}
}
?>