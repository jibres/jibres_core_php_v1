<?php
namespace lib\db\form_answer;


class get
{

	public static function is_answered_factor_id($_factor_id)
	{
		$query =
		"
			SELECT
				form_answer.*,
				form.title
			FROM
				form_answer
			INNER JOIN form ON form.id = form_answer.form_id
			WHERE
				form_answer.factor_id = :factor_id
		";
		$param =
		[
			':factor_id' => $_factor_id,
		];

		$result = \dash\pdo::get($query, $param);
		return $result;

	}


	public static function is_answered_form_factor_id($_form_id, $_factor_id)
	{
		$query = "SELECT * FROM form_answer WHERE form_answer.form_id = :form_id AND form_answer.factor_id = :factor_id LIMIT 1";
		$param =
		[
			':form_id'   => $_form_id,

			':factor_id' => $_factor_id,
		];

		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}

	public static function need_review_form()
	{
		$query = "SELECT COUNT(*) AS `count`, form_answer.form_id FROM form_answer WHERE form_answer.review IS NULL GROUP BY form_answer.form_id";
		$result = \dash\pdo::get($query);
		return $result;

	}


	public static function need_review_form_id($_form_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM form_answer WHERE form_answer.form_id = $_form_id AND form_answer.review IS NULL ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function user_answer($_answer_id)
	{
		$result                  = [];
		$query                   = "SELECT * FROM form_answer WHERE form_answer.id = $_answer_id LIMIT 1";
		$result['answer']        = \dash\pdo::get($query, [], null, true);

		$query                   = "SELECT * FROM form_answerdetail WHERE form_answerdetail.answer_id = $_answer_id ";
		$result['answer_detail'] = \dash\pdo::get($query);

		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_answer WHERE form_answer.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function count_all($_form_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM form_answer WHERE form_answer.form_id = $_form_id";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}



	public static function by_form_id($_form_id)
	{
		$query = "SELECT * FROM form_answer WHERE form_answer.form_id = $_form_id ORDER BY IFNULL(form_answer.sort, form_answer.id) ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_answer WHERE form_answer.form_id = $_form_id AND form_answer.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;

	}

	public static function count_by_form_id($_form_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM form_answer WHERE form_answer.form_id = $_form_id ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}



	public static function export_list($_form_id, $_start_limit = 0, $_end_limit = 50)
	{
		unset($result);
		unset($answer_id);

		$result = [];

		$query =
		"
			SELECT
				*
			FROM
				form_answer
			WHERE
				form_answer.form_id = $_form_id
			LIMIT $_start_limit, $_end_limit
		";

		$result['answer'] = \dash\pdo::get($query);

		if(is_array($result['answer']))
		{
			$answer_id = array_column($result['answer'], 'id');
			$answer_id = array_filter($answer_id);
			$answer_id = array_unique($answer_id);
			if($answer_id)
			{
				$answer_id = implode(',', $answer_id);
				$query =
				"
					SELECT
						*
					FROM
						form_answerdetail
					WHERE
						form_answerdetail.form_id = $_form_id AND
						form_answerdetail.answer_id IN ($answer_id)
				";

				$result['answerdetail'] = \dash\pdo::get($query);
			}
		}


		$query =
		"
			SELECT
				form_item.*
			FROM
				form_item
			WHERE
				form_item.form_id = $_form_id
			ORDER BY IFNULL(form_item.sort, form_item.id) ASC
		";

		$result['items'] = \dash\pdo::get($query);


		$query =
		"
			SELECT
				form_choice.*
			FROM
				form_choice
			WHERE
				form_choice.form_id = $_form_id
		";

		$result['choice'] = \dash\pdo::get($query);

		return $result;

	}


}
?>
