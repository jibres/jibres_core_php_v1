<?php
namespace lib\db\form_load;


class get
{



	public static function get($_id)
	{
		$query = "SELECT * FROM form_load WHERE form_load.id = $_id  LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

}
