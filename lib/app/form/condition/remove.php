<?php
namespace lib\app\form\condition;


class remove
{
	public static function remove($_key, $_form_id)
	{
		\dash\permission::access('ManageForm');

		$load_form = \lib\app\form\form\get::by_id($_form_id);

		$condition = [];

		if(is_array(a($load_form, 'condition')))
		{
			$condition = $load_form['condition'];
		}

		if(isset($condition[$_key]))
		{
			unset($condition[$_key]);
		}
		else
		{
			\dash\notif::error(T_("Invalid condition key"));
			return false;
		}

		$condition = json_encode($condition);

		\lib\db\form\update::update(['condition' => $condition], $_form_id);

		\dash\notif::ok(T_("Condition removed"));

		return true;


	}
}
?>