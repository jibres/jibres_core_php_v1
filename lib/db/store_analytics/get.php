<?php
namespace lib\db\store_analytics;


class get
{



	public static function summary($_fields)
	{
		$select = [];
		foreach ($_fields as $key => $value)
		{
			$select[] =
			"
				SUM(store_analytics.$key) AS `sum_$key`,
				MAX(store_analytics.$key) AS `max_$key`,
				MIN(store_analytics.$key) AS `min_$key`,
				AVG(store_analytics.$key) AS `avg_$key`
			";
		}

		$select = implode(',', $select);

		$query =
		"
			SELECT
				$select
			FROM
				store_analytics
		";
		$result = \dash\db::get($query, null, true, 'master');

		return $result;
	}




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





	public static function chart_question($_index)
	{

		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				store_analytics.question$_index AS `q`
			FROM
				store_analytics
			WHERE store_analytics.question$_index IS NOT NULL
			GROUP BY store_analytics.question$_index
		";

		$result = \dash\db::get($query, ['q', 'count'], true, 'master');
		return $result;
	}


	public static function answer_question()
	{

		$result = [];
		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				store_analytics
		";

		$result['total'] = \dash\db::get($query, 'count', true, 'master');

		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				store_analytics
			WHERE
				store_analytics.question1 IS NOT NULL AND
				store_analytics.question2 IS NOT NULL AND
				store_analytics.question3 IS NOT NULL
		";

		$result['answer_all'] = \dash\db::get($query, 'count', true, 'master');

		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				store_analytics
			WHERE
				store_analytics.question1 IS NULL AND
				store_analytics.question2 IS NULL AND
				store_analytics.question3 IS NULL
		";

		$result['skip_all'] = \dash\db::get($query, 'count', true, 'master');


		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				store_analytics
			WHERE
				store_analytics.question1 IS NOT NULL OR
				store_analytics.question2 IS NOT NULL OR
				store_analytics.question3 IS NOT NULL
		";

		$result['som_answer'] = \dash\db::get($query, 'count', true, 'master');

		return $result;
	}


}
?>