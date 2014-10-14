<?php
namespace sql;
class attachments 
{
	public $id = array('type' => 'int@10', 'label' => 'id');
	public $attachment_title = array('type' => 'varchar@100', 'label' => 'attachment_title');
	public $attachment_model = array('type' => 'enum@product_category,product,admin,bank_logo', 'label' => 'attachment_model');
	public $attachment_addr = array('type' => 'varchar@100', 'label' => 'attachment_addr');
	public $attachment_name = array('type' => 'varchar@50', 'label' => 'attachment_name');
	public $attachment_type = array('type' => 'varchar@10', 'label' => 'attachment_type');
	public $attachment_size = array('type' => 'float@12,0', 'label' => 'attachment_size');
	public $attachment_desc = array('type' => 'varchar@200', 'label' => 'attachment_desc');
	public $user_id = array('type' => 'smallint@5', 'label' => 'user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("#title")->name("attachment_title");
	}
	public function attachment_model() 
	{
		
	}
	public function attachment_addr() 
	{
		
	}
	public function attachment_name() 
	{
		
	}
	public function attachment_type() 
	{
		
	}
	public function attachment_size() 
	{
		
	}

	//------------------------------------------------------------------ description
	public function attachment_desc() 
	{
		$this->form("#desc")->name("attachment_desc");
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