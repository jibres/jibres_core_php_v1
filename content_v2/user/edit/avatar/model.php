<?php
namespace content_v2\user\edit\avatar;


class model
{
	public static function post()
	{
		$post           = [];

		$user_code = \dash\request::get('id');

		$user_id = \dash\coding::decode($user_code);
		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}

		$avatar = \dash\upload\user::avatar_set($user_id);

		if($avatar)
		{
			$post['avatar'] = $avatar;
		}

		$result    = \dash\app\user::edit($post, $user_code);

		\content_v2\tools::say($result);

	}
}
?>