<?php
namespace sql;
class productcats 
{
	public $id = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'ID');
	public $productcat_title = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Title');
	public $productcat_slug = array('type' => 'varchar@50', 'null' =>'NO' ,'label' => 'Slug');
	public $productcat_desc = array('type' => 'varchar@200', 'null' =>'YES' ,'label' => 'Description');
	public $productcat_father = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Father');
	public $attachment_id = array('type' => 'int@10', 'null' =>'YES' ,'label' => 'Attachment', 'foreign' => 'attachments@id!attachment_title');
	public $productcat_row = array('type' => 'smallint@5', 'null' =>'NO' ,'label' => 'Row');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function productcat_title() 
	{
		$this->form("text")->name("title");
	}

	//------------------------------------------------------------------ slug
	public function productcat_slug() 
	{
		$this->form("text")->name("slug")->validate()->slugify("productcat_title");
	}

	//------------------------------------------------------------------ description
	public function productcat_desc() 
	{
		$this->form("#desc");
	}
	public function productcat_father() 
	{
		$this->form("text")->name("father");
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("#foreignkey")->name("attachment")->validate("id");
	}
	public function productcat_row() 
	{
		$this->form("text")->name("row");
	}
	public function date_modified() {}
}
?>