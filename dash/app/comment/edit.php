<?php
namespace dash\app\comment;

class edit
{

	public static function edit_status($_status, $_id)
	{
		self::edit(['status' => $_status], $_id);

		if(\dash\engine\process::status())
		{

		}

		return true;
	}



	public static function edit($_args, $_id)
	{
		\dash\permission::access('cmsManageComment');

		// check args
		$args = \dash\app\comment\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$load = \dash\app\comment\get::inline_get($_id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(empty($args))
		{
			\dash\notfi::info(T_("Comment saved without change"));
			return true;
		}

 		\dash\db\comments\update::update($args, $load['id']);

		\dash\notif::ok(T_("Your comment successfully added"));


		return true;

	}
}
?>