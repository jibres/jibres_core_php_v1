<?php
namespace content_a\setting\instagram;


class model
{
	public static function post()
	{
		if(\dash\request::post('instagram') === 'remove_token')
		{
			\lib\app\instagram\remove::token();
			return true;
		}
		elseif(\dash\request::post('instagram') === 'login')
		{
			$instagramLoginUrl = \lib\app\instagram\get::login_url();

			if(!$instagramLoginUrl)
			{
				\dash\notif::error(T_("Can not connect to instagram!"));
				return false;
			}

			\dash\notif::direct();
			\dash\redirect::to_external($instagramLoginUrl);

			return true;
		}
		else
		{
			$post =
			[
				'instagram'   => \dash\request::post('instagram'),
			];

			\lib\app\store\edit::social($post);

			if(\dash\engine\process::status())
			{
				\lib\store::refresh();
			}
		}
	}
}
?>