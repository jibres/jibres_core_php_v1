<?php
namespace sql;
class posts 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $post_language = array('type' => 'char@2', 'label' => 'Language');
	public $post_title = array('type' => 'varchar@100', 'label' => 'Title');
	public $post_slug_cat = array('type' => 'varchar@50', 'label' => 'Slug Cat');
	public $post_slug = array('type' => 'varchar@100', 'label' => 'Slug');
	public $post_content = array('type' => 'text@', 'label' => 'Content');
	public $post_type = array('type' => 'enum@post,page!post', 'label' => 'Type');
	public $post_status = array('type' => 'enum@publish,draft,schedule,deleted!draft', 'label' => 'Status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $attachment_id = array('type' => 'int@10', 'label' => 'Attachment Id');
	public $post_publishdate = array('type' => 'datetime@!CURRENT_TIMESTAMP', 'label' => 'Publishdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function post_language() 
	{
		$this->form()->name("Language");
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("#title");
	}
	public function post_slug_cat() 
	{
		$this->form()->name("Slug Cat");
	}

	//------------------------------------------------------------------ slug
	public function post_slug() 
	{
		$this->form("#slug");
	}
	public function post_content() 
	{
		$this->form()->name("Content");
	}

	//------------------------------------------------------------------ select button
	public function post_type() 
	{
		$this->form("select")->name("Type")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function post_status() 
	{
		$this->form("select")->name("Status")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}
	public function post_publishdate() 
	{
		$this->form()->name("Publishdate");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>