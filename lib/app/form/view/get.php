<?php
namespace lib\app\form\view;


class get
{
	public static function get($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_view\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\view\ready::row($load);

		return $load;
	}



	public static function is_created_table($_form_id)
	{
		$form_id = \dash\validate::id($_form_id);

		if(!$form_id)
		{
			return false;
		}

		$show_table = \lib\db\form\get::show_table($_form_id);
		if(!$show_table)
		{
			return false;
		}

		if(isset($show_table[0]) && $show_table[0] && is_array($show_table[0]))
		{
			$temp = array_values($show_table[0]);
			if(isset($temp[0]))
			{
				return $temp[0];
			}
		}

		return null;

	}
}
?>