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

		$load_menu = \lib\app\menu\update::post($load['id']);
		if($load_menu)
		{
			\dash\notif::error(T_("This post used in menu and can not be remove"));
			return false;
		}

		$is_policy_page = \lib\app\setting\policy_page::is_policy_page($_id);
		if($is_policy_page)
		{
			\lib\app\setting\policy_page::set([$is_policy_page['key'] => null]);
			\dash\notif::clean();
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