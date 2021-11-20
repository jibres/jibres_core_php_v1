<?php
namespace content_a\setting\instagram;


class model
{
	public static function post()
	{
		if(\dash\request::post('ig_action') === 'remove_token')
		{
			\lib\app\instagram\business::remove_token();
			return true;
		}
		elseif(\dash\request::post('ig_action') === 'login')
		{
			$instagramLoginUrl = \lib\app\instagram\business::login_url();

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