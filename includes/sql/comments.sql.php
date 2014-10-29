<?php
namespace sql;
class comments 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $post_id = array('type' => 'smallint@5', 'label' => 'Post');
	public $product_id = array('type' => 'smallint@5', 'label' => 'Product');
	public $comment_author = array('type' => 'varchar@50', 'label' => 'Author');
	public $comment_author_email = array('type' => 'varchar@100', 'label' => 'Author Email');
	public $comment_author_url = array('type' => 'varchar@100', 'label' => 'Author Url');
	public $comment_author_ip = array('type' => 'int@10', 'label' => 'Author Ip');
	public $comment_agent = array('type' => 'varchar@255', 'label' => 'Agent');
	public $comment_content = array('type' => 'varchar@999', 'label' => 'Content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'label' => 'Status');
	public $comment_parent = array('type' => 'int@10', 'label' => 'Parent');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("#foreignkey")->name("post")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("#foreignkey")->name("product")->validate("id");
	}
	public function comment_author() 
	{
		$this->form()->name("author");
	}

	//------------------------------------------------------------------ email
	public function comment_author_email() 
	{
		$this->form("#email");
	}
	public function comment_author_url() 
	{
		$this->form()->name("author_url");
	}
	public function comment_author_ip() 
	{
		$this->form()->name("author_ip");
	}
	public function comment_agent() 
	{
		$this->form()->name("agent");
	}
	public function comment_content() 
	{
		$this->form()->name("content");
	}

	//------------------------------------------------------------------ select button
	public function comment_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function comment_parent() 
	{
		$this->form()->name("parent");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>