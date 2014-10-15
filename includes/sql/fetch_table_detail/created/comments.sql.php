<?php
namespace sql;
class comments 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'post_id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'product_id');
	public $comment_author = array('type' => 'varchar@50', 'label' => 'comment_author');
	public $comment_author_email = array('type' => 'varchar@100', 'label' => 'comment_author_email');
	public $comment_author_url = array('type' => 'varchar@100', 'label' => 'comment_author_url');
	public $comment_author_ip = array('type' => 'int@10', 'label' => 'comment_author_ip');
	public $comment_agent = array('type' => 'varchar@255', 'label' => 'comment_agent');
	public $comment_content = array('type' => 'varchar@999', 'label' => 'comment_content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'label' => 'comment_status');
	public $comment_parent = array('type' => 'int@10', 'label' => 'comment_parent');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->validate("id");
	}
	public function comment_author() 
	{
		$this->form()->name("author")
		->validate();
	}

	//------------------------------------------------------------------ email
	public function comment_author_email() 
	{
		$this->form("#email")->name("author_email")->validate();
	}
	public function comment_author_url() 
	{
		$this->form()->name("author_url")
		->validate();
	}
	public function comment_author_ip() 
	{
		$this->form()->name("author_ip")
		->validate();
	}
	public function comment_agent() 
	{
		$this->form()->name("agent")
		->validate();
	}
	public function comment_content() 
	{
		$this->form()->name("content")
		->validate();
	}
	public function comment_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function comment_parent() 
	{
		$this->form()->name("parent")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>