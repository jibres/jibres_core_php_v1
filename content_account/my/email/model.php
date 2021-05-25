<?php
namespace content_account\my\email;


class model
{


	/**
	 * Posts a user add.
	 */
	public static function post()
	{
		$email = \dash\request::post('email');
		$id = \dash\request::post('id');
		if(\dash\request::post('remove') === 'remove')
		{
			$result = \dash\app\user\email::remove($id, \dash\user::id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::current());
			}
		}
		elseif(\dash\request::post('primary') === 'primary')
		{
			$result = \dash\app\user\email::primary($id, \dash\user::id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::current());
			}
		}
		elseif(\dash\request::post('verify') === 'verify')
		{
			$result = \dash\app\user\email::verify($id, \dash\user::id());
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::current());
			}
		}
		else
		{
			// ready request
			$result = \dash\app\user\email::add($email, \dash\user::id());

			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::ok(T_("Email successfully added"));
				\dash\log::set('editProfileEmail', ['newemail' => \dash\request::post('email'), 'code' => \dash\user::id()]);

				// \dash\notif::direct();
				\dash\redirect::to(\dash\url::current());
			}
		}

	}
}
?>