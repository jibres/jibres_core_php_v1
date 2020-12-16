<?php
namespace dash\app\terms;


class edit
{
	public static function edit($_args, $_id)
	{
		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit term"), 'term');
			return false;
		}

		// check args
		$args = \dash\app\terms\check::variable($_args, $id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			\dash\db\terms\update::update($args, $id);

			\dash\notif::ok(T_("Category successfully updated"));
		}
		else
		{
			\dash\notif::info(T_("Category save without changes"));
		}

		return true;
	}
}
?>