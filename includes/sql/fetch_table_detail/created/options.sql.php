<?php
namespace sql;
class options 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $option_cat = array('type' => 'varchar@50', 'label' => 'option_cat');
	public $option_name = array('type' => 'varchar@50', 'label' => 'option_name');
	public $option_value = array('type' => 'varchar@200', 'label' => 'option_value');
	public $option_value_extra = array('type' => 'varchar@255', 'label' => 'option_value_extra');
	public $option_status = array('type' => 'enum@active,deactive!active', 'label' => 'option_status');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


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