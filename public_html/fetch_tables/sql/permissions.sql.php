<?php
namespace sql;
class permissions 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $permission_name = array('type' => 'varchar@50', 'label' => 'permission_name');
	public $Permission_table = array('type' => 'varchar@50', 'label' => 'Permission_table');
	public $permission_view = array('type' => 'enum@yes,no!yes', 'label' => 'permission_view');
	public $permission_add = array('type' => 'enum@yes,no!no', 'label' => 'permission_add');
	public $permission_edit = array('type' => 'enum@yes,no!no', 'label' => 'permission_edit');
	public $permission_delete = array('type' => 'enum@yes,no!no', 'label' => 'permission_delete');
	public $permission_status = array('type' => 'enum@active,deactive!active', 'label' => 'permission_status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function permission_name() 
	{
		
	}
	public function Permission_table() 
	{
		
	}
	public function permission_view() 
	{
		
	}
	public function permission_add() 
	{
		
	}
	public function permission_edit() 
	{
		
	}
	public function permission_delete() 
	{
		
	}
	public function permission_status() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>