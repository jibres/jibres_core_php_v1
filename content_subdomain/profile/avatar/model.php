<?php
namespace content_subdomain\profile\avatar;


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
