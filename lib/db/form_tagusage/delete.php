<?php
namespace lib\db\form_tagusage;


class delete
{
	public static function tag_usage_tag_id($_id)
	{
		$query  = "DELETE FROM form_tagusage WHERE form_tagusage.form_tag_id = $_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM form_tagusage WHERE $where ";
			return \dash\db::query($query);
		}
	}

	public static function hard_delete_answer_tag($_form_tag_id, $_answer_id)
	{
		$query = "DELETE FROM form_tagusage WHERE form_tagusage.form_tag_id IN ($_form_tag_id) AND form_tagusage.answer_id = $_answer_id ";
		return \dash\db::query($query);
	}



	public static function hard_delete_all_answer_tag($_answer_id)
	{
		$query = "DELETE FROM form_tagusage WHERE form_tagusage.answer_id = $_answer_id ";
		return \dash\db::query($query);
	}

}
?>
