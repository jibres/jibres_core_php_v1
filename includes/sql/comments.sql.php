<?php
namespace sql;
class comments 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $post_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Post', 'foreign' => 'posts@id!post_title');
	public $product_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Product', 'foreign' => 'products@id!product_title');
	public $comment_author = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Author');
	public $comment_email = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Email');
	public $comment_url = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Url');
	public $comment_content = array('type' => 'varchar@999', 'null' =>'NO' ,'label' => 'Content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'null' =>'NO' ,'label' => 'Status');
	public $comment_parent = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Parent');
	public $user_id = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'User', 'foreign' => 'users@id!user_title');
	public $Visitor_id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'Visitor', 'foreign' => 'Visitors@id!Visitor_title');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


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
		$this->form("text")->name("author");
	}

	//------------------------------------------------------------------ email
	public function comment_email() 
	{
		$this->form("#email");
	}
	public function comment_url() 
	{
		$this->form("text")->name("url");
	}
	public function comment_content() 
	{
		$this->form("text")->name("content");
	}

	//------------------------------------------------------------------ select button
	public function comment_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function comment_parent() 
	{
		$this->form("text")->name("parent");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function Visitor_id() 
	{
		$this->form("#foreignkey")->name("Visitor")->validate("id");
	}
	public function date_modified() {}
}
?>