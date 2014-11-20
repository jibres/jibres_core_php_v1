<?php
namespace sql;
class options 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $option_cat = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Cat');
	public $option_name = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Name');
	public $option_value = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Value');
	public $option_extra = array('type' => 'varchar@400', 'null' =>'YES' ,'label' => 'Extra');
	public $option_status = array('type' => 'enum@active,deactive!active', 'null' =>'NO' ,'label' => 'Status');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function option_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function option_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}
	public function option_value() 
	{
		$this->form("text")->name("value")->maxlength(200)->type('textarea');
	}
	public function option_extra() 
	{
		$this->form("text")->name("extra")->maxlength(400)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function option_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>