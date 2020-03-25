<?php
namespace content_account\api;

class view
{

	public static function config()
	{
		\dash\face::title(T_('API key'));


		\dash\data::action_link(\dash\url::here(). '/security');
		\dash\data::action_text(T_('Back to Account security'));

		\dash\data::back_link(\dash\url::here(). '/security');
		\dash\data::back_text(T_('Back'));

		\dash\data::apikey(\dash\app\user_auth::get_apikey(\dash\user::id(), 'api'));
		\dash\data::myTitle(T_(':val API documentation', ['val' => \dash\data::site_title()]));
	}
}
?>