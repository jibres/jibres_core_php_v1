<?php
namespace sql;
class attachments 
{
	public $id = array('type' => 'int@10', 'label' => 'd');
	public $attachment_title = array('type' => 'varchar@100', 'label' => 'title');
	public $attachment_model = array('type' => 'enum@product_category,product,admin,bank_logo', 'label' => 'model');
	public $attachment_addr = array('type' => 'varchar@100', 'label' => 'addr');
	public $attachment_name = array('type' => 'varchar@50', 'label' => 'name');
	public $attachment_type = array('type' => 'varchar@10', 'label' => 'type');
	public $attachment_size = array('type' => 'float@12,0', 'label' => 'size');
	public $attachment_desc = array('type' => 'varchar@200', 'label' => 'desc');
	public $user_id = array('type' => 'smallint@5', 'label' => 'id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("#title")->name("title")->validate();
	}
	public function attachment_model() 
	{
		$this->form()->name("model")
		->validate();
	}
	public function attachment_addr() 
	{
		$this->form()->name("addr")
		->validate();
	}
	public function attachment_name() 
	{
		$this->form()->name("name")
		->validate();
	}
	public function attachment_type() 
	{
		$this->form()->name("type")
		->validate();
	}
	public function attachment_size() 
	{
		$this->form()->name("size")
		->validate();
	}

	//------------------------------------------------------------------ description
	public function attachment_desc() 
	{
		$this->form("#desc")->name("desc")->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->validate("id");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>