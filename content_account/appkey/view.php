<?php
namespace content_account\appkey;

class view
{

	public static function config()
	{
		\dash\face::title(T_('Application key'));

		\dash\data::back_link(\dash\url::here(). '/security');
		\dash\data::back_text(T_('Back'));


		\dash\data::appkey(\dash\app\user_auth::get_appkey(\dash\user::id()));
		\dash\data::myTitle(T_(':val API documentation', ['val' => \dash\face::site()]));

		$myStore = \lib\app\store\mystore::list();
		\dash\data::listStore($myStore);

	}
}
?>