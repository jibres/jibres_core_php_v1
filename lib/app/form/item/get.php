<?php
namespace lib\app\form\item;


class get
{
	public static function items($_form_id)
	{
		$_form_id = \dash\validate::id($_form_id);

		if(!$_form_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$list = \lib\db\form_item\get::by_form_id($_form_id);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\form\\item\\ready', 'row'], $list);

		return $list;
	}


	public static function get($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_item\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\item\ready::row($load);

		return $load;
	}
}
?>