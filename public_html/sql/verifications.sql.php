<?php
namespace sql;
class verifications {
	public $id = array('type' => 'smallint@5', 'label' => 'verifications_id');
	public $verification_type = array('type' => 'enum@register_by_email,register_by_mobile,forget,change_email,change_mobile', 'label' => 'verifications_verification_type');
	public $verification_email = array('type' => 'varchar@50', 'label' => 'verifications_verification_email');
	public $verification_code = array('type' => 'varchar@32', 'label' => 'verifications_verification_code');
	public $user_id = array('type' => 'smallint@5', 'label' => 'verifications_user_id');
	public $verification_verified = array('type' => 'enum@yes,no!no', 'label' => 'verifications_verification_verified');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'verifications_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'verifications_date_modified');

	public function id(){}
	public function verification_type(){}
	public function verification_email(){}
	public function verification_code(){}
	public function user_id(){}
	public function verification_verified(){}
	public function date_created(){}
	public function date_modified(){}
}
?>