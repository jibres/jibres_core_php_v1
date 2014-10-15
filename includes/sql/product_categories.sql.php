<?php
namespace sql;
class product_categories 
{
	public $id = array('type' => 'smallint@5', 'label' => 'ID');
	public $pcat_title = array('type' => 'varchar@50', 'label' => 'Title');
	public $pcat_slug = array('type' => 'varchar@50', 'label' => 'Slug');
	public $pcat_desc = array('type' => 'varchar@200', 'label' => 'Description');
	public $pcat_father = array('type' => 'smallint@5', 'label' => 'Father');
	public $attachment_id = array('type' => 'int@10', 'label' => 'Attachment Id');
	public $pcat_row = array('type' => 'smallint@5', 'label' => 'Row');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'Date Created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate("id");}

	//------------------------------------------------------------------ title
	public function pcat_title() 
	{
		$this->form("#title")->name("Title")->validate();
	}

	//------------------------------------------------------------------ slug
	public function pcat_slug() 
	{
		$this->form("#slug")->name("Slug")->validate();->createslug(function()	{$this->value =\validator_lib::$save['form']['pcat_title']->value
	}

	//------------------------------------------------------------------ description
	public function pcat_desc() 
	{
		$this->form("#desc")->name("Desc")->validate();
	}
	public function pcat_father() 
	{
		$this->form()->name("Father")
		->validate();
	}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->validate("id");
	}
	public function pcat_row() 
	{
		$this->form()->name("Row")
		->validate();
	}
	public function date_created() {}
	public function date_modified() {}
}
?>