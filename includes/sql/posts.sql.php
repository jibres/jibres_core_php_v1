<?php
namespace sql;
class posts 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $post_language = array('type' => 'char@2', 'null' =>'YES' ,'label' => 'Language');
	public $post_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $post_slug_cat = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug Cat');
	public $post_slug = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Slug');
	public $post_content = array('type' => 'text@', 'null' =>'YES' ,'label' => 'Content');
	public $post_type = array('type' => 'enum@post,page!post', 'null' =>'NO' ,'label' => 'Type');
	public $post_status = array('type' => 'enum@publish,draft,schedule,deleted!draft', 'null' =>'NO' ,'label' => 'Status');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User');
	public $attachment_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Attachment');
	public $post_publishdate = array('type' => 'datetime@!CURRENT_TIMESTAMP', 'null' =>'YES' ,'label' => 'Publishdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function post_language() 
	{
		$this->form()->name("language");
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("#title");
	}
	public function post_slug_cat() 
	{
		$this->form()->name("slug_cat");
	}

	//------------------------------------------------------------------ slug
	public function post_slug() 
	{
		$this->form("#slug");
	}
	public function post_content() 
	{
		$this->form()->name("content");
	}

	//------------------------------------------------------------------ select button
	public function post_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function post_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("#foreignkey")->name("attachment")->validate("id");
	}
	public function post_publishdate() 
	{
		$this->form()->name("publishdate");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>