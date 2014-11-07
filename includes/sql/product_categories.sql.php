<?php
namespace sql;
class product_categories 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $pcat_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $pcat_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $pcat_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $pcat_father = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Father');
	public $attachment_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Attachment');
	public $pcat_row = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Row');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function pcat_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function pcat_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("pcat_title");
	}

	//------------------------------------------------------------------ description
	public function pcat_desc() 
	{
		$this->form("#desc");
	}
	public function pcat_father() 
	{
		$this->form("text")->name("father");
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("#foreignkey")->name("attachment")->validate("id");
	}
	public function pcat_row() 
	{
		$this->form("text")->name("row");
	}
	public function date_modified() {}
}
?>