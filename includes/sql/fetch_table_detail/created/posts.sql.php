<?php
namespace sql;
class posts 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $post_language = array('type' => 'char@2', 'label' => 'language');
	public $post_title = array('type' => 'varchar@100', 'label' => 'title');
	public $post_slug_cat = array('type' => 'varchar@50', 'label' => 'slug_cat');
	public $post_slug = array('type' => 'varchar@100', 'label' => 'slug');
	public $post_content = array('type' => 'text@', 'label' => 'content');
	public $post_type = array('type' => 'enum@post,page!post', 'label' => 'type');
	public $post_status = array('type' => 'enum@publish,draft,schedule,deleted!draft', 'label' => 'status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'id');
	public $attachment_id = array('type' => 'int@10', 'label' => 'id');
	public $post_publishdate = array('type' => 'datetime@!CURRENT_TIMESTAMP', 'label' => 'publishdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function post_language() 
	{
		$this->form()->name("language")
		->validate();
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("#title")->name("title")->validate();
	}
	public function post_slug_cat() 
	{
		$this->form()->name("slug_cat")
		->validate();
	}

	//------------------------------------------------------------------ slug
	public function post_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['post_title']->value
	}
	public function post_content() 
	{
		$this->form()->name("content")
		->validate();
	}
	public function post_type() 
	{
		$this->form()->name("type")
		->validate();
	}
	public function post_status() 
	{
		$this->form()->name("status")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->validate("id");
	}
	public function post_publishdate() 
	{
		$this->form()->name("publishdate")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>