<?php
namespace lib\db\form_answer;


class get
{

	public static function form_id_from_answer_id($_answer_id)
	{
		$query =
		"
			SELECT
				form_answer.form_id AS `form_id`
			FROM
				form_answer
			WHERE
				form_answer.id = :id
		";
		$param =
		[
			':id' => $_answer_id,
		];

		$result = \dash\pdo::get($query, $param, 'form_id', true);
		return $result;
	}

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


	public static function count_all_where($_form_id, $_args = [])
	{
		$param = [];

		$startdate = '';

		if(isset($_args['startdate']) && $_args['startdate'])
		{
			$startdate           = ' AND form_answer.datecreated >= :startdate ';
			$param[':startdate'] = $_args['startdate'];
		}

		$enddate = '';

		if(isset($_args['enddate']) && $_args['enddate'])
		{
			$enddate           = ' AND form_answer.datecreated <= :enddate ';
			$param[':enddate'] = $_args['enddate'];
		}

		$tag_id   = '';
		$tag_join = '';

		if(isset($_args['tag_id']) && $_args['tag_id'])
		{
			$tag_join         = ' INNER JOIN form_tagusage ON form_tagusage.answer_id = form_answer.id ';
			$tag_id           = ' AND form_tagusage.form_tag_id = :tag_id ';
			$param[':tag_id'] = $_args['tag_id'];
		}


		$param[':id'] = $_form_id;

		$query =
		"
			SELECT COUNT(*) AS `count`

			FROM
				form_answer
				$tag_join
			WHERE
				 form_answer.form_id = :id
				 $startdate
				 $enddate
				 $tag_id
		";

		$result = \dash\pdo::get($query, $param, 'count', true);

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



	public static function export_list($_form_id, $_start_limit = 0, $_end_limit = 50, $_args = [])
	{
		unset($result);
		unset($answer_id);

		$result = [];

		$where = [];
		$param = [];
		$join  = '';

		if($_args)
		{
			if(isset($_args['startdate']) && $_args['startdate'])
			{
				$where[] = " form_answer.datecreated >= :startdate ";
				$param[':startdate'] = $_args['startdate'];
			}

			if(isset($_args['enddate']) && $_args['enddate'])
			{
				$where[] = " form_answer.datecreated <= :enddate ";
				$param[':enddate'] = $_args['enddate'];
			}

			if(isset($_args['tag_id']) && $_args['tag_id'])
			{
				$where[]          = " form_tagusage.form_tag_id = :tag_id ";
				$join             = ' INNER JOIN form_tagusage ON form_answer.id = form_tagusage.answer_id ';
				$param[':tag_id'] = $_args['tag_id'];
			}


		}

		if($where)
		{
			$where = ' AND '. implode(' AND ', $where);
		}
		else
		{
			$where = '';
		}

		$query =
		"
			SELECT
				form_answer.*
			FROM
				form_answer
				$join
			WHERE
				form_answer.form_id = $_form_id
				$where
			LIMIT $_start_limit, $_end_limit
		";

		$result['answer'] = \dash\pdo::get($query, $param);


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

	public static function by_answer_id_form_id_item_id($_form_id, $_answer_id, array $_singuped_mobile_item)
	{
		$item_ids = implode(',', $_singuped_mobile_item);
		$query =
		"
			SELECT
				*
			FROM
				form_answerdetail
			WHERE
				form_answerdetail.form_id = :form_id AND
				form_answerdetail.answer_id = :answer_id AND
				form_answerdetail.item_id IN ($item_ids) 
		";
		$param =
		[
			':form_id' => $_form_id,
			':answer_id' => $_answer_id,
		];

		return \dash\pdo::get($query, $param);
	}


	public static function for_result_page($_form_id, $_answer_id, array $_allowShowItem)
	{
		if(!$_allowShowItem)
		{
			return false;
		}

		$item_ids = implode(',', $_allowShowItem);
		$query =
			"
			SELECT
				form_answerdetail.answer,
				form_answerdetail.item_id,
				form_item.title,
				form_item.type			
			FROM
				form_answerdetail
			JOIN form_item ON form_item.id = form_answerdetail.item_id
			WHERE
				form_answerdetail.form_id = :form_id AND
				form_answerdetail.answer_id = :answer_id AND
				form_answerdetail.item_id IN ($item_ids) 
		";
		$param =
			[
				':form_id' => $_form_id,
				':answer_id' => $_answer_id,
			];

		return \dash\pdo::get($query, $param);
	}


}
?>
