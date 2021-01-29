<?php
namespace dash\db\telegrams;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		if($q['pagination'] === false)
		{
			if($q['limit'])
			{
				$limit = "LIMIT $q[limit] ";
			}
			else
			{
				$limit = "LIMIT 100 ";
			}
		}
		else
		{
			$pagination_query = "SELECT COUNT(*) AS `count` FROM telegrams $q[join] $q[where]  ";
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query = "SELECT $q[fields] FROM telegrams $q[join] $q[where] $q[order] $limit ";
		$result = \dash\db::get($query);

		return $result;
	}


	public static function conversation_list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(child.chatid) AS `count` FROM (SELECT telegrams.chatid AS `chatid` FROM telegrams $q[join] $q[where] GROUP BY telegrams.chatid) AS `child` ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				telegrams.chatid,
				MAX(telegrams.senddate) AS `lastdate`
			FROM
				telegrams
			$q[join]
			$q[where]
			GROUP BY telegrams.chatid
			$limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}

}
?>