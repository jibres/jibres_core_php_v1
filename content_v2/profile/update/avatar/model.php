<?php
namespace content_v2\profile\update\avatar;


class model
{

	public static function post()
	{
		$request = [];

		$avatar = \dash\upload\user::avatar_set();

		if($avatar)
		{
			$request['avatar'] = $avatar;
		}


		if(!array_filter($request))
		{
			\dash\notif::error(T_("No file sended"));
			return false;
		}

		// ready request
		$id = \dash\coding::encode(\dash\user::id());

		$result = \dash\app\user::edit($request, $id);

		if(\dash\engine\process::status())
		{
			\dash\log::set('editProfileAPI', ['code' => \dash\user::id()]);
			\dash\user::refresh();
		}

		return $result;
	}
}
?>