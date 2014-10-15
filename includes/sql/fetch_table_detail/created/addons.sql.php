<?php
namespace sql;
class addons 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $addon_name = array('type' => 'varchar@50', 'label' => 'addon_name');
	public $addon_slug = array('type' => 'varchar@50', 'label' => 'addon_slug');
	public $addon_desc = array('type' => 'varchar@999', 'label' => 'addon_desc');
	public $addon_status = array('type' => 'enum@active,deactive,expire,going_to_expire!deactive', 'label' => 'addon_status');
	public $addon_expire = array('type' => 'datetime@', 'label' => 'addon_expire');
	public $addon_installdate = array('type' => 'datetime@', 'label' => 'addon_installdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function addon_name() 
	{
		$this->form()->name("name")
		->validate();
	}

	//------------------------------------------------------------------ slug
	public function addon_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['addon_title']->value
	}

	//------------------------------------------------------------------ description
	public function addon_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}
	public function addon_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function addon_expire() 
	{
		$this->form()->name("expire")
		->validate();
	}
	public function addon_installdate() 
	{
		$this->form()->name("installdate")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>