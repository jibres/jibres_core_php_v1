<?php
namespace sql;
class accounts {
	public $id = array('type' => 'smallint@5', 'label' => 'accounts_id');
	public $account_title = array('type' => 'varchar@50', 'label' => 'accounts_account_title');
	public $account_slug = array('type' => 'varchar@50', 'label' => 'accounts_account_slug');
	public $bank_id = array('type' => 'smallint@5', 'label' => 'accounts_bank_id');
	public $account_branch_name = array('type' => 'varchar@50', 'label' => 'accounts_account_branch_name');
	public $account_number = array('type' => 'varchar@50', 'label' => 'accounts_account_number');
	public $account_card_number = array('type' => 'varchar@30', 'label' => 'accounts_account_card_number');
	public $account_primarybalance = array('type' => 'decimal@14,4!0.0000', 'label' => 'accounts_account_primarybalance');
	public $account_desc = array('type' => 'varchar@200', 'label' => 'accounts_account_desc');
	public $user_id = array('type' => 'smallint@5', 'label' => 'accounts_user_id');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'accounts_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'accounts_date_modified');

	public function id(){}
	public function account_title(){}
	public function account_slug(){}
	public function bank_id(){}
	public function account_branch_name(){}
	public function account_number(){}
	public function account_card_number(){}
	public function account_primarybalance(){}
	public function account_desc(){}
	public function user_id(){}
	public function date_created(){}
	public function date_modified(){}
}
?>