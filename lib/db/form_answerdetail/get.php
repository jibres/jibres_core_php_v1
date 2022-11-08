<?php
namespace lib\db\form_answerdetail;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}





	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.form_id = $_form_id AND form_answerdetail.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;

	}




	public static function by_items_id_answer($_item_ids, $_answer)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.item_id IN ($_item_ids) AND form_answerdetail.answer IN ('$_answer') LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function check_inquiry_answer($_item_ids, $_answer)
	{
		$query =
		"
			SELECT
				form_answerdetail.*
			FROM
				form_answerdetail
			INNER JOIN form_answer ON form_answer.id = form_answerdetail.answer_id
			WHERE
				form_answer.status != 'deleted' AND
				form_answerdetail.item_id IN ($_item_ids) AND
				form_answerdetail.answer IN ('$_answer')
			LIMIT 1
		";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function by_item_id_answer($_item_id, $_answer)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.item_id = $_item_id AND form_answerdetail.answer = '$_answer' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function by_item_id($_item_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.item_id = $_item_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function get_where($_args)
	{
		$q  = \dash\pdo\prepare_query::generate_where('form_answerdetail', $_args);

		$query  = "SELECT * FROM form_answerdetail WHERE $q[where] LIMIT 1 ";
		$param  = $q['param'];
		$result = \dash\pdo::get($query, $param, null, true);

		return $result;

	}

	public static function check_duplicate_answer($_args)
	{
		$q  = \dash\pdo\prepare_query::generate_where('form_answerdetail', $_args);

		$query  =
		"
			SELECT
				form_answerdetail.*
			FROM
				form_answerdetail
			INNER JOIN form_answer ON form_answer.id = form_answerdetail.answer_id
			WHERE
				form_answer.status != 'deleted' AND
				$q[where]
			LIMIT 1 ";
		$param  = $q['param'];
		$result = \dash\pdo::get($query, $param, null, true);

		return $result;

	}






	public static function count_answer_item_id($_form_id, $_item_id)
	{
		$query =
		"
			SELECT
				COUNT(DISTINCT form_answerdetail.answer_id) AS `count`
			FROM
				form_answerdetail
			WHERE
				form_answerdetail.form_id = $_form_id AND
				form_answerdetail.item_id = $_item_id
		";

		$result = \dash\pdo::get($query, [], 'count', true);

		return $result;

	}



	public static function chart_pie_birthdate($_form_id, $_item_id)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUBSTRING(form_answerdetail.answer, 1, 4) AS `answer`
			FROM
				form_answerdetail
			WHERE
				form_answerdetail.form_id = $_form_id AND
				form_answerdetail.item_id = $_item_id
			GROUP BY SUBSTRING(form_answerdetail.answer, 1, 4)
			ORDER BY SUBSTRING(form_answerdetail.answer, 1, 4) DESC
		";

		$result = \dash\pdo::get($query);
		return $result;

	}

	public static function chart_pie($_form_id, $_item_id)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				form_answerdetail.answer
			FROM
				form_answerdetail
			WHERE
				form_answerdetail.form_id = $_form_id AND
				form_answerdetail.item_id = $_item_id
			GROUP BY form_answerdetail.answer
			ORDER BY COUNT(*) DESC
		";

		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function chart_wordcloud($_form_id, $_item_id)
	{
		$query =
		"
			SELECT
				IFNULL(form_answerdetail.answer, form_answerdetail.textarea) AS `answer`
			FROM
				form_answerdetail
			WHERE
				form_answerdetail.form_id = $_form_id AND
				form_answerdetail.item_id = $_item_id
		";

		$result = \dash\pdo::get($query, [], 'answer');
		return $result;
	}



	public static function advance_chart($_form_id, $_item1, $_item2, $_item3)
	{
		if($_item3)
		{
			$query =
			"
				SELECT
					count(*) AS `count`,
					myTable.q1,
					myTable.q2,
					myTable.q3
				FROM
				(
					SELECT
						form_answerdetail.answer_id,
					  	MAX(CASE WHEN form_answerdetail.item_id = $_item1 THEN IF(form_answerdetail.answer IS NULL, 0, CONCAT('4', form_answerdetail.answer)) END) 'q1',
					  	MAX(CASE WHEN form_answerdetail.item_id = $_item2 THEN IF(form_answerdetail.answer IS NULL, 0, CONCAT('5', form_answerdetail.answer)) END) 'q2',
					  	MAX(CASE WHEN form_answerdetail.item_id = $_item3 THEN IF(form_answerdetail.answer IS NULL, 0, CONCAT('6', form_answerdetail.answer)) END) 'q3'
					FROM
						form_answerdetail
					WHERE
						form_answerdetail.form_id = $_form_id
					GROUP BY
					form_answerdetail.answer_id
				)
				AS `myTable`
				GROUP BY myTable.q1, myTable.q2, myTable.q3
				ORDER BY myTable.q1, myTable.q2, myTable.q3
			";
		}
		else
		{
			$query =
			"
				SELECT
					count(*) AS `count`,
					myTable.q1,
					myTable.q2
				FROM
				(
					SELECT
						form_answerdetail.answer_id,
					  	MAX(CASE WHEN form_answerdetail.item_id = $_item1 THEN IF(form_answerdetail.answer IS NULL, 0, CONCAT('4', form_answerdetail.answer)) END) 'q1',
					  	MAX(CASE WHEN form_answerdetail.item_id = $_item2 THEN IF(form_answerdetail.answer IS NULL, 0, CONCAT('5', form_answerdetail.answer)) END) 'q2'
					FROM
						form_answerdetail
					WHERE
						form_answerdetail.form_id = $_form_id
					GROUP BY
					form_answerdetail.answer_id
				)
				AS `myTable`
				GROUP BY myTable.q1, myTable.q2
				ORDER BY myTable.q1, myTable.q2
			";
		}

		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function choise_id_used($_id)
	{
		$query =
			"
			SELECT
				*
			FROM
				form_answerdetail
			WHERE
				form_answerdetail.choice_id = :id 
			limit 1
		";
		$param = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}

}
?>
