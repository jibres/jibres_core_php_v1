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
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit']);
		}
		elseif($q['limit'])
		{
			$limit = "LIMIT $q[limit]";
		}

		$query =
		"
			SELECT
				giftlookup.*,
				users.mobile,
				users.displayname,
				users.avatar,
				users.gender
			FROM
				giftlookup
			LEFT JOIN users ON users.id = giftlookup.user_id
			$q[where] $q[order] $limit
		";


		$result = \dash\pdo::get($query, [], null, false);

		return $result;
	}




}
?>