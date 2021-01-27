<?php
namespace lib\db\sms_log;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM sms_log $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				sms_log.*
			FROM
				sms_log
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}

	public static function conversation_list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(child.mobile) AS `count` FROM (SELECT sms_log.mobile AS `mobile` FROM sms_log $q[join] $q[where] GROUP BY sms_log.mobile) AS `child` ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				sms_log.mobile,
				MAX(sms_log.datecreated) AS `lastdate`
			FROM
				sms_log
			$q[join]
			$q[where]
			GROUP BY sms_log.mobile
			$limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}




}
?>