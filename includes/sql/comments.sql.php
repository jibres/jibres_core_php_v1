<?php
namespace sql;
class comments 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $post_id = array('type' => 'smallint@5', 'label' => 'id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'id');
	public $comment_author = array('type' => 'varchar@50', 'label' => 'author');
	public $comment_author_email = array('type' => 'varchar@100', 'label' => 'author_email');
	public $comment_author_url = array('type' => 'varchar@100', 'label' => 'author_url');
	public $comment_author_ip = array('type' => 'int@10', 'label' => 'author_ip');
	public $comment_agent = array('type' => 'varchar@255', 'label' => 'agent');
	public $comment_content = array('type' => 'varchar@999', 'label' => 'content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'label' => 'status');
	public $comment_parent = array('type' => 'int@10', 'label' => 'parent');
	public $user_id = array('type' => 'smallint@5', 'label' => 'id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


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