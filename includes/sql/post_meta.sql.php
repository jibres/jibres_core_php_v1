<?php
namespace sql;
class post_meta 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $post_id = array('type' => 'smallint@5', 'label' => 'id');
	public $postmeta_name = array('type' => 'varchar@100', 'label' => 'name');
	public $postmeta_value = array('type' => 'varchar@999', 'label' => 'value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->validate("id");
	}
	public function postmeta_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function postmeta_value() 
	{
		$this->form()->name("value")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>