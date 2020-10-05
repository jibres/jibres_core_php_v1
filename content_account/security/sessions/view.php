<?php
namespace content_account\security\sessions;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Active Sessions'));

		// back
		\dash\data::back_text(T_('Security'));
		\dash\data::back_link(\dash\url::this());


		\dash\data::isLtr(\dash\language::dir() === 'ltr' ? true : false);

		$id = \dash\user::id();

		if(!$id)
		{
			\dash\header::status(404, T_("Invalid user id"));
		}

		$user_detail = \dash\db\users::get_by_id($id);

		if(!$user_detail)
		{
			\dash\header::status(404, T_("User id not found"));
		}

		\dash\data::dataRow(\dash\app\user::ready($user_detail, true));

		$list    = \dash\login::get_active_sessions($id);
		\dash\data::sessionsList($list);

	}
}
?>
