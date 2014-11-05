<?php
namespace sql;
class permissions 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $permission_name = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Name');
	public $Permission_table = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Table');
	public $permission_view = array('type' => 'enum@yes,no!yes', 'null' =>'NO' ,'label' => 'View');
	public $permission_add = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Add');
	public $permission_edit = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Edit');
	public $permission_delete = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Delete');
	public $permission_status = array('type' => 'enum@active,deactive!active', 'null' =>'NO' ,'label' => 'Status');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function permission_name() 
	{
		$this->form("text")->name("name");
	}
	public function Permission_table() 
	{
		$this->form("text")->name("table");
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
	public function date_modified() {}
}
?>