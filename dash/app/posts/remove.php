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
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(isset($load['status']))
		{
			if($load['status'] === 'publish')
			{
				\dash\notif::error(T_("Can not remove published post!"));
				return false;
			}

		}

		// \dash\db\comments\delete::by_post_id($load['id']);

		if($load['status'] === 'deleted')
		{
			\dash\db\termusages\delete::by_post_id($load['id']);
			\dash\db\posts\delete::record($load['id']);
			\dash\log::set('postRemoved', ['my_title' => a($load, 'title')]);
			\dash\notif::ok(T_("Post removed"));
		}
		else
		{
			\dash\db\posts::update(['status' => 'deleted'], $load['id']);
			\dash\notif::ok(T_("Post move to trash"));
		}



		return true;
	}
}
?>