<?php
namespace sql;
class attachments {
	public $id = array('type' => 'int@10', 'label' => 'attachments_id');
	public $attachment_title = array('type' => 'varchar@100', 'label' => 'attachments_attachment_title');
	public $attachment_model = array('type' => 'enum@product_category,product,admin,bank_logo', 'label' => 'attachments_attachment_model');
	public $attachment_addr = array('type' => 'varchar@100', 'label' => 'attachments_attachment_addr');
	public $attachment_name = array('type' => 'varchar@50', 'label' => 'attachments_attachment_name');
	public $attachment_type = array('type' => 'varchar@10', 'label' => 'attachments_attachment_type');
	public $attachment_size = array('type' => 'float@12,0', 'label' => 'attachments_attachment_size');
	public $attachment_desc = array('type' => 'varchar@200', 'label' => 'attachments_attachment_desc');
	public $user_id = array('type' => 'smallint@5', 'label' => 'attachments_user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'attachments_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'attachments_date_modified');

	public function id(){}
	public function attachment_title(){}
	public function attachment_model(){}
	public function attachment_addr(){}
	public function attachment_name(){}
	public function attachment_type(){}
	public function attachment_size(){}
	public function attachment_desc(){}
	public function user_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>