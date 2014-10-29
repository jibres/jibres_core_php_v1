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
		$this->form()->name("name");
	}
	public function Permission_table() 
	{
		$this->form()->name("table");
	}

	//------------------------------------------------------------------ radio button
	public function permission_view() 
	{
		$this->form("radio")->name("view");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_add() 
	{
		$this->form("radio")->name("add");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_edit() 
	{
		$this->form("radio")->name("edit");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_delete() 
	{
		$this->form("radio")->name("delete");
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function permission_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>