<?php
namespace content_crm\member\permission;


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

		if(\dash\request::post('apikey') === 'generate')
		{
			$check = \dash\app\user_auth::make_user_auth($user_id, 'api');
			if($check)
			{
				\dash\log::set('createNewApiKey');
				\dash\notif::ok(T_("Creat new api key successfully complete"));
				\dash\redirect::pwd();
			}
			else
			{
				\dash\notif::error(T_("Error in create new api key"));
			}
		}
		elseif(\dash\request::post('apikey') === 'remove')
		{
			$check = \dash\app\user_auth::disable_api_key($user_id, 'api');
			if($check)
			{
				\dash\log::set('RemoveApiKey');
				\dash\notif::ok(T_("Your api key was removed"));
				\dash\redirect::pwd();
			}
			else
			{
				\dash\notif::error(T_("Error in remove api key"));
			}
		}

		$post =
		[
			'permission'    => \dash\request::post('permission'),

		];

		if(floatval($user_id) === floatval(\dash\user::id()))
		{
			if(\dash\user::detail('permission') === 'supervisor')
			{
				unset($post['permission']);
				\dash\notif::error(T_("Hi. You can not change your permission"));
				return false;
			}
			else
			{
				if(isset($post['permission']) && $post['permission'] !== 'admin' && \dash\user::detail('permission') === 'admin' )
				{
					\dash\notif::warn(T_("You can not set your permission less than admin!"));
					$post['permission'] = 'admin';
					return true;
				}
			}
		}


		\dash\app\user::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>