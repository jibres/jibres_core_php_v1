<?php
namespace lib\db\kavenegar;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM kavenegar $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit'], 'api_log');
		}

		$query =
		"
			SELECT
				kavenegar.*
			FROM
				kavenegar
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query, null, false, 'api_log');

		return $result;
	}



}
?>