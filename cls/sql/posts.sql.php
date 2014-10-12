<?php
namespace sql;
class posts {
	public $id = array('type' => 'smallint@5', 'label' => 'posts_id');
	public $post_language = array('type' => 'char@2', 'label' => 'posts_post_language');
	public $post_title = array('type' => 'varchar@100', 'label' => 'posts_post_title');
	public $post_slug_cat = array('type' => 'varchar@50', 'label' => 'posts_post_slug_cat');
	public $post_slug = array('type' => 'varchar@100', 'label' => 'posts_post_slug');
	public $post_content = array('type' => 'text@', 'label' => 'posts_post_content');
	public $post_type = array('type' => 'enum@post,page!post', 'label' => 'posts_post_type');
	public $post_status = array('type' => 'enum@publish,draft,schedule,deleted!draft', 'label' => 'posts_post_status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'posts_user_id');
	public $attachment_id = array('type' => 'int@10', 'label' => 'posts_attachment_id');
	public $post_publishdate = array('type' => 'datetime@!CURRENT_TIMESTAMP', 'label' => 'posts_post_publishdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'posts_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'posts_date_modified');

	public function id(){}
	public function post_language(){}
	public function post_title(){}
	public function post_slug_cat(){}
	public function post_slug(){}
	public function post_content(){}
	public function post_type(){}
	public function post_status(){}
	public function user_id(){}
	public function attachment_id(){}
	public function post_publishdate(){}
	public function date_created(){}
	public function date_modified(){}
}
?>