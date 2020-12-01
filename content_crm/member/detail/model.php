<?php
namespace content_crm\member\detail;


class model
{

	/**
	 * Posts an addmember.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function post()
	{
		$user_id = \dash\coding::decode(\dash\request::get('id'));
		if(!$user_id)
		{
			return false;
		}

		$request           = [];
		if(\dash\request::post('btn') === 'remove')
		{
			$request['avatar'] = null;

			\dash\upload\user::avatar_remove($user_id);
		}
		elseif(\dash\request::post('editdisplayname') === 'editdisplayname')
		{
			$post =
			[
				'displayname' => \dash\request::post('displayname'),
			];

			\dash\app\user::edit($post, \dash\request::get('id'));

		}
		else
		{
			$file_url = \dash\upload\user::avatar_set($user_id);

			// we have an error in upload avatar
			if($file_url === false)
			{
				\dash\notif::warn(T_("To change user avatar choose a new avatar"));
				return false;
			}

			$request['avatar'] = $file_url;
		}

		\dash\app\user::quick_update($request, $user_id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>