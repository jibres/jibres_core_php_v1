<?php
namespace content_a;


class controller
{
	public static function routing()
	{
		if(!\dash\url::subdomain())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		// check user is login
		\dash\redirect::to_login();

		\dash\permission::access('contentA');
	}
}
?>
