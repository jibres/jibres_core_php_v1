<?php
namespace sql;
class comments 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $post_id = array('type' => 'smallint@5', 'label' => 'Post Id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'Product Id');
	public $comment_author = array('type' => 'varchar@50', 'label' => 'Author');
	public $comment_author_email = array('type' => 'varchar@100', 'label' => 'Author Email');
	public $comment_author_url = array('type' => 'varchar@100', 'label' => 'Author Url');
	public $comment_author_ip = array('type' => 'int@10', 'label' => 'Author Ip');
	public $comment_agent = array('type' => 'varchar@255', 'label' => 'Agent');
	public $comment_content = array('type' => 'varchar@999', 'label' => 'Content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'label' => 'Status');
	public $comment_parent = array('type' => 'int@10', 'label' => 'Parent');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


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
		$this->form()->name("Author")
		->validate();
	}

	//------------------------------------------------------------------ email
	public function comment_author_email() 
	{
		$this->form("#email")->name("Author Email")->validate();
	}
	public function comment_author_url() 
	{
		$this->form()->name("Author Url")
		->validate();
	}
	public function comment_author_ip() 
	{
		$this->form()->name("Author Ip")
		->validate();
	}
	public function comment_agent() 
	{
		$this->form()->name("Agent")
		->validate();
	}
	public function comment_content() 
	{
		$this->form()->name("Content")
		->validate();
	}

	//------------------------------------------------------------------ select button
	public function comment_status() 
	{
		$this->form("select")->name("Status")->validate();
		$this->setChild($this->form);
	}
	public function comment_parent() 
	{
		$this->form()->name("Parent")
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