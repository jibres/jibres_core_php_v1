<?php
namespace sql;
class banks 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $bank_title = array('type' => 'varchar@50', 'label' => 'bank_title');
	public $bank_slug = array('type' => 'varchar@50', 'label' => 'bank_slug');
	public $bank_website = array('type' => 'varchar@50', 'label' => 'bank_website');
	public $bank_active = array('type' => 'enum@yes,no!yes', 'label' => 'bank_active');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function bank_title() 
	{
		$this->form("title")->name("bank_title");
	}

	//------------------------------------------------------------------ slug
	public function bank_slug() 
	{
		$this->form("slug")->name("bank_slug");
	}
	public function bank_website() 
	{
		
	}
	public function bank_active() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>