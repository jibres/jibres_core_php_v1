<?php
namespace sql;
class banks 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $bank_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $bank_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $bank_website = array('type' => 'varchar@50', 'null' =>'YES' ,'label' => 'Website');
	public $bank_active = array('type' => 'enum@yes,no!yes', 'null' =>'NO' ,'label' => 'Active');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


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
		$this->form("#slug");
	}

	//------------------------------------------------------------------ website
	public function bank_website() 
	{
		$this->form("#website");
	}

	//------------------------------------------------------------------ radio button
	public function bank_active() 
	{
		$this->form("radio")->name("active");
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>