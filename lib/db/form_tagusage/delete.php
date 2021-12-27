<?php
namespace lib\db\form_tagusage;


class delete
{
	public static function tag_usage_tag_id($_id)
	{
		$query  = "DELETE FROM form_tagusage WHERE form_tagusage.form_tag_id = $_id ";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


	public static function hard_delete($_args)
	{
		$q  = \dash\pdo\prepare_query::generate_where('form_tagusage', $_args);

		$query  = "DELETE FROM form_tagusage WHERE $q[where] ";
		$param  = $q['param'];
		$result = \dash\pdo::query($query, $param);

		return $result;
	}

	public static function hard_delete_answer_tag($_form_tag_id, $_answer_id)
	{
		$query = "DELETE FROM form_tagusage WHERE form_tagusage.form_tag_id IN ($_form_tag_id) AND form_tagusage.answer_id = $_answer_id ";
		return \dash\pdo::query($query, []);
	}



	public static function hard_delete_all_answer_tag($_answer_id)
	{
		$query = "DELETE FROM form_tagusage WHERE form_tagusage.answer_id = $_answer_id ";
		return \dash\pdo::query($query, []);
	}

}
?>
