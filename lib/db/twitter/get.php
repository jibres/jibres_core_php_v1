<?php
namespace lib\db\twitter;

class get
{

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM twitter WHERE twitter.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true, 'api_log');
		return $result;
	}

}
?>