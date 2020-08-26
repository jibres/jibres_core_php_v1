<?php
namespace lib\db\form;


class search
{
	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM form $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				form.*,
				(SELECT COUNT(*) FROM form_item WHERE form_item.form_id = form.id) AS `item_count`,
				(SELECT COUNT(*) FROM form_answer WHERE form_answer.form_id = form.id) AS `answer_count`
			FROM form
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);


		return $result;

	}
}
?>