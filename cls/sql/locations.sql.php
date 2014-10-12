<?php
namespace sql;
class locations {
	public $id = array('type' => 'smallint@5', 'label' => 'locations_id');
	public $location_title = array('type' => 'varchar@100', 'label' => 'locations_location_title');
	public $location_slug = array('type' => 'varchar@100', 'label' => 'locations_location_slug');
	public $location_desc = array('type' => 'varchar@200', 'label' => 'locations_location_desc');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'locations_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'locations_date_modified');

	public function id(){}
	public function location_title(){}
	public function location_slug(){}
	public function location_desc(){}
	public function date_created(){}
	public function date_modified(){}
}
?>