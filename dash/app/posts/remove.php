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

		\dash\db\termusages\delete::by_post_id($load['id']);
		// \dash\db\comments\delete::by_post_id($load['id']);
		\dash\db\posts\delete::record($load['id']);

		\dash\log::set('postRemoved', ['my_title' => a($load, 'title')]);

		\dash\notif::ok(T_("Post removed"));

		return true;
	}
}
?>