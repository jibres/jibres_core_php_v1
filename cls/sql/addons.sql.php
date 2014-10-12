<?php
namespace sql;
class addons {
	public $id = array('type' => 'smallint@5', 'label' => 'addons_id');
	public $addon_name = array('type' => 'varchar@50', 'label' => 'addons_addon_name');
	public $addon_slug = array('type' => 'varchar@50', 'label' => 'addons_addon_slug');
	public $addon_desc = array('type' => 'varchar@999', 'label' => 'addons_addon_desc');
	public $addon_status = array('type' => 'enum@active,deactive,expire,going_to_expire!deactive', 'label' => 'addons_addon_status');
	public $addon_expire = array('type' => 'datetime@', 'label' => 'addons_addon_expire');
	public $addon_installdate = array('type' => 'datetime@', 'label' => 'addons_addon_installdate');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'addons_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'addons_date_modified');

	public function id(){}
	public function addon_name(){}
	public function addon_slug(){}
	public function addon_desc(){}
	public function addon_status(){}
	public function addon_expire(){}
	public function addon_installdate(){}
	public function date_created(){}
	public function date_modified(){}
}
?>