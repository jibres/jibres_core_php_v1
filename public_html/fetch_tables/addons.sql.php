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
	public function id() {$this->validate(".id");}
	public function addon_name() 
	{
		
	}

	//------------------------------------------------------------------ slug
	public function addon_slug() 
	{
		$this->form("#slug")->name("addon_slug");
	}

	//------------------------------------------------------------------ description
	public function addon_desc() 
	{
		$this->form("#desc")->name("addon_desc");
	}
	public function addon_status() 
	{
		$this->form("select")->name("addon_status")->label("addon_status");
		$this->setChild();
	}
	public function addon_expire() 
	{
		
	}
	public function addon_installdate() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>