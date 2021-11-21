<?php
namespace lib\db\instagram;

class get
{

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM instagram WHERE instagram.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true, 'api_log');
		return $result;
	}



	public static function by_token($_token)
	{
		$query  = "SELECT * FROM instagram WHERE instagram.token = :token  AND instagram.status = 'enable' ORDER BY instagram.id DESC LIMIT 1 ";
		$param  =
		[
			':token' => $_token,
		];

		$result = \dash\pdo::get($query, $param, null, true, 'api_log');
		return $result;
	}






}
?>