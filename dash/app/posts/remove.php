<?php
namespace dash\app\posts;

class remove
{

	public static function remove($_id)
	{
		\dash\permission::access('cmsPostRemove');

		$load = \dash\app\posts\get::inline_get($_id);

		if(!$load)
		{
			return false;
		}

		if(isset($load['status']))
		{
			if($load['status'] === 'publish')
			{
				\dash\notif::error(T_("Can not remove published post!"));
				return false;
			}

			if($load['status'] === 'deleted')
			{
				\dash\notif::error(T_("This post was already removed"));
				return false;
			}


		}

		\dash\db\posts::update(['status' => 'deleted'], $load['id']);

		\dash\notif::ok(T_("Post removed"));

		return true;
	}
}
?>