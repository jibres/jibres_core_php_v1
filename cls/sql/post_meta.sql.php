<?php
namespace sql;
class post_meta {
	public $id = array('type' => 'smallint@5', 'label' => 'post_meta_id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'post_meta_post_id');
	public $postmeta_name = array('type' => 'varchar@100', 'label' => 'post_meta_postmeta_name');
	public $postmeta_value = array('type' => 'varchar@999', 'label' => 'post_meta_postmeta_value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'post_meta_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'post_meta_date_modified');

	public function id(){}
	public function post_id(){}
	public function postmeta_name(){}
	public function postmeta_value(){}
	public function date_created(){}
	public function date_modified(){}
}
?>