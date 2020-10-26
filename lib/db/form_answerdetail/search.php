<?php
namespace lib\db\form_answerdetail;


class search
{




	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM form_answerdetail $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				form_item.title AS `item_title`,
				form_item.type AS `item_type`,
				form_answerdetail.*
			FROM form_answerdetail
			LEFT JOIN form_item ON form_item.id = form_answerdetail.item_id
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);
		return $result;

	}


	public static function list_count($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);


		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM form_answerdetail
			LEFT JOIN form_item ON form_item.id = form_answerdetail.item_id
			$q[join]
			$q[where]
			$q[order]
		";

		$result = \dash\db::get($query, 'count', true);
		return $result;

	}
}
?>