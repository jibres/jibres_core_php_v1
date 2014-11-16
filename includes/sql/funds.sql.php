<?php
namespace sql;
class funds 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $fund_title = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Title');
	public $fund_slug = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Slug');
	public $location_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Location', 'foreign' => 'locations@id!location_title');
	public $fund_initialbalance = array('type' => 'decimal@14,4!0.0000', 'null' =>'NO' ,'label' => 'Initialbalance');
	public $fund_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function fund_title() 
	{
		$this->form("text")->name("title")->required()->maxlength(100);
	}

	//------------------------------------------------------------------ slug
	public function fund_slug() 
	{
		$this->form("text")->name("slug")->required()->maxlength(100)->validate()->slugify("fund_title");
	}

	//------------------------------------------------------------------ id - foreign key
	public function location_id() 
	{
		$this->form("select")->name("location")->required()->min(0)->max(9999)->validate("id");
		$this->setChild($this->form);
	}
	public function fund_initialbalance() 
	{
		$this->form("text")->name("initialbalance")->required()->max(9999999999999);
	}

	//------------------------------------------------------------------ description
	public function fund_desc() 
	{
		$this->form("#desc")->maxlength(200);
	}
	public function date_modified() {}
}
?>