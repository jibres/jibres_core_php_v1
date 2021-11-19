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




}
?>