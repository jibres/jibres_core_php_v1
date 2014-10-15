<?php
namespace sql;
class addons 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $addon_name = array('type' => 'varchar@50', 'label' => 'Name');
	public $addon_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $addon_desc = array('type' => 'varchar@999', 'label' => 'Description');
	public $addon_status = array('type' => 'enum@active,deactive,expire,going_to_expire!deactive', 'label' => 'Status');
	public $addon_expire = array('type' => 'datetime@', 'label' => 'Expire');
	public $addon_installdate = array('type' => 'datetime@', 'label' => 'Installdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function addon_name() 
	{
		$this->form()->name("Name")
		->validate();
	}

	//------------------------------------------------------------------ slug
	public function addon_slug() 
	{
		$this->form("#slug")->name("Slug")->validate()
		->createslug(function()	{$this->value =\validator_lib::$save['form']['addon_title']->value;});
	}

	//------------------------------------------------------------------ description
	public function addon_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function addon_status() 
	{
		$this->form()->name("Status")
		->validate();
	}
	public function addon_expire() 
	{
		$this->form()->name("Expire")
		->validate();
	}
	public function addon_installdate() 
	{
		$this->form()->name("Installdate")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>