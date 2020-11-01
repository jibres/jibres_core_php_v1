<?php
namespace lib\app\form\choice;


class get
{


	public static function get($_id)
	{
		\dash\permission::access('_group_form');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_choice\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\choice\ready::row($load);

		return $load;
	}



	public static function choice_item($_item)
	{
		\dash\permission::access('_group_form');

		$item = \dash\validate::id($_item);

		if(!$item)
		{
			return false;
		}

		$load = \lib\db\form_choice\get::get_by_item_id($item);

		if(!is_array($load))
		{
			$load = [];
		}

		$load = array_map(['\\lib\\app\\form\\choice\\ready', 'row'], $load);

		return $load;
	}


	public static function all_choice($_form_id)
	{
		\dash\permission::access('_group_form');

		$form_id = \dash\validate::id($_form_id);

		if(!$form_id)
		{
			return false;
		}

		$load = \lib\db\form_choice\get::by_form_id($form_id);

		if(!is_array($load))
		{
			$load = [];
		}

		$load = array_map(['\\lib\\app\\form\\choice\\ready', 'row'], $load);

		return $load;
	}
}
?>