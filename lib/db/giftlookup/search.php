<?php
namespace lib\db\giftlookup;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM giftlookup $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}
		elseif($q['limit'])
		{
			$limit = "LIMIT $q[limit]";
		}

		$query = "SELECT * FROM giftlookup $q[where] $q[order] $limit ";

		$result = \dash\db::get($query, null, false);

		return $result;
	}




}
?>