<?php
namespace sql;
class addons 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $addon_name = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Name');
	public $addon_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $addon_desc = array('type' => 'varchar@999', 'null' =>'YES' ,'label' => 'Description');
	public $addon_status = array('type' => 'enum@active,deactive,expire,goingtoexpire!deactive', 'null' =>'NO' ,'label' => 'Status');
	public $addon_expire = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Expire');
	public $addon_installdate = array('type' => 'datetime@', 'null' =>'YES' ,'label' => 'Installdate');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function addon_name() 
	{
		$this->form("text")->name("name")->required();
	}

	//------------------------------------------------------------------ slug
	public function addon_slug() 
	{
		$this->form("text")->name("slug")->required()->validate()->slugify("addon_title");
	}

	//------------------------------------------------------------------ description
	public function addon_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ select button
	public function addon_status() 
	{
		$this->form("select")->name("status")->required()->validate();
		$this->setChild($this->form);
	}
	public function addon_expire() 
	{
		$this->form("text")->name("expire");
	}
	public function addon_installdate() 
	{
		$this->form("text")->name("installdate");
	}
	public function date_modified() {}
}
?>