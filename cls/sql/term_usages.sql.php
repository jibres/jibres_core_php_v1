<?php
namespace sql;
class term_usages {
	public $id = array('type' => 'smallint@5', 'label' => 'term_usages_id');
	public $term_id = array('type' => 'smallint@5', 'label' => 'term_usages_term_id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'term_usages_post_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'term_usages_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'term_usages_date_modified');

	public function id(){}
	public function term_id(){}
	public function post_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>