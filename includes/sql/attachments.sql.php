<?php
namespace sql;
class attachments 
{
	public $id = array('type' => 'int@10', 'label' => 'ID');
	public $attachment_title = array('type' => 'varchar@100', 'label' => 'Title');
	public $attachment_model = array('type' => 'enum@product_category,product,admin,bank_logo', 'label' => 'Model');
	public $attachment_addr = array('type' => 'varchar@100', 'label' => 'Addr');
	public $attachment_name = array('type' => 'varchar@50', 'label' => 'Name');
	public $attachment_type = array('type' => 'varchar@10', 'label' => 'Type');
	public $attachment_size = array('type' => 'float@12,0', 'label' => 'Size');
	public $attachment_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $user_id = array('type' => 'smallint@5', 'label' => 'User Id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("#title");
	}

	//------------------------------------------------------------------ select button
	public function attachment_model() 
	{
		$this->form("select")->name("Model")->validate();
		$this->setChild($this->form);
	}
	public function attachment_addr() 
	{
		$this->form()->name("Addr");
	}
	public function attachment_name() 
	{
		$this->form()->name("Name");
	}

	//------------------------------------------------------------------ select button
	public function attachment_type() 
	{
		$this->form("select")->name("Type")->validate();
		$this->setChild($this->form);
	}
	public function attachment_size() 
	{
		$this->form()->name("Size");
	}

	//------------------------------------------------------------------ description
	public function attachment_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("select")->name("Id")->validate("id");
		$this->setChild($this->form);
	}
	public function date_created() {}
	public function date_modified() {}
}
?>