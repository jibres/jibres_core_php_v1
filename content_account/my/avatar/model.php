<?php
namespace content_account\my\avatar;


class model
{

	public static function getPost()
	{

		$post = [];

		if(\dash\request::post('remove') === 'avatar')
		{
			$post           = [];
			$post['avatar'] = null;
			\dash\upload\user::avatar_remove();
		}
		else
		{

			$avatar = \dash\upload\user::avatar_set();

			if($avatar)
			{
				$post['avatar'] = $avatar;
			}
			else
			{
				if(\dash\engine\process::status())
				{
					\dash\notif::warn(T_("No file was received"));
				}
				return false;
			}
		}


		return $post;
	}


	/**
	 * Posts a user add.
	 */
	public static function post()
	{
		$check_log           = [];
		$check_log['caller'] = 'editProfileAvatar';
		$check_log['from']   = \dash\user::id();

		$today           = date("Y-m-d H:i:s", (time() - (60*60*24)));
		$get_count_log       = \dash\db\logs::count_where_date($check_log, $today);

		if(floatval($get_count_log) > 5)
		{
			\dash\notif::error(T_("You have changed your avatar several times. You can not change it at this time."));
			return false;
		}

		$request = self::getPost();

		if($request === false)
		{
			return false;
		}

		// ready request
		$id = \dash\coding::encode(\dash\user::id());

		$result = \dash\app\user::edit($request, $id);

		if(\dash\engine\process::status())
		{
			\dash\notif::direct(true);
			\dash\log::set('editProfileAvatar', ['code' => \dash\user::id()]);
			\dash\redirect::pwd();
		}
	}
}
?>