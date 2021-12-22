<?php
namespace lib\db\form_answer;


class search
{

	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM form_answer $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				form_answer.*,
				(SELECT COUNT(*) FROM form_answerdetail WHERE form_answerdetail.answer_id = form_answer.id ) `count_answer`
			FROM form_answer
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\pdo::get($query);


		return $result;

	}
}
?>