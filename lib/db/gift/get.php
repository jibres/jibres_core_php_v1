<?php
namespace lib\db\gift;


class get
{
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM gift WHERE gift.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_code($_code)
	{
		$query  = "SELECT * FROM gift WHERE gift.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>