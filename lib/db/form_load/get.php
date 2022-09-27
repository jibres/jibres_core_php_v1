<?php
namespace lib\db\form_load;


class get
{


	public static function get($_id)
	{
		$query  = "SELECT * FROM form_load WHERE form_load.id = :id  LIMIT 1";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_token($_token)
	{
		$query  = "SELECT * FROM form_load WHERE form_load.token = :token  LIMIT 1";
		$param  = [':token' => $_token];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}

}
