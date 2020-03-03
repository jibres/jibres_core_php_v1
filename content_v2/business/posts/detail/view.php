<?php
namespace content_v2\business\posts\detail;


class view
{

	public static function config()
	{
		$id = \dash\request::get('id');
		$load_post = \dash\app\posts::get($id, ['check_login' => false]);
		if(!$load_post)
		{
			\dash\notif::error(T_("Post not found"));
		}
		\content_v2\tools::say($load_post);
	}

}
?>