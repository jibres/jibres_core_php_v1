<?php
namespace sql;
class product_categories 
{
	public $id = array('type' => 'smallint@5', 'label' => 'id');
	public $pcat_title = array('type' => 'varchar@50', 'label' => 'pcat_title');
	public $pcat_slug = array('type' => 'varchar@50', 'label' => 'pcat_slug');
	public $pcat_desc = array('type' => 'varchar@200', 'label' => 'pcat_desc');
	public $pcat_father = array('type' => 'smallint@5', 'label' => 'pcat_father');
	public $attachment_id = array('type' => 'int@10', 'label' => 'attachment_id');
	public $pcat_row = array('type' => 'smallint@5', 'label' => 'pcat_row');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'date_modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function pcat_title() 
	{
		$this->form("title")->name("pcat_title");
	}

	//------------------------------------------------------------------ slug
	public function pcat_slug() 
	{
		$this->form("slug")->name("pcat_slug");
	}

	//------------------------------------------------------------------ description
	public function pcat_desc() 
	{
		$this->form("desc")->name("pcat_desc");
	}
	public function pcat_father() 
	{
		
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->validate("id");
	}
	public function pcat_row() 
	{
		
	}
	public function date_created() {};
	public function date_modified() {};
}
?>