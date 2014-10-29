<?php
namespace sql;
class post_meta 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $post_id = array('type' => 'smallint@5', 'label' => 'Post');
	public $postmeta_name = array('type' => 'varchar@100', 'label' => 'Name');
	public $postmeta_value = array('type' => 'varchar@999', 'label' => 'Value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("#foreignkey")->name("post")->validate("id");
	}
	public function postmeta_name() 
	{
		$this->form()->name("name");
	}
	public function postmeta_value() 
	{
		$this->form()->name("value");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>