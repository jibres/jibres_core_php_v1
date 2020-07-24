<?php
namespace content\home;

class controller
{

	// for routing check
	public static function routing()
	{
		if(\dash\url::store())
		{
			if(\dash\url::module() === 'apk' && !\dash\url::child())
			{
				\lib\app\application\download::from_site();
			}

			\dash\redirect::to(\dash\url::kingdom(). '/a');
		}

		if(\dash\user::id())
		{
			if(\dash\detect\device::detectPWA())
			{
				// \dash\redirect::to(\dash\url::kingdom(). '/dashboard');
			}
		}


	}
}
?>