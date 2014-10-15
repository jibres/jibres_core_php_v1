<?php
namespace sql;
class permissions 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $permission_name = array('type' => 'varchar@50', 'label' => 'name');
	public $Permission_table = array('type' => 'varchar@50', 'label' => 'table');
	public $permission_view = array('type' => 'enum@yes,no!yes', 'label' => 'view');
	public $permission_add = array('type' => 'enum@yes,no!no', 'label' => 'add');
	public $permission_edit = array('type' => 'enum@yes,no!no', 'label' => 'edit');
	public $permission_delete = array('type' => 'enum@yes,no!no', 'label' => 'delete');
	public $permission_status = array('type' => 'enum@active,deactive!active', 'label' => 'status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function permission_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function Permission_table() 
	{
		$this->form()->name("table")
		->validate();
	}
	public function permission_view() 
	{
		$this->form()->name("view")
		->validate();
	}
	public function permission_add() 
	{
		$this->form()->name("add")
		->validate();
	}
	public function permission_edit() 
	{
		$this->form()->name("edit")
		->validate();
	}
	public function permission_delete() 
	{
		$this->form()->name("delete")
		->validate();
	}
	public function permission_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>