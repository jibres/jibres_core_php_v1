<?php
namespace lib\db\sms_charge;

class search
{

	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM sms_charge $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit'], 'api_log');
		}

		$query =
		"
			SELECT
				sms_charge.*
			FROM
				sms_charge
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\pdo::get($query, $_param, null, false, 'api_log');

		return $result;
	}


}
?>