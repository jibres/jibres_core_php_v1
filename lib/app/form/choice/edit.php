<?php
namespace lib\app\form\choice;


class edit
{

	public static function save_sort($_item_id, $_sort)
	{
		$_item_id = \dash\validate::id($_item_id);

		if(!is_array($_sort))
		{
			$_sort = [];
		}

		$new_sort = [];
		foreach ($_sort as $key => $value)
		{
			$key = \dash\validate::number($key);
			$value = \dash\validate::id($value);

			$new_sort[$key] = $value;
		}

		if(!empty($new_sort))
		{
			\lib\db\form_choice\update::set_sort($_item_id, $new_sort);
			\dash\notif::ok(T_("Sort saved"));
			return true;
		}
	}


	public static function edit($_args, $_id)
	{

		$load = \lib\app\form\choice\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$args = \lib\app\form\choice\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}


		$args = \dash\cleanse::patch_mode($_args, $args);

		foreach ($args as $key => $value)
		{
			if(\dash\validate::is_equal(\dash\get::index($load, $key), $value))
			{
				unset($args[$key]);
			}
		}

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form_choice\update::update($args, $_id);

		return true;
	}
}
?>