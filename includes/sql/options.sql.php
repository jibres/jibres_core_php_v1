<?php
namespace sql;
class options 
{
	public $id = array('type' => 'smallint@5', 'label' => 'd');
	public $option_cat = array('type' => 'varchar@50', 'label' => 'cat');
	public $option_name = array('type' => 'varchar@50', 'label' => 'name');
	public $option_value = array('type' => 'varchar@200', 'label' => 'value');
	public $option_value_extra = array('type' => 'varchar@255', 'label' => 'value_extra');
	public $option_status = array('type' => 'enum@active,deactive!active', 'label' => 'status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}
	public function option_cat() 
	{
		$this->form()->name("cat")
		->validate();
	}
	public function option_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function option_value() 
	{
		$this->form()->name("value")
		->validate();
	}
	public function option_value_extra() 
	{
		$this->form()->name("value_extra")
		->validate();
	}
	public function option_status() 
	{
		$this->form()->name("status")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>