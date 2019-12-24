<?php
namespace lib\db\factors;

class get
{


	public static function by_id($_id)
	{
		$query = "SELECT * FROM factors WHERE factors.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
