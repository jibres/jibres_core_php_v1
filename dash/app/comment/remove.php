<?php
namespace dash\app\comment;

class remove
{
/**
	 * Gets the user.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The user.
	 */
	public static function remove($_id)
	{
		\dash\permission::access('cmsManageComment');

		$load = \dash\app\comment\get::inline_get($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return true;
		}


		\dash\db\comments\delete::full_by_id($_id);

		\dash\notif::ok(T_("Comment removed"));
		return true;

	}

}
?>