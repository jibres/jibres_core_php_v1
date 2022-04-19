<?php
namespace lib\app\form\form;


class get
{
	public static function sitemap_list($_from, $_to)
	{
		$list = \lib\db\form\get::sitemap_list($_from, $_to);
		if(!is_array($list))
		{
			return false;
		}

		$list = array_map(['\\lib\\app\\form\\form\\ready', 'row'], $list);

		return $list;
	}


	public static function get($_id)
	{
		\dash\permission::access('_group_form');

		return self::public_get($_id);

	}


	public static function public_get($_id)
	{

		$id = \dash\validate::string_200($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form\get::load_public_form($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\form\ready::row($load);

		return $load;
	}
}
?>