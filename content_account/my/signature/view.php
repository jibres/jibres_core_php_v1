<?php
namespace content_account\my\signature;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Edit your profile'));
		\dash\data::page_desc(T_('You can edit your profile.'));

		\dash\data::badge_link(\dash\url::kingdom(). '/a');
		\dash\data::badge_text(T_('Back to dashbaord'));

		// back
		\dash\data::page_backText(T_('Personal info'));
		\dash\data::page_backLink(\dash\url::this());


		\dash\data::dataRow(\dash\app\user::ready($user_detail, true));
	}
}
?>