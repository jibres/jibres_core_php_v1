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

			$module = \dash\url::module();
			if(!\dash\url::child() && $module && substr($module, 0, 1) === ':' && \dash\validate::id(substr($module, 1), false))
			{
				$factor_id = \dash\validate::id(substr($module, 1), false);
				$new_url = \dash\url::kingdom(). '/a/order/detail?id='. $factor_id;
				\dash\redirect::to($new_url);
				return;
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