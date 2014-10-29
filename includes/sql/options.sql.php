<?php
namespace sql;
class options 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $option_cat = array('type' => 'varchar@50', 'label' => 'Cat');
	public $option_name = array('type' => 'varchar@50', 'label' => 'Name');
	public $option_value = array('type' => 'varchar@200', 'label' => 'Value');
	public $option_value_extra = array('type' => 'varchar@255', 'label' => 'Value Extra');
	public $option_status = array('type' => 'enum@active,deactive!active', 'label' => 'Status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function option_cat() 
	{
		$this->form()->name("cat");
	}
	public function option_name() 
	{
		$this->form()->name("name");
	}
	public function option_value() 
	{
		$this->form()->name("value");
	}
	public function option_value_extra() 
	{
		$this->form()->name("value_extra");
	}

	//------------------------------------------------------------------ select button
	public function option_status() 
	{
		$this->form("select")->name("status")->validate();
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>