<?php
namespace content_su\passwd;

class model
{
	public static function post()
	{
		$su_access = \dash\setting\enter::su_access();

		if(\dash\utility::hasher(\dash\request::post('passwd'), $su_access))
		{
			$su_access_detail =
			[
				'time'    => time(),
				'acccess' => true,
			];

			\dash\session::set('su_access', $su_access_detail);

			\dash\log::to_supervisor('Enter success to su  '. \dash\user::detail('displayname'));

			\dash\redirect::to(\dash\url::here());
		}
		else
		{
			\dash\log::to_supervisor('Su access Invalid password '. \dash\user::id(). '-'. \dash\user::detail('displayname'));
			\dash\notif::error(T_("Invalid password"));
			return false;
		}
	}
}
?>