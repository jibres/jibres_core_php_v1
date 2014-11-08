<?php
namespace sql;
class posts 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $post_language = array('type' => 'char@2', 'null' =>'YES' ,'label' => 'Language');
	public $post_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $post_cat = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Cat');
	public $post_slug = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Slug');
	public $post_content = array('type' => 'text@', 'null' =>'YES' ,'label' => 'Content');
	public $post_type = array('type' => 'enum@post,page!post', 'null' =>'NO' ,'label' => 'Type');
	public $post_status = array('type' => 'enum@publish,draft,schedule,deleted!draft', 'null' =>'NO' ,'label' => 'Status');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User', 'foreign' => 'users@id!user_nickname');
	public $attachment_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Attachment', 'foreign' => 'attachments@id!attachment_title');
	public $post_publishdate = array('type' => 'datetime@!CURRENT_TIMESTAMP', 'null' =>'YES' ,'label' => 'Publishdate');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function post_language() 
	{
		$this->form("text")->name("language");
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("text")->name("title");
	}
	public function post_cat() 
	{
		$this->form("text")->name("cat");
	}

	//------------------------------------------------------------------ slug
	public function post_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("post_title");
	}
	public function post_content() 
	{
		$this->form("text")->name("content");
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
		$this->form("select")->name("userid")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachmentid")->validate("id");
		$this->setChild($this->form);
	}
	public function post_publishdate() 
	{
		$this->form("text")->name("publishdate");
	}
	public function date_modified() {}
}
?>