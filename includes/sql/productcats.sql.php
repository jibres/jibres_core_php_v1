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
	public $productcat_row = array('type' => 'smallint@5', 'null' =>'YES' ,'label' => 'Row');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function productcat_title() 
	{
		$this->form("text")->name("title")->required()->maxlength(50);
	}

	//------------------------------------------------------------------ slug
	public function productcat_slug() 
	{
		$this->form("text")->name("slug")->required()->maxlength(50)->validate()->slugify("productcat_title");
	}

	//------------------------------------------------------------------ description
	public function productcat_desc() 
	{
		$this->form("#desc")->maxlength(200);
	}
	public function productcat_father() 
	{
		$this->form("text")->name("father")->min(0)->max(9999);
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment")->min(0)->max(999999999)->validate("id");
		$this->setChild($this->form);
	}
	public function productcat_row() 
	{
		$this->form("text")->name("row")->min(0)->max(9999);
	}
	public function date_modified() {}
}
?>