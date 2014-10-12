<?php
namespace sql;
class comments {
	public $id = array('type' => 'smallint@5', 'label' => 'comments_id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'comments_post_id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'comments_product_id');
	public $comment_author = array('type' => 'varchar@50', 'label' => 'comments_comment_author');
	public $comment_author_email = array('type' => 'varchar@100', 'label' => 'comments_comment_author_email');
	public $comment_author_url = array('type' => 'varchar@100', 'label' => 'comments_comment_author_url');
	public $comment_author_ip = array('type' => 'int@10', 'label' => 'comments_comment_author_ip');
	public $comment_agent = array('type' => 'varchar@255', 'label' => 'comments_comment_agent');
	public $comment_content = array('type' => 'varchar@999', 'label' => 'comments_comment_content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'label' => 'comments_comment_status');
	public $comment_parent = array('type' => 'int@10', 'label' => 'comments_comment_parent');
	public $user_id = array('type' => 'smallint@5', 'label' => 'comments_user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'comments_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'comments_date_modified');

	public function id(){}
	public function post_id(){}
	public function product_id(){}
	public function comment_author(){}
	public function comment_author_email(){}
	public function comment_author_url(){}
	public function comment_author_ip(){}
	public function comment_agent(){}
	public function comment_content(){}
	public function comment_status(){}
	public function comment_parent(){}
	public function user_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>