<?php
namespace lib\db\kavenegar;

class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM kavenegar WHERE kavenegar.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'api_log');
		return $result;
	}

}
?>