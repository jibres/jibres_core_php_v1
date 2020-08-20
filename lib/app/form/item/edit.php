<?php
namespace lib\app\form\form;


class edit
{
	public static function edit($_args, $_id)
	{
		$load = \lib\app\form\form\get::get($_id);
		if(!$load)
		{
			return false;
		}


		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form\update::update($args, $_id);

		\dash\notif::ok(T_("Contact form successfully updated"));

		return true;
	}
}
?>