<?php
namespace dash\app\files;


class remove
{

	public static function remove($_id)
	{
		if(!\dash\permission::check('manageProductTag'))
		{
			return false;
		}


		$load = \dash\app\terms\get::get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		if(isset($load['count']) && $load['count'])
		{
			\dash\notif::error(T_("Some post save by this tag and you can not remove it"));
			return false;
		}


		\dash\db\terms\delete::record(\dash\coding::decode($_id));

		\dash\notif::ok(T_("Tag successfully removed"));

		return true;
	}


}
?>