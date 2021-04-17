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


	public static function quote($_args, $_id)
	{
		// check args
		$args = \dash\app\comment\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid comments id"));
			return false;
		}

		$load = \dash\db\comments\get::full_by_id($id);

		if(!$load)
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(empty($args))
		{
			return true;
		}

 		\dash\db\comments\update::update($args, $load['id']);

		return true;

	}


	public static function edit($_args, $_id, $_force = false)
	{
		if(!$_force)
		{
			\dash\permission::access('cmsManageComment');
		}

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

		if(isset($load['for']) && $load['for'] === 'quote')
		{
			\dash\notif::error(T_("Can not edit quote from this place!"));
			return true;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(empty($args))
		{
			\dash\notif::info(T_("Comment saved without change"));
			return true;
		}

 		\dash\db\comments\update::update($args, $load['id']);

		\dash\notif::ok(T_("Your comment successfully edited"));


		return true;

	}
}
?>