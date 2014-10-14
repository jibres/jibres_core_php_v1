<?php
class query_username_cls extends query_cls
{
	public function set() {
		$year = "393";
		$isset_key = $this->sql()->tableBranch_users_key()->wherePkey($year)->limit(1)->select();
		if($isset_key->num() == 0) {
			$this->sql()->tableBranch_users_key()->setPkey($year)->setKey("1")->insert();
			
		}else{
			$new_key = intval($isset_key->assoc("key"));
			$new_key++;
			$this->sql()->tableBranch_users_key()->setKey($new_key)->wherePkey($year)->update();
		}
		$ret = $this->sql()->tableBranch_users_key()->wherePkey($year)->limit(1)->select()->assoc();
		return $ret['pkey']. $ret['key'];
	}

	public function get($users_id =false) {
		$us = $this->sql()->tablePerson()->whereUsers_id($users_id)->limit(1)->select()->assoc();
		return $us['name'] . ' ' . $us['family'];
	}

}
?>