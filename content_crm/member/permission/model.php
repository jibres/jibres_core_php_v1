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

		$post =
		[
			'permission'    => \dash\request::post('permission'),

		];

		if(floatval(\dash\coding::decode(\dash\request::get('id'))) === floatval(\dash\user::id()))
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