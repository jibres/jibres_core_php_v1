<?php
namespace sql;
class posts 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $post_language = array('type' => 'char@2', 'label' => 'post_language');
	public $post_title = array('type' => 'varchar@100', 'label' => 'post_title');
	public $post_slug_cat = array('type' => 'varchar@50', 'label' => 'post_slug_cat');
	public $post_slug = array('type' => 'varchar@100', 'label' => 'post_slug');
	public $post_content = array('type' => 'text@', 'label' => 'post_content');
	public $post_type = array('type' => 'enum@post,page!post', 'label' => 'post_type');
	public $post_status = array('type' => 'enum@publish,draft,schedule,deleted!draft', 'label' => 'post_status');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $attachment_id = array('type' => 'int@10', 'label' => 'attachment_id');
	public $post_publishdate = array('type' => 'datetime@!CURRENT_TIMESTAMP', 'label' => 'post_publishdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function post_language() 
	{
		
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("#title")->name("post_title");
	}
	public function post_slug_cat() 
	{
		
	}

	//------------------------------------------------------------------ slug
	public function post_slug() 
	{
		$this->form("#slug")->name("post_slug");
	}
	public function post_content() 
	{
		
	}
	public function post_type() 
	{
		
	}
	public function post_status() 
	{
		
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
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>