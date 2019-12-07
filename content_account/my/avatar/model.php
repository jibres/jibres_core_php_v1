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
			\dash\upload\avatar::remove();
		}
		else
		{

			$avatar = \dash\upload\avatar::set();

			if($avatar)
			{
				$post['avatar'] = $avatar;
			}
			else
			{
				\dash\notif::warn(T_("No file was received"));
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
			\dash\user::refresh();
			\dash\notif::direct(true);
			\dash\log::set('editProfileAvatar', ['code' => \dash\user::id()]);
			\dash\redirect::pwd();
		}
	}
}
?>