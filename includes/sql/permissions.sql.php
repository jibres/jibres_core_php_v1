<?php
namespace sql;
class permissions 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $permission_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $Permission_module = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Module');
	public $permission_view = array('type' => 'enum@yes,no!yes', 'null' =>'NO' ,'label' => 'View');
	public $permission_add = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Add');
	public $permission_edit = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Edit');
	public $permission_delete = array('type' => 'enum@yes,no!no', 'null' =>'NO' ,'label' => 'Delete');
	public $permission_status = array('type' => 'enum@active,deactive!active', 'null' =>'NO' ,'label' => 'Status');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function permission_title() 
	{
		$this->form("text")->name("title");
	}
	public function Permission_module() 
	{
		$this->form("text")->name("module");
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