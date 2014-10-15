<?php
namespace sql;
class banks 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $bank_title = array('type' => 'varchar@50', 'label' => 'title');
	public $bank_slug = array('type' => 'varchar@50', 'label' => 'slug');
	public $bank_website = array('type' => 'varchar@50', 'label' => 'website');
	public $bank_active = array('type' => 'enum@yes,no!yes', 'label' => 'active');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function bank_title() 
	{
		$this->form("#title")->name("title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function bank_slug() 
	{
		$this->form("#slug")->name("slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['bank_title']->value
	}
	public function bank_website() 
	{
		$this->form()->name("website")
		->validate();
	}
	public function bank_active() 
	{
		$this->form()->name("active")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>