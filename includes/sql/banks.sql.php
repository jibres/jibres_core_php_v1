<?php
namespace sql;
class banks 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $bank_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $bank_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $bank_website = array('type' => 'varchar@50', 'label' => 'Website');
	public $bank_active = array('type' => 'enum@yes,no!yes', 'label' => 'Active');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function bank_title() 
	{
		$this->form("#title");
	}

	//------------------------------------------------------------------ slug
	public function bank_slug() 
	{
		$this->form()->name("Slug")->validate();
	}
	public function bank_website() 
	{
		$this->form()->name("Website")
		->validate();
	}

	//------------------------------------------------------------------ radio button
	public function bank_active() 
	{
		$this->form("radio")->name("Active")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>