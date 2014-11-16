<?php
namespace sql;
class postmetas 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $post_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Post', 'foreign' => 'posts@id!post_title');
	public $postmeta_name = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Name');
	public $postmeta_value = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Value');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post")->required()->validate("id");
		$this->setChild($this->form);
	}
	public function postmeta_name() 
	{
		$this->form("text")->name("name")->required();
	}
	public function postmeta_value() 
	{
		$this->form("text")->name("value");
	}
	public function date_modified() {}
}
?>