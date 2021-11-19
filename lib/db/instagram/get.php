<?php
namespace lib\db\instagram;

class get
{

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM instagram WHERE instagram.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}



	public static function by_token_type($_token, $_type, $_fuel, $_database)
	{
		$query  = "SELECT * FROM instagram WHERE instagram.token = :token AND instagram.type = :type AND instagram.status = 'enable' ORDER BY instagram.id DESC LIMIT 1 ";
		$param  =
		[
			':token' => $_token,
			':type'  => $_type,
		];

		$result = \dash\pdo::get($query, $param, null, true, $_fuel, ['database' => $_database]);
		return $result;
	}






}
?>