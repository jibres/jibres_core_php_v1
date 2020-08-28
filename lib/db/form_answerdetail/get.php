<?php
namespace lib\db\form_answerdetail;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function by_form_id($_form_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.form_id = $_form_id ORDER BY IFNULL(form_answerdetail.sort, form_answerdetail.id) ASC ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.form_id = $_form_id AND form_answerdetail.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;

	}


	public static function by_item_id($_item_id)
	{
		$query = "SELECT * FROM form_answerdetail WHERE form_answerdetail.item_id = $_item_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function get_where($_where)
	{
		$where = \dash\db\config::make_where($_where);
		$query = "SELECT * FROM form_answerdetail WHERE $where LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
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
		";

		$result = \dash\db::get($query);
		return $result;
	}

}
?>
