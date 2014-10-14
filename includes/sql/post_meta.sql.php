<?php
namespace sql;
class post_meta 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $post_id = array('type' => 'smallint@5', 'label' => 'post_id');
	public $postmeta_name = array('type' => 'varchar@100', 'label' => 'postmeta_name');
	public $postmeta_value = array('type' => 'varchar@999', 'label' => 'postmeta_value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->validate("id");
	}
	public function postmeta_name() 
	{
		
	}
	public function postmeta_value() 
	{
		
	}
	public function date_created() {}
	public function date_modified() {}
}
?>