<?php
namespace sql;
class attachments 
{
	public $id = array('type' => 'int@10', 'null' =>'NO' ,'label' => 'ID');
	public $attachment_title = array('type' => 'varchar@100', 'null' =>'YES' ,'label' => 'Title');
	public $attachment_model = array('type' => 'enum@product_category,product,admin,bank_logo', 'null' =>'NO' ,'label' => 'Model');
	public $attachment_addr = array('type' => 'varchar@100', 'null' =>'NO' ,'label' => 'Addr');
	public $attachment_name = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Name');
	public $attachment_type = array('type' => 'varchar@10', 'null' =>'NO' ,'label' => 'Type');
	public $attachment_size = array('type' => 'float@12,0', 'null' =>'NO' ,'label' => 'Size');
	public $attachment_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $user_id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'User');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ select button
	public function attachment_model() 
	{
		$this->form("select")->name("model")->validate();
		$this->setChild($this->form);
	}
	public function attachment_addr() 
	{
		$this->form("text")->name("addr");
	}
	public function attachment_name() 
	{
		$this->form("text")->name("name");
	}

	//------------------------------------------------------------------ select button
	public function attachment_type() 
	{
		$this->form("select")->name("type")->validate();
		$this->setChild($this->form);
	}
	public function attachment_size() 
	{
		$this->form("text")->name("size");
	}

	//------------------------------------------------------------------ description
	public function attachment_desc() 
	{
		$this->form("#desc");
	}

	//------------------------------------------------------------------ id - foreign key
	public function user_id() 
	{
		$this->form("#foreignkey")->name("user")->validate("id");
	}
	public function date_modified() {}
}
?>