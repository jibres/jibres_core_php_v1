<?php
namespace lib\db\form_load;


class delete
{

	public static function record($_id)
	{
		$query = "DELETE FROM form_load WHERE form_load.id = $_id  LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

}
