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
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'null' =>'NO' ,'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'null' =>'NO' ,'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function pcat_title() 
	{
		$this->form("#title");
	}

	//------------------------------------------------------------------ slug
	public function pcat_slug() 
	{
		$this->form("#slug");
	}

	//------------------------------------------------------------------ description
	public function pcat_desc() 
	{
		$this->form("#desc");
	}
	public function pcat_father() 
	{
		$this->form()->name("father");
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("#foreignkey")->name("attachment")->validate("id");
	}
	public function pcat_row() 
	{
		$this->form()->name("row");
	}
	public function date_created() {}
	public function date_modified() {}
}
?>