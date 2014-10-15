<?php
namespace sql;
class permissions 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $permission_name = array('type' => 'varchar@50', 'label' => 'Name');
	public $Permission_table = array('type' => 'varchar@50', 'label' => 'Table');
	public $permission_view = array('type' => 'enum@yes,no!yes', 'label' => 'View');
	public $permission_add = array('type' => 'enum@yes,no!no', 'label' => 'Add');
	public $permission_edit = array('type' => 'enum@yes,no!no', 'label' => 'Edit');
	public $permission_delete = array('type' => 'enum@yes,no!no', 'label' => 'Delete');
	public $permission_status = array('type' => 'enum@active,deactive!active', 'label' => 'Status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function permission_name() 
	{
		$this->form()->name("Name")
		->validate();
	}
	public function Permission_table() 
	{
		$this->form()->name("Table")
		->validate();
	}
	public function permission_view() 
	{
		$this->form()->name("View")
		->validate();
	}
	public function permission_add() 
	{
		$this->form()->name("Add")
		->validate();
	}
	public function permission_edit() 
	{
		$this->form()->name("Edit")
		->validate();
	}
	public function permission_delete() 
	{
		$this->form()->name("Delete")
		->validate();
	}
	public function permission_status() 
	{
		$this->form()->name("Status")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>