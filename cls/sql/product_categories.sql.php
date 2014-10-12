<?php
namespace sql;
class product_categories {
	public $id = array('type' => 'smallint@5', 'label' => 'product_categories_id');
	public $pcat_title = array('type' => 'varchar@50', 'label' => 'product_categories_pcat_title');
	public $pcat_slug = array('type' => 'varchar@50', 'label' => 'product_categories_pcat_slug');
	public $pcat_desc = array('type' => 'varchar@200', 'label' => 'product_categories_pcat_desc');
	public $pcat_father = array('type' => 'smallint@5', 'label' => 'product_categories_pcat_father');
	public $attachment_id = array('type' => 'int@10', 'label' => 'product_categories_attachment_id');
	public $pcat_row = array('type' => 'smallint@5', 'label' => 'product_categories_pcat_row');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'product_categories_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'product_categories_date_modified');

	public function id(){}
	public function pcat_title(){}
	public function pcat_slug(){}
	public function pcat_desc(){}
	public function pcat_father(){}
	public function attachment_id(){}
	public function pcat_row(){}
	public function date_created(){}
	public function date_modified(){}
}
?>