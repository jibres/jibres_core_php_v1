<?php
namespace content_account\my\email;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Email'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());

		$my_email_list = \dash\app\user\email::get_my_list();
		\dash\data::dataTable($my_email_list);
	}
}
?>
