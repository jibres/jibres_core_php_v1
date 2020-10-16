<?php
namespace lib\db\store_analytics;


class get
{




	public static function average_creating_time()
	{

		$query =
		"
			SELECT
				AVG(store_timeline.startcreate_diff) AS `avg`,
				MAX(store_timeline.startcreate_diff) AS `max`,
				MIN(store_timeline.startcreate_diff) AS `min`
			FROM
				store_timeline
			WHERE
				store_timeline.store_id IS NOT NULL
		";
		$result = \dash\db::get($query, null, true, 'master');

		return $result;
	}
}
?>